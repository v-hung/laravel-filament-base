<?php

namespace App\Models;

use App\Concerns\Media\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Showcase extends Model
{
    use HasMedia, HasTranslations;

    public array $translatable = [
        'title',
        'slug',
        'description',
    ];

    protected $guarded = [];

    protected $appends = ['image'];

    public function image(): Attribute
    {
        return Attribute::get(fn () => $this->getFirstMedia('image'));
    }
}
