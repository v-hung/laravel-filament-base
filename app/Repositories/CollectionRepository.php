<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Enums\CategoryStatus;
use App\Models\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CollectionRepository
{
    public function search(?SearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new SearchParams();

        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function getAll(): EloquentCollection
    {
        return Collection::query()
            ->where('status', CategoryStatus::Active)
            ->get();
    }
}
