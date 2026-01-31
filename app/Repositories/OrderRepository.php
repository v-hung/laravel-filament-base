<?php

namespace App\Repositories;

use App\Data\SearchParams;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function search(?SearchParams $params = null): LengthAwarePaginator
    {
        $params ??= new SearchParams();

        return Order::query()->with(['items.product'])
            ->where('user_id', Auth::id())
            ->paginate(
                perPage: $params->perPage,
                page: $params->page
            );
    }

    public function getByCode(string $code): Order
    {
        return Order::query()->with(['items.product'])
            ->where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }
}
