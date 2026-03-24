<?php

namespace App\Http\Controllers\Site;

use App\Data\ProductSearchParams;
use App\Data\SearchParams;
use App\Enums\ProductOrderType;
use App\Http\Controllers\Controller;
use App\Repositories\CollectionRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;

class HomeController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CollectionRepository $collectionRepository,
        protected PageRepository $pageRepository,
    ) {}

    public function index()
    {
        $latestProducts = $this->productRepository->search(
            new ProductSearchParams(['perPage' => 6, 'orderType' => ProductOrderType::LATEST])
        );
        $pages = $this->pageRepository->search(
            new SearchParams(['perPage' => 3])
        );
        $collections = $this->collectionRepository->search(new SearchParams(['perPage' => 3]));

        return $this->render('home', [
            'latestProducts' => $latestProducts,
            'pages' => $pages,
            'collections' => $collections,
            'sections' => $this->pageRepository->getPageSections('home'),
        ]);
    }
}
