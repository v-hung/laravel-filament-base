<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class RevenueChart extends ChartWidget
{
    public function getHeading(): string | Htmlable | null
    {
        return __('widgets.revenue_chart.heading');
    }

    protected function getData(): array
    {
        $start = now()->subDays(29)->startOfDay();
        $end   = now()->endOfDay();

        $orders = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date'); // key = date, value = total

        $days = collect(range(0, 29))
            ->map(fn($i) => now()->subDays($i)->format('Y-m-d'))
            ->reverse()
            ->values();

        $data = $days->map(fn($day) => $orders[$day] ?? 0);

        return [
            'datasets' => [
                [
                    'label' => __('widgets.revenue_chart.label'),
                    'data' => $data,
                ],
            ],
            'labels' => $days->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
