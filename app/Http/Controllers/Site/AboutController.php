<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Repositories\PageRepository;

class AboutController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository,
    ) {}

    public function index()
    {
        return $this->render('site/about', [
            'sections' => BaseResource::formatArray($this->pageRepository->getPageSections('about')),
        ]);
    }
}
