<?php

namespace App\Http\Controllers\Site;

use App\Data\ProductSearchParams;
use App\Data\SearchParams;
use App\Data\ShowcaseSearchParams;
use App\Enums\ProductOrderType;
use App\Enums\ShowcaseType;
use App\Http\Controllers\Controller;
use App\Repositories\CollectionRepository;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ShowcaseRepository;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CollectionRepository $collectionRepository,
        protected PostRepository $postRepository,
        protected ShowcaseRepository $showcaseRepository
    ) {}

    public function index()
    {
        $products = $this->productRepository->search(
            new ProductSearchParams(['perPage' => 4, 'orderType' => ProductOrderType::BEST_SELLING])
        );
        $posts = $this->postRepository->search(
            new SearchParams(['perPage' => 4])
        );
        $testimonials = $this->showcaseRepository->search(
            new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Testimonial])
        );
        $partners = $this->showcaseRepository->search(
            new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Partner])
        );

        return Inertia::render('home', [
            'products' => $products,
            'posts' => $posts,
            'testimonials' => $testimonials,
            'partners' => $partners,
        ]);
    }
}
