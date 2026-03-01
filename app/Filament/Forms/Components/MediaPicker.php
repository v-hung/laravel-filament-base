<?php

namespace App\Filament\Forms\Components;

use App\Models\Media;
use App\Repositories\MediaRepository;
use App\Services\MediaService;
use Filament\Forms\Components\Field;

class MediaPicker extends Field
{
    protected string $view = 'filament.forms.components.media-picker';

    protected bool $multiple = false;

    protected ?string $folderPath = null;

    protected ?string $disk = null;

    protected array $acceptedFileTypes = ['image/*'];

    protected int $maxFiles = 1;

    protected array $conversions = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(fn ($component) => $component->getRecord() === null);

        $this->loadStateFromRelationshipsUsing(function (MediaPicker $component, mixed $record): void {
            $collection = $component->getCollection();
            $ids = $record->getMedia($collection)->pluck('id')->toArray();

            $component->state($component->isMultiple() ? $ids : ($ids[0] ?? null));
        });

        $this->saveRelationshipsUsing(function (MediaPicker $component, mixed $record): void {
            $state = $component->getState();
            $collection = $component->getCollection();

            $record->clearMediaCollection($collection);

            if (empty($state)) {
                return;
            }

            $ids = is_array($state) ? array_values(array_filter($state)) : [$state];

            foreach ($ids as $index => $mediaId) {
                $media = Media::find($mediaId);
                $media = app(MediaRepository::class)->getMediaById($mediaId);

                if ($media) {
                    $record->attachMedia($media, $collection, $index);
                    $component->ensureMissingConversions($media, $record, $collection);
                }
            }
        });
    }

    /**
     * Generate conversions that are missing for the given model+collection context.
     * Handles both: images uploaded before record existed (wrong key), and existing
     * images picked from the browser that never had conversions generated.
     */
    private function ensureMissingConversions(Media $media, mixed $record, string $collection): void
    {
        $conversions = $this->getConversions();

        if (empty($conversions)) {
            return;
        }

        $modelClass = get_class($record);
        $existingConversions = $media->generated_conversions ?? [];
        $mediaService = app(MediaService::class);

        foreach ($conversions as $conversion) {
            $expectedKey = $media->buildConversionKey($conversion->name);

            if (! array_key_exists($expectedKey, $existingConversions)) {
                $mediaService->generateConversion($media, $conversion, $modelClass, $collection);
            }
        }
    }

    public function folderPath(?string $path): static
    {
        $this->folderPath = $path;

        return $this;
    }

    public function getFolderPath(): ?string
    {
        return $this->folderPath;
    }

    public function multiple(bool $condition = true): static
    {
        $this->multiple = $condition;

        if ($condition) {
            $this->maxFiles = 10;
        }

        return $this;
    }

    public function disk(?string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function acceptedFileTypes(array $types): static
    {
        $this->acceptedFileTypes = $types;

        return $this;
    }

    public function maxFiles(int $count): static
    {
        $this->maxFiles = $count;
        $this->multiple = $count > 1;

        return $this;
    }

    public function conversions(array $conversions): static
    {
        $this->conversions = $conversions;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    public function getCollection(): string
    {
        return $this->getName();
    }

    public function getDisk(): string
    {
        return $this->disk ?? config('filesystems.default', 'public');
    }

    public function getAcceptedFileTypes(): array
    {
        return $this->acceptedFileTypes;
    }

    public function getMaxFiles(): int
    {
        return $this->maxFiles;
    }

    public function getConversions(): array
    {
        if (! empty($this->conversions)) {
            return $this->conversions;
        }

        $record = $this->getRecord();

        if ($record && method_exists($record, 'registerMediaCollections') && method_exists($record, 'getRegisteredMediaConversions')) {
            $record->registerMediaCollections();

            return $record->getRegisteredMediaConversions($this->getCollection());
        }

        return [];
    }

    public function getSerializedConversions(): array
    {
        return array_map(fn ($c) => [
            'name' => $c->name,
            'width' => $c->width,
            'height' => $c->height,
            'sharpen' => $c->sharpen,
            'queued' => $c->queued,
        ], $this->getConversions());
    }

    public function getModelClass(): ?string
    {
        $record = $this->getRecord();

        return $record ? get_class($record) : null;
    }

    public function getMediaItems(): array
    {
        $state = $this->getState();

        if (empty($state)) {
            return [];
        }

        $ids = $this->multiple ? (is_array($state) ? $state : [$state]) : [$state];

        return app(MediaRepository::class)->getMediaByIds($ids)
            ->map(fn ($media) => $media->toMediaData())
            ->toArray();
    }
}
