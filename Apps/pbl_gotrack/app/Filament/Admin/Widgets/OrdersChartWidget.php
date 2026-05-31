<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class OrdersChartWidget extends ChartWidget
{
    protected ?string $heading = 'Grafik Penjualan Bulanan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = collect(range(5, 0))->mapWithKeys(function ($monthsAgo) {
            $date = Carbon::now()->subMonths($monthsAgo);
            $monthName = $date->translatedFormat('F');

            $totalSales = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereIn('payment_status', ['paid', 'dp'])
                ->sum('total_price');

            return [$monthName => $totalSales];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan (Rp)',
                    'data' => $data->values()->all(),
                    'backgroundColor' => 'rgba(251, 191, 36, 0.2)', // Amber with opacity
                    'borderColor' => '#fbbf24', // Amber
                    'borderWidth' => 2,
                    'fill' => 'start',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $data->keys()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
