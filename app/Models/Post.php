<?php

namespace App\Models;

use App\Concerns\Media\HasMedia;
use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
	use HasTranslations, HasMedia;

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

	protected $appends = ['image'];

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Blog::class, 'post_blog');
	}


	public function image(): Attribute
	{
		return Attribute::get(fn() => $this->getFirstMedia('image'));
	}
}
