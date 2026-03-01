<?php

namespace App\Http\Controllers\Shop;

use App\Data\ProductSearchParams;
use App\Enums\ProductOrderType;
use App\Http\Controllers\Controller;
use App\Repositories\CollectionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CollectionRepository $collectionRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function shop(Request $request)
    {
        $products = $this->productRepository->search(ProductSearchParams::fromRequest($request));
        $featured_products = $this->productRepository->search(new ProductSearchParams(['perPage' => 3, 'orderType' => ProductOrderType::FEATURED]));

        return $this->render('shop/index', [
            'products' => $products,
            'featured_products' => $featured_products,
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

        return $this->render('shop/product-detail', [
            'product' => $product,
            'related_products' => $related_products,
        ]);
    }
}
