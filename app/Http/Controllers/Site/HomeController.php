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
        $latestProducts = $this->productRepository->search(
            new ProductSearchParams(['perPage' => 6, 'orderType' => ProductOrderType::LATEST])
        );
        $posts = $this->postRepository->search(
            new SearchParams(['perPage' => 3])
        );
        $collections = $this->collectionRepository->search(new SearchParams(['perPage' => 3]));

        return $this->render('home', [
            'latestProducts' => $latestProducts,
            'posts' => $posts,
            'collections' => $collections
        ]);
    }

    public function partner()
    {
        return $this->render('site/partner');
    }
}
