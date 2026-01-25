<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EcommerceStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('widgets.ecommerce_stats.today_revenue'), number_format(Order::whereDate('created_at', today())->sum('total'), 0) . '₫')
                ->description(__('widgets.ecommerce_stats.today_revenue_desc'))
                ->color('success'),

            Stat::make(__('widgets.ecommerce_stats.total_orders'), Order::count())
                ->description(__('widgets.ecommerce_stats.total_orders_desc'))
                ->color('danger'),

            Stat::make(__('widgets.ecommerce_stats.customers'), User::role('customer')->count())
                ->description(__('widgets.ecommerce_stats.customers_desc'))
                ->color('primary'),
        ];
    }
}
