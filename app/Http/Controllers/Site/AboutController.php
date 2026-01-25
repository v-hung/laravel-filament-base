<?php

namespace App\Http\Controllers\Site;

use App\Data\ShowcaseSearchParams;
use App\Enums\ShowcaseType;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\ShowcaseRepository;
use Illuminate\Http\Request;

class AboutController extends InertiaController
{
    protected $showcaseRepository;

    public function __construct(
        ShowcaseRepository $showcaseRepository
    ) {
        $this->showcaseRepository = $showcaseRepository;
    }

    public function index()
    {
        $testimonials = $this->showcaseRepository->search(new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Testimonial]));

        return $this->inertia('Site/About', [
            'testimonials' => $testimonials
        ]);
    }
}
