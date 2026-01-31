<?php

namespace App\Http\Controllers\Site;

use App\Data\ShowcaseSearchParams;
use App\Enums\ShowcaseType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\ShowcaseRepository;
use Illuminate\Http\Request;

class AboutController extends Controller
{

	public function __construct(
		protected ShowcaseRepository $showcaseRepository
	) {}

	public function index()
	{
		$testimonials = $this->showcaseRepository->search(new ShowcaseSearchParams(['perPage' => 6, 'type' => ShowcaseType::Testimonial]));

		return $this->render('site/about', [
			'testimonials' => $testimonials
		]);
	}
}
