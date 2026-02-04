<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class PageRepository
{
    public function search(?SearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        return Page::query()
            ->where('status', ContentStatus::Published)
            ->with(['categories' => function ($q) {
                $q->limit(1);
            }])
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function findBySlug(string $slug): ?Page
    {
        return Page::with('categories')->where('status', ContentStatus::Published)->where('slug', $slug)->firstOrFail();
    }
}
