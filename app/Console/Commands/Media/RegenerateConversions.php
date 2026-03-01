<?php

namespace App\Console\Commands\Media;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RegenerateConversions extends Command
{
    protected $signature = 'media:regenerate-conversions
                            {--model= : Only process media for a specific model class (e.g. App\\Models\\Product)}
                            {--collection= : Only process a specific collection}
                            {--force : Regenerate even if the correct conversion key already exists}';

    protected $description = 'Regenerate media conversions using the correct namespaced key (ModelName_collection_conversionName)';

    public function handle(MediaService $mediaService): int
    {
        $modelFilter = $this->option('model');
        $collectionFilter = $this->option('collection');
        $force = $this->option('force');

        $query = DB::table('mediables')
            ->select('media_id', 'model_type', 'collection')
            ->distinct()
            ->orderBy('media_id')
            ->when($modelFilter, fn ($q) => $q->where('model_type', $modelFilter))
            ->when($collectionFilter, fn ($q) => $q->where('collection', $collectionFilter));

        $total = $query->count();

        if ($total === 0) {
            $this->info('No mediable records found.');

            return self::SUCCESS;
        }

        $this->info("Processing {$total} unique media+model+collection combination(s)...");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $generated = 0;
        $skipped = 0;

        $query->chunk(100, function ($rows) use ($mediaService, $force, &$generated, &$skipped, $bar): void {
            foreach ($rows as $row) {
                $media = Media::find($row->media_id);

                if (! $media) {
                    $bar->advance();

                    continue;
                }

                $modelClass = $row->model_type;
                $collection = $row->collection;
                $modelBasename = class_basename($modelClass);

                if (! class_exists($modelClass)) {
                    $bar->advance();

                    continue;
                }

                $modelInstance = new $modelClass;

                if (! method_exists($modelInstance, 'registerMediaCollections') || ! method_exists($modelInstance, 'getRegisteredMediaConversions')) {
                    $bar->advance();

                    continue;
                }

                $modelInstance->registerMediaCollections();
                $conversions = $modelInstance->getRegisteredMediaConversions($collection);

                if (empty($conversions)) {
                    $bar->advance();

                    continue;
                }

                $existingConversions = $media->generated_conversions ?? [];

                foreach ($conversions as $conversion) {
                    $expectedKey = "{$modelBasename}_{$collection}_{$conversion->name}";

                    if (! $force && array_key_exists($expectedKey, $existingConversions)) {
                        $skipped++;

                        continue;
                    }

                    $mediaService->generateConversion($media, $conversion, $modelClass, $collection);
                    $generated++;
                }

                $bar->advance();
            }
        });

        $bar->finish();
        $this->newLine();
        $this->info("Done. Generated: {$generated}, Skipped (already existed): {$skipped}.");

        return self::SUCCESS;
    }
}
