<?php

namespace App\Repositories;

use App\Data\ProductSearchParams;
use App\Enums\ProductOrderType;
use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{

    private const RELATIONS_WITH_OPTIONS_AND_VARIANTS = [
        // Options và các values
        'options:id,product_id,name,position',
        'options.values:id,product_option_id,label,position',

        // Variants và các values của nó
        'variants:id,product_id,image,sku,price,stock',
        'variants.values:id,product_option_id,label'
    ];

    /**
     * Get product by id
     *
     * @throws \Illuminate\Database\RecordNotFoundException
     */
    public function firstOrFail(int $id): ?Product
    {
        return Product::where('status', ProductStatus::Active)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findById(int $id): ?Product
    {
        return Product::where('status', ProductStatus::Active)->find($id);
    }

    public function findByIds(array $ids)
    {
        return Product::whereIn('id', $ids)->where('status', ProductStatus::Active)->get();
    }

    public function findBySlug(string $slug): ?Product
    {
        return Product::with('collections')->where('status', ProductStatus::Active)->where('slug', $slug)->firstOrFail();
    }

    /**
     * Get the price range (min, max) of the product
     *
     * @param string|null $status
     * @return array ['min' => float, 'max' => float]
     */
    public function getPriceRange(): array
    {
        $priceRange = Product::where('status', ProductStatus::Active)
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        return [
            'min' => (float) $priceRange->min_price,
            'max' => (float) $priceRange->max_price,
        ];
    }

    public static function search(ProductSearchParams $params, ?array $excludeIds = []): LengthAwarePaginator
    {
        $query = Product::query();

        $query->where('status', ProductStatus::Active);

        if ($params->search) {
            $query->where('name', 'like', "%{$params->search}%");
        }

        if ($params->price_min !== null) {
            $query->where('price', '>=', $params->price_min);
        }

        if ($params->price_max !== null) {
            $query->where('price', '<=', $params->price_max);
        }

        if (!empty($excludeIds)) {
            $query->whereNotIn('id', $excludeIds);
        }

        if ($params->order_type) {
            match ($params->order_type) {
                ProductOrderType::FEATURED =>
                $query->orderBy('is_featured', 'desc')
                    ->orderBy('featured_position', 'asc'),

                ProductOrderType::BEST_SELLING =>
                $query->orderBy('sales_count', 'desc'),

                ProductOrderType::LATEST =>
                $query->orderBy('created_at', 'desc'),

                ProductOrderType::PRICE_DESC =>
                $query->orderBy('price', 'desc'),

                ProductOrderType::PRICE_ASC =>
                $query->orderBy('price', 'asc'),
            };
        } else {
            $query->orderBy($params->sortBy, $params->sortDirection);
        }

        return $query
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            )->withQueryString();
    }

    public function withOptionsAndVariants(Product $product): Product
    {
        $product->load(self::RELATIONS_WITH_OPTIONS_AND_VARIANTS);

        return $this->transform($product);
    }

    public function getWithOptionsAndVariants(int $productId): ?Product
    {
        $product = Product::with(self::RELATIONS_WITH_OPTIONS_AND_VARIANTS)->find($productId);

        if ($product != null) {
            $product = $this->transform($product);
        }

        return $product;
    }

    /**
     * @param  int[]  $productIds
     * @return Product[]
     */
    public function listWithOptionsAndVariants(array $productIds): array
    {
        $products = Product::with(self::RELATIONS_WITH_OPTIONS_AND_VARIANTS)->whereIn('id', $productIds)->get();

        return $products->map([$this, 'transform']);
    }

    private function transform(Product $product): Product
    {
        $sortedOptions = $product->options->sortBy('position');

        $product->setAttribute('options_raw', $sortedOptions->map(fn($opt) => [
            'id' => $opt->id,
            'name' => $opt->name,
            'values' => $opt->values
                ->sortBy('position')
                ->map(fn($val) => [
                    'id' => $val->id,
                    'label' => $val->label,
                ])->toArray(),
        ])->toArray());

        $product->setAttribute('variants_raw', $product->variants->map(fn($variant) => [
            'id' => $variant->id,
            'image' => $variant->image,
            'sku' => $variant->sku,
            'price' => $variant->price,
            'stock' => $variant->stock,
            'values' => $variant->values->map(fn($val) => [
                'id' => $val->id,
                'label' => $val->label,
                'option_id' => $val->product_option_id,
            ])->toArray(),
        ])->toArray());

        return $product;
    }
}
