<?php

namespace App\Models;

use App\Concerns\Media\HasMedia;
use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
	use HasTranslations, HasMedia;

	public array $translatable = [
		'title',
		'slug',
		'description',
	];

	protected $guarded = [];

	protected $casts = [
		'status' => CategoryStatus::class,
	];

	protected $appends = ['image'];

	public function posts(): BelongsToMany
	{
		return $this->belongsToMany(Post::class, 'post_blog');
	}

	public function image(): Attribute
	{
		return Attribute::get(fn() => $this->getFirstMedia('image'));
	}
}
