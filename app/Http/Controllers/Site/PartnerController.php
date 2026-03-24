<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Repositories\PageRepository;

class PartnerController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository,
    ) {}

    public function index()
    {
        return $this->render('site/partner', [
            'sections' => BaseResource::formatArray($this->pageRepository->getPageSections('partner')),
        ]);
    }
}
