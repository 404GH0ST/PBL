<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::whereIn('payment_status', ['paid', 'dp'])
            ->get(['payment_status', 'total_price', 'paid_amount', 'dp_amount'])
            ->sum->received_revenue;
        $processingOrders = Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        return [
            Stat::make('Total Pesanan', $totalOrders)
                ->description('Jumlah transaksi pesanan masuk')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),

            Stat::make('Total Pendapatan', 'Rp '.number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pembayaran yang sudah diterima')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pesanan Diproses', $processingOrders)
                ->description('Sedang dalam tahap produksi')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),

            Stat::make('Pesanan Selesai', $completedOrders)
                ->description('Sudah diterima pelanggan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
