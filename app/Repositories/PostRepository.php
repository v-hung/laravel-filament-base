<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository
{

    public function search(?SearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new SearchParams();

        return Post::query()
            ->where('status', ContentStatus::Published)
            ->with(['categories' => function ($q) {
                $q->limit(1);
            }])
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function findBySlug(string $slug): ?Post
    {
        return Post::with('categories')->where('status', ContentStatus::Published)->where('slug', $slug)->firstOrFail();
    }
}
