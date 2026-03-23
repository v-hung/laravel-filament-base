<?php

namespace App\Http\Controllers\Site;

use App\Data\ShowcaseSearchParams;
use App\Enums\ShowcaseType;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\ShowcaseRepository;

class AboutController extends Controller
{
    public function __construct(
        protected ShowcaseRepository $showcaseRepository,
        protected PageRepository $pageRepository,
    ) {}

    public function index()
    {
        $testimonials = $this->showcaseRepository->search(new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Testimonial]));

        return $this->render('site/about', [
            'testimonials' => $testimonials,
            'sections' => $this->pageRepository->getPageSectionsWithImages('about'),
        ]);
    }
}
