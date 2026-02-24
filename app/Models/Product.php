<?php

namespace App\Models;

use App\Concerns\Media\HasMedia;
use App\Concerns\Media\MediaConversionDefinition;
use App\Models\Product\ProductOption;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasMedia, HasTranslations;

    public array $translatable = [
        'name',
        'slug',
        'description',
        'content',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
    ];

    protected $guarded = [];

    protected $appends = ['is_discounted', 'discount_percent', 'images'];

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'product_collection');
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    protected function isDiscounted(): Attribute
    {
        return Attribute::get(function () {
            return $this->compare_at_price > $this->price;
        });
    }

    protected function discountPercent(): Attribute
    {
        return Attribute::get(function () {
            if ($this->compare_at_price <= $this->price) {
                return 0;
            }

            return round(
                (($this->compare_at_price - $this->price) / $this->compare_at_price) * 100
            );
        });
    }

    /**
     * Nếu có giá trị trong filament form, nó sẽ ghi đè cấu hình ở đấy
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/*'])
            ->multiple()
            ->conversions([
                MediaConversionDefinition::make('thumb')
                    ->width(200)
                    ->height(200)
                    ->sharpen(10),
            ]);
    }

    public function images(): Attribute
    {
        return Attribute::get(fn() => $this->getMedia('gallery'));
    }
}
