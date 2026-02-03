<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductVariant extends Model implements HasMedia
{
	use InteractsWithMedia;

	protected $guarded = [];

	protected $casts = [
		'price' => 'decimal:2',
	];

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class);
	}

	public function values(): BelongsToMany
	{
		return $this->belongsToMany(
			ProductOptionValue::class,
			'product_variant_values',
			'product_variant_id',
			'product_option_value_id'
		);
	}

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
