<?php

namespace App\Http\Controllers\Content;

use App\Data\SearchParams;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        protected PostRepository $postRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = SearchParams::fromRequest($request);
        $request->perPage = 9;

        $posts = $this->postRepository->search($request);

        return $this->render('content/posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = $this->postRepository->findBySlug($slug);

        return $this->render('content/post-detail', [
            'post' => $post,
        ]);
    }
}
