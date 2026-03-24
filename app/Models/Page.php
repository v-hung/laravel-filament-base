<?php

namespace App\Models;

use App\Concerns\HasTranslatableSlug;
use App\Concerns\Media\HasMedia;
use App\Enums\ContentStatus;
use App\Enums\PageType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasMedia, HasTranslatableSlug, HasTranslations;

    public array $translatable = [
        'title',
        'slug',
        'description',
        'content',
        'sections',
    ];

    protected $guarded = [];

    protected $casts = [
        'status' => ContentStatus::class,
        'page_type' => PageType::class,
        'sections' => 'array',
    ];

    protected $appends = ['image'];

    public function image(): Attribute
    {
        return Attribute::get(fn () => $this->getFirstMedia('image')?->toMediaData());
    }
}
