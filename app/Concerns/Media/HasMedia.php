<?php

namespace App\Concerns\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;

trait HasMedia
{
    protected array $mediaCollections = [];

    protected static function bootHasMedia(): void
    {
        static::created(function ($model) {
            if (method_exists($model, 'registerMediaCollections')) {
                $model->registerMediaCollections();
            }
            if (method_exists($model, 'registerMediaConversions')) {
                $model->registerMediaConversions();
            }
        });
    }

    public function media(): MorphToMany
    {
        return $this->morphToMany(
            Media::class,
            'mediable',
            'mediables'
        )->withPivot(['collection', 'sort_order'])
            ->orderBy('mediables.sort_order');
    }

    public function getMedia(string $collection)
    {
        $media = $this->media()
            ->wherePivot('collection', $collection)
            ->get();

        // Get conversions from collection definition
        $collectionDef = $this->mediaCollections[$collection] ?? null;
        if (! $collectionDef) {
            return $media;
        }

        $modelBasename = class_basename(static::class);

        // Add filtered conversions to each media item
        $media->each(function ($item) use ($modelBasename, $collection, $collectionDef) {
            $allConversions = $item->generated_conversions ?? [];
            $filteredConversions = [];

            // Get conversion names from collection definition
            $definedConversions = $collectionDef->getConversions();

            foreach ($definedConversions as $conversionDef) {
                $conversionName = $conversionDef->name;
                $conversionKey = "{$modelBasename}_{$collection}_{$conversionName}";

                // Check if this conversion exists in generated_conversions
                if (isset($allConversions[$conversionKey])) {
                    $filteredConversions[$conversionName] = $allConversions[$conversionKey];
                }
            }

            // Add filtered conversions as a property
            $item->setAttribute('conversions', $filteredConversions);
        });

        return $media;
    }

    public function getFirstMedia(string $collection): ?Media
    {
        return $this->getMedia($collection)->first();
    }

    /**
     * Add media to a collection
     */
    public function addMedia(UploadedFile $file): PendingMediaAttachment
    {
        return new PendingMediaAttachment($this, $file);
    }

    /**
     * Attach existing media to this model
     */
    public function attachMedia(Media $media, string $collection = 'default', int $sortOrder = 0): void
    {
        $this->media()->attach($media->id, [
            'collection' => $collection,
            'sort_order' => $sortOrder,
        ]);
    }

    /**
     * Detach media from this model
     */
    public function detachMedia(Media $media): void
    {
        $this->media()->detach($media->id);
    }

    /**
     * Clear all media in a collection
     */
    public function clearMediaCollection(string $collection): void
    {
        $mediaItems = $this->getMedia($collection);

        foreach ($mediaItems as $media) {
            $this->detachMedia($media);
        }
    }

    /* =====================
        DECLARE
    ===================== */

    public function addMediaCollection(string $name): MediaCollectionDefinition
    {
        return $this->mediaCollections[$name]
            ??= new MediaCollectionDefinition($name);
    }

    /* =====================
        ACCESS
    ===================== */

    public function getRegisteredMediaCollections(): array
    {
        return $this->mediaCollections;
    }

    /**
     * Get all conversions for a specific collection
     */
    public function getRegisteredMediaConversions(string $collection): array
    {
        $collectionDef = $this->mediaCollections[$collection] ?? null;

        return $collectionDef ? $collectionDef->getConversions() : [];
    }
}
