<?php

namespace App\Http\Controllers\Shop;

use App\Data\ProductSearchParams;
use App\Enums\ProductOrderType;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\CollectionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends InertiaController
{
    protected ProductRepository $productRepository;
    protected CollectionRepository $collectionRepository;

    public function __construct(ProductRepository $productRepository, CollectionRepository $collectionRepository)
    {
        $this->productRepository = $productRepository;
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function shop(Request $request)
    {
        $products = $this->productRepository->search(ProductSearchParams::fromRequest($request));
        $best_selling_products = $this->productRepository->search(new ProductSearchParams(['perPage' => 3, 'orderType' => ProductOrderType::BEST_SELLING]));
        $collections = $this->collectionRepository->getAll();
        $price_range = $this->productRepository->getPriceRange();
        $cart = app(SharedData::class)->getCart();

        return $this->inertia('Shop/Shop', [
            'products' => $products,
            'best_selling_products' => $best_selling_products,
            'collections' => $collections,
            'price_range' => $price_range,
            'cart' => $cart,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        $related_products = $this->productRepository->search(
            new ProductSearchParams(['collections' => $product->collections->pluck('slug')->toArray()]),
            // [$product->id]
        );

        parent::shared(app(SharedData::class)->getCart());

        return parent::view([
            'product' => $product,
            'related_products' => $related_products,
        ]);
    }
}
