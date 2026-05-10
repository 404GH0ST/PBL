<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $completedOrder = Order::where('tracking_id', 'CTX-DONE001')->first();

        if (!$completedOrder || !$completedOrder->product_id) {
            $this->command?->warn('Order demo selesai belum tersedia untuk ReviewSeeder.');

            return;
        }

        Review::updateOrCreate(
            ['order_id' => $completedOrder->id],
            [
                'product_id' => $completedOrder->product_id,
                'product_rating' => 5,
                'service_rating' => 5,
                'comment' => 'Hasil jersey rapi, warna tajam, dan pengiriman sesuai info tracking. Sangat memudahkan karena prosesnya jelas dari awal sampai barang diterima.',
                'is_visible' => true,
                'created_at' => $completedOrder->completed_at ?? now()->subDays(2)->setTime(16, 0),
                'updated_at' => $completedOrder->completed_at ?? now()->subDays(2)->setTime(16, 0),
            ]
        );
    }
}
