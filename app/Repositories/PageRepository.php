<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\ContentStatus;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class PageRepository
{
    public function search(?SearchParams $params = null, ?array $excludeIds = []): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        $query = Page::query()
            ->where('status', ContentStatus::Published);

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
        $query = Page::with('categories')->where('status', ContentStatus::Published);

        foreach (['vi', 'en'] as $locale) {
            $query->orWhere("slug->$locale", $slug);
        }

        return $query->firstOrFail();
    }
}
