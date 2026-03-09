<?php

namespace App\Http\Controllers\Shop;

use App\Data\ProductSearchParams;
use App\Data\SearchParams;
use App\Enums\ProductOrderType;
use App\Http\Controllers\Controller;
use App\Repositories\CollectionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Throwable;

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
        $collections = $this->collectionRepository->search(new SearchParams(['perPage' => 6]));

        return $this->render('shop/index', [
            'products' => $products,
            'featured_products' => $featured_products,
            'collections' => $collections,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $slug)
    {
        try {
            $product = $this->productRepository->findBySlug($slug);

            $related_products = $this->productRepository->search(
                new ProductSearchParams(['collections' => $product->collections->pluck('slug')->toArray()]),
                [$product->id]
            );

            return $this->render('shop/product-detail', [
                'product' => $product,
                'related_products' => $related_products,
            ]);
        } catch (Throwable $e) {
            $this->flash('toast', ['type' => 'error', 'message' => __('shop.product.not_found')]);

            return back();
        }
    }
}
