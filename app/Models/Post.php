<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Post extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = [
        'title',
        'slug',
        'description',
        'content',
    ];

    protected $casts = [
        'status' => ContentStatus::class,
    ];

    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'post_blog');
    }

    protected $appends = ['image'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/*'])
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getImageAttribute()
    {
        if (! $this->relationLoaded('media')) {
            return null;
        }

        $media = $this->getFirstMedia('gallery');

        return $media ? [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'thumb' => $media->getUrl('thumb'),
        ] : null;
    }
}
