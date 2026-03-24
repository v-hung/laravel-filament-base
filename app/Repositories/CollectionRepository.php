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
            ->whereSlug($slug)
            ->first();
    }

    public function getAll(): EloquentCollection
    {
        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->get();
    }

    /**
     * @param  int[]  $ids
     */
    public function getByIds(array $ids): EloquentCollection
    {
        return Collection::query()
            ->with('media')
            ->where('status', CategoryStatus::Active)
            ->whereIn('id', $ids)
            ->get();
    }
}
