<?php

namespace App\Models\Product;

use App\Concerns\Media\HasMedia;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariant extends Model
{
	use HasMedia;

	protected $guarded = [];

	protected $casts = [
		'price' => 'decimal:2',
	];

	protected $appends = ['image'];

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

	public function image(): Attribute
	{
		return Attribute::get(fn() => $this->getFirstMedia('image'));
	}
}
