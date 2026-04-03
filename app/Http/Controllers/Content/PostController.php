<?php

namespace App\Http\Controllers\Content;

use App\Data\SearchParams;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\TwoColumnBlock;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    public function __construct(
        protected PostRepository $postRepository,
        protected PageRepository $pageRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = SearchParams::fromRequest($request);
        $request->perPage = 8;

        $posts = $this->pageRepository->search($request);

        return $this->render('content/posts', [
            'posts' => BaseResource::collection($posts),
            'sections' => BaseResource::formatArray($this->pageRepository->getPageSections('posts')),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $post = $this->postRepository->findBySlug($slug);
            $other_posts = $this->postRepository->search(new SearchParams(['perPage' => 3]), [$post->id]);

            $renderedContent = collect($post->getTranslations('content'))
                ->map(
                    fn(string $html) => RichContentRenderer::make($html)
                        ->customBlocks([TwoColumnBlock::class])
                        ->toHtml()
                )
                ->toArray();

            return $this->render('content/post-detail', [
                'post' => BaseResource::formatArray(array_merge(
                    $post->toArray(),
                    ['content' => $renderedContent]
                )),
                'other_posts' => BaseResource::collection($other_posts),
            ]);
        } catch (Throwable $e) {
            $this->flash('toast', ['type' => 'error', 'message' => __('shop.post.not_found')]);

            return back();
        }
    }
}
