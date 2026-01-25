<?php

namespace App\Http\Controllers\Site;

use App\Data\ProductSearchParams;
use App\Data\SearchParams;
use App\Data\ShowcaseSearchParams;
use App\Enums\ProductOrderType;
use App\Enums\ShowcaseType;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\ProductRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\PostRepository;
use App\Repositories\ShowcaseRepository;
use Illuminate\Http\Request;

class HomeController extends InertiaController
{
    protected $productRepository;
    protected $collectionRepository;
    protected $postRepository;
    protected $showcaseRepository;

    public function __construct(
        ProductRepository $productRepository,
        CollectionRepository $collectionRepository,
        PostRepository $postRepository,
        ShowcaseRepository $showcaseRepository
    ) {
        $this->productRepository = $productRepository;
        $this->collectionRepository = $collectionRepository;
        $this->postRepository = $postRepository;
        $this->showcaseRepository = $showcaseRepository;
    }

    public function index()
    {
        $products = $this->productRepository->search(new ProductSearchParams(['perPage' => 4, 'orderType' => ProductOrderType::BEST_SELLING]));
        $posts = $this->postRepository->search(new SearchParams(['perPage' => 4]));
        $testimonials = $this->showcaseRepository->search(new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Testimonial]));
        $partners = $this->showcaseRepository->search(new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Partner]));
        $cart = app(SharedData::class)->getCart();

        return $this->inertia('Site/Index', [
            'products' => $products,
            'posts' => $posts,
            'testimonials' => $testimonials,
            'partners' => $partners,
            'cart' => $cart,
        ]);
    }
}
