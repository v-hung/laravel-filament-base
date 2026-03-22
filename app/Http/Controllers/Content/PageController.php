<?php

namespace App\Http\Controllers\Content;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\TwoColumnBlock;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Throwable;

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
        try {
            $page = $this->pageRepository->findBySlug($slug);

            $renderedContent = collect($page->getTranslations('content'))
                ->map(
                    fn(string $html) => RichContentRenderer::make($html)
                        ->customBlocks([TwoColumnBlock::class])
                        ->toHtml()
                )
                ->toArray();

            return $this->render('content/page-detail', [
                'page' => array_merge($page->toArray(), ['content' => $renderedContent])
            ]);
        } catch (Throwable $e) {
            $this->flash('toast', ['type' => 'error', 'message' => __('shop.page.not_found')]);

            return back();
        }
    }
}
