<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository
{
    public function search(?SearchParams $params = null, ?array $excludeIds = []): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        $query = Post::query()
            ->where('status', ContentStatus::Published);

        if (! empty($excludeIds)) {
            $query->whereNotIn('id', $excludeIds);
        }

        return $query
            ->with(['categories' => function ($q) {
                $q->limit(1);
            }])
            ->orderBy($params->sortBy, $params->sortDirection)
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function findBySlug(string $slug): ?Post
    {
        return Post::with('categories')
            ->where('status', ContentStatus::Published)
            ->whereSlug($slug)
            ->firstOrFail();
    }
}
