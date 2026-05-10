<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProgress;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderProgressSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('email', 'admin@gmail.com')->first();
        $stage = ProductionStage::where('name', 'Finishing / QC')->first()
            ?? ProductionStage::where('name', 'Proses Jahit')->first()
            ?? ProductionStage::first();

        if (!$staff || !$stage) {
            return;
        }

        $this->seedForTrackingId('CTX-PROC001', [
            ['title' => 'Proses Sablon', 'created_at' => now()->subDay()->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDay()->setTime(15, 0)],
        ], $staff->id, $stage->id);

        $this->seedForTrackingId('CTX-SHIP001', [
            ['title' => 'Pesanan di Terima', 'created_at' => now()->subDays(3)->setTime(17, 0)],
            ['title' => 'Proses Sablon', 'created_at' => now()->subDays(2)->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDays(2)->setTime(15, 0)],
            ['title' => 'Pesanan di Kemas', 'created_at' => now()->subDay()->setTime(8, 0)],
            ['title' => 'Pesanan Diserahkan Kurir', 'created_at' => now()->subDay()->setTime(14, 0)],
        ], $staff->id, $stage->id);

        $this->seedForTrackingId('CTX-DONE001', [
            ['title' => 'Pesanan di Terima', 'created_at' => now()->subDays(5)->setTime(17, 0)],
            ['title' => 'Proses Sablon', 'created_at' => now()->subDays(4)->setTime(9, 0)],
            ['title' => 'Finishing', 'created_at' => now()->subDays(4)->setTime(15, 0)],
            ['title' => 'Pesanan di Kemas', 'created_at' => now()->subDays(3)->setTime(8, 0)],
            ['title' => 'Pesanan Diserahkan Kurir', 'created_at' => now()->subDays(3)->setTime(14, 0)],
        ], $staff->id, $stage->id);
    }

    /**
     * @param array<int, array{title: string, created_at: \Illuminate\Support\Carbon}> $items
     */
    protected function seedForTrackingId(string $trackingId, array $items, int $staffId, int $stageId): void
    {
        $order = Order::where('tracking_id', $trackingId)->first();

        if (!$order) {
            return;
        }

        OrderProgress::where('order_id', $order->id)->delete();

        foreach ($items as $item) {
            OrderProgress::create([
                'order_id' => $order->id,
                'production_stage_id' => $stageId,
                'staff_id' => $staffId,
                'title' => $item['title'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['created_at'],
            ]);
        }
    }
}
