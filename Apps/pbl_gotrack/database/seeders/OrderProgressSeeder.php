<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProgress;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderProgressSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('email', 'admin@gmail.com')->first();

        if (! $staff) {
            return;
        }

        // Map judul progress ke nama production stage yang sesuai
        $stageMap = [
            'Pesanan di Terima' => 'Menunggu Antrean',
            'Proses Sablon' => 'Cetak Sublim / Film',
            'Finishing' => 'Finishing / QC',
            'Pesanan di Kemas' => 'Siap Diambil',
            'Pesanan Diserahkan Kurir' => 'Siap Diambil',
        ];

        $this->seedForTrackingId('CTX-PROC001', [
            ['title' => 'Proses Sablon', 'created_at' => now()->subDay()->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDay()->setTime(15, 0)],
        ], $staff->id, $stageMap);

        $this->seedForTrackingId('CTX-SHIP001', [
            ['title' => 'Pesanan di Terima', 'created_at' => now()->subDays(3)->setTime(17, 0)],
            ['title' => 'Proses Sablon', 'created_at' => now()->subDays(2)->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDays(2)->setTime(15, 0)],
            ['title' => 'Pesanan di Kemas', 'created_at' => now()->subDay()->setTime(8, 0)],
            ['title' => 'Pesanan Diserahkan Kurir', 'created_at' => now()->subDay()->setTime(14, 0)],
        ], $staff->id, $stageMap);

        $this->seedForTrackingId('CTX-DONE001', [
            ['title' => 'Pesanan di Terima', 'created_at' => now()->subDays(5)->setTime(17, 0)],
            ['title' => 'Proses Sablon', 'created_at' => now()->subDays(4)->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDays(4)->setTime(15, 0)],
            ['title' => 'Pesanan di Kemas', 'created_at' => now()->subDays(3)->setTime(8, 0)],
            ['title' => 'Pesanan Diserahkan Kurir', 'created_at' => now()->subDays(3)->setTime(14, 0)],
        ], $staff->id, $stageMap);
    }

    /**
     * @param  array<int, array{title: string, created_at: Carbon}>  $items
     * @param  array<string, string>  $stageMap
     */
    protected function seedForTrackingId(string $trackingId, array $items, int $staffId, array $stageMap): void
    {
        $order = Order::where('tracking_id', $trackingId)->first();

        if (! $order) {
            return;
        }

        OrderProgress::where('order_id', $order->id)->delete();

        foreach ($items as $item) {
            $stageName = $stageMap[$item['title']] ?? null;
            $stage = $stageName ? ProductionStage::where('name', $stageName)->first() : ProductionStage::first();

            OrderProgress::create([
                'order_id' => $order->id,
                'production_stage_id' => $stage?->id ?? ProductionStage::first()?->id,
                'staff_id' => $staffId,
                'title' => $item['title'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['created_at'],
            ]);
        }
    }
}
