<?php

namespace App\Models;

use App\Concerns\Media\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasMedia, HasTranslations;

    public array $translatable = ['value'];

    protected $guarded = [];
}
