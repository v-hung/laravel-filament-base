<?php

namespace App\Data;

use App\Enums\ProductOrderType;

class ProductSearchParams extends SearchParams
{
    public ?string $search = null;
    public ?float $price_min = null;
    public ?float $price_max = null;
    public ?ProductOrderType $order_type = null;
    public array $collections = [];
}
