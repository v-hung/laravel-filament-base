<?php

namespace App\Enums;

enum ProductOrderType: string
{
    case BEST_SELLING = 'best_selling';
    case FEATURED = 'featured';
    case LATEST = 'latest';
    case PRICE_ASC = 'price_asc';
    case PRICE_DESC = 'price_desc';
}
