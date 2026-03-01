<?php

namespace App\Concerns\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;

trait HasMedia
{
    protected array $mediaCollections = [];

    /**
     * Called automatically by Laravel for each model instance using this trait.
     * Hides the raw `media` relation from serialization — models expose media
     * through explicit accessors (e.g. `images`, `image`) instead.
     */
    public function initializeHasMedia(): void
    {
        $this->hidden = array_unique(array_merge($this->hidden, ['media']));

        if (method_exists($this, 'registerMediaCollections')) {
            $this->registerMediaCollections();
        }
    }

    public function media(): MorphToMany
    {
        return $this->morphToMany(
            Media::class,
            'model',
            'mediables'
        )->withPivot(['collection', 'sort_order'])
            ->orderBy('mediables.sort_order');
    }

    public function getMedia(string $collection): EloquentCollection
    {
        if (! $this->relationLoaded('media')) {
            $this->load('media');
        }

        /** @var EloquentCollection<int, Media> $media */
        $media = $this->getRelation('media')
            ->filter(fn (Media $item): bool => $item->pivot?->collection === $collection)
            ->values();

        // Get conversions from collection definition
        $collectionDef = $this->mediaCollections[$collection] ?? null;
        if (! $collectionDef) {
            return $media;
        }

        // Add filtered conversions to each media item
        $media->each(function ($item) use ($collectionDef) {
            $allConversions = $item->generated_conversions ?? [];
            $filteredConversions = [];

            // Get conversion names from collection definition
            $definedConversions = $collectionDef->getConversions();

            foreach ($definedConversions as $conversionDef) {
                $conversionName = $conversionDef->name;
                $conversionKey = $item->buildConversionKey($conversionName);

                // Check if this conversion exists in generated_conversions
                if (isset($allConversions[$conversionKey])) {
                    $allConversions[$conversionKey]['url'] = $item->getUrl($conversionName);
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
