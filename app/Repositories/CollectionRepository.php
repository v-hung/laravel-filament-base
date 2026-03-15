<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\CategoryStatus;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class CollectionRepository
{
    public function search(?SearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new SearchParams;

        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->orderBy($params->sortBy, $params->sortDirection)
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function findBySlug(string $slug): ?Collection
    {
        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->where(function ($q) use ($slug): void {
                $q->where('slug->vi', $slug)->orWhere('slug->en', $slug);
            })
            ->first();
    }

    public function getAll(): EloquentCollection
    {
        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->get();
    }
}
