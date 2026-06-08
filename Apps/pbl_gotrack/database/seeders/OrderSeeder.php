<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAddon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $jerseyCategory = Category::where('name', 'Jersey')->first();
        $jerseyProduct = Product::where('name', 'Jersey Voli (Atasan Saja)')->first();

        if (! $jerseyCategory || ! $jerseyProduct) {
            return;
        }

        $selectedJerseyAddons = ProductAddon::where('category_id', $jerseyCategory->id)
            ->whereIn('name', ['Dropnidle', 'Kerah Resleting Full', 'Lengan Panjang', 'XXL'])
            ->pluck('id')
            ->values()
            ->all();

        $basePayload = [
            'product_id' => $jerseyProduct->id,
            'selected_addons' => [
                [
                    'addons' => $selectedJerseyAddons,
                    'quantity' => 12,
                ],
            ],
            'quantity' => 12,
            'total_price' => (90000 + 15000 + 25000 + 15000 + 10000) * 12,
            'payment_status' => 'dp',
            'dp_amount' => 1000000,
            'paid_amount' => 1000000,
        ];

        Order::updateOrCreate(
            ['tracking_id' => 'CTX-PROC001'],
            array_merge($basePayload, [
                'customer_name' => 'Budi Santoso (Tim FC Malang)',
                'customer_whatsapp' => '081234567890',
                'shipping_address' => 'Jl. Soekarno Hatta No. 19, Lowokwaru, Malang, Jawa Timur',
                'notes' => 'Tolong dijahit yang rapi, lengan panjang semua.',
                'status' => 'processing',
                'shipped_at' => null,
                'completed_at' => null,
                'customer_confirmed_at' => null,
            ])
        );

        Order::updateOrCreate(
            ['tracking_id' => 'CTX-SHIP001'],
            array_merge($basePayload, [
                'customer_name' => 'Fahrul Kz',
                'customer_whatsapp' => '+62 819 5963 1249',
                'shipping_address' => 'Rt 41/Rw 11 Jln Kembang Turi No. 9A, Jatimulyo, Lowokwaru, Malang, Jawa Timur',
                'notes' => 'Titip ke satpam kalau pengantaran di atas jam 5 sore.',
                'payment_type' => 'paid',
                'payment_status' => 'paid',
                'dp_amount' => null,
                'paid_amount' => (90000 + 15000 + 25000 + 15000 + 10000) * 12,
                'paid_at' => now()->subDays(2)->setTime(13, 30),
                'status' => 'shipped',
                'shipped_at' => now()->subDays(2)->setTime(14, 0),
                'completed_at' => null,
                'customer_confirmed_at' => null,
            ])
        );

        Order::updateOrCreate(
            ['tracking_id' => 'CTX-DONE001'],
            array_merge($basePayload, [
                'customer_name' => 'Ajeng Febria',
                'customer_whatsapp' => '+62 812 3344 5566',
                'shipping_address' => 'Jl. Candi Mendut No. 8, Blimbing, Malang, Jawa Timur',
                'notes' => 'Nomor punggung 10, 11, dan 12 mohon dibedakan ukuran L.',
                'payment_type' => 'paid',
                'payment_status' => 'paid',
                'dp_amount' => null,
                'paid_amount' => (90000 + 15000 + 25000 + 15000 + 10000) * 12,
                'paid_at' => now()->subDays(2)->setTime(16, 0),
                'status' => 'completed',
                'shipped_at' => now()->subDays(4)->setTime(14, 0),
                'completed_at' => now()->subDays(2)->setTime(16, 0),
                'customer_confirmed_at' => now()->subDays(2)->setTime(16, 0),
            ])
        );
    }
}
