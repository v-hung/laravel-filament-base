<?php

namespace App\Repositories;

use App\Data\ShowcaseSearchParams;
use App\Enums\Status;
use App\Models\Showcase;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowcaseRepository
{
    public function search(?ShowcaseSearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new ShowcaseSearchParams;

        $query = Showcase::query();

        if ($params->type) {
            $query = $query->where('type', $params->type);
        }

        return $query
            ->where('status', Status::Active)
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }
}
