<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class PageRepository
{
    public function search(?SearchParams $params = null, ?array $excludeIds = []): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        $query = Page::query()
            ->where('status', ContentStatus::Published)
            ->where('page_type', PageType::Regular);

        if (!empty($excludeIds)) {
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

    public function findBySlug(string $slug): ?Page
    {
        return Page::with('categories')
            ->where('status', ContentStatus::Published)
            ->where(function ($q) use ($slug) {
                $q->where('slug->vi', $slug)
                    ->orWhere('slug->en', $slug);
            })
            ->firstOrFail();
    }
}
