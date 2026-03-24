<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;

class PartnerController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository,
    ) {}

    public function index()
    {
        return $this->render('site/partner', [
            'sections' => $this->pageRepository->getPageSections('partner'),
        ]);
    }
}
