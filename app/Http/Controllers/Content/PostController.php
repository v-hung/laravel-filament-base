<?php

namespace App\Http\Controllers\Content;

use App\Data\SearchParams;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\Shared\SharedData;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends InertiaController
{
    protected $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = SearchParams::fromRequest($request);
        $request->perPage = 9;

        $posts = $this->postRepository->search($request);

        return $this->inertia('Content/Posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = $this->postRepository->findBySlug($slug);

        return $this->inertia('Content/PostDetail', [
            'post' => $post
        ]);
    }
}
