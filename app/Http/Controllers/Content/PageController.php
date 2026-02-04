<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;

class PageController extends Controller
{
    public function __construct(
        protected PageRepository $pageRepository
    ) {}

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page = $this->pageRepository->findBySlug($slug);

        return $this->render('content/page-detail', [
            'page' => $page,
        ]);
    }
}
