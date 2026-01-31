<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Showcase extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'slug',
        'description',
    ];

    protected $guarded = [];
}
