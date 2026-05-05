<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddon;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $jerseyCategory = Category::where('name', 'Jersey')->first();
        $jerseyProduct = Product::where('name', 'Jersey Voli (Atasan Saja)')->first();

        if (!$jerseyCategory || !$jerseyProduct) return;

        $selectedJerseyAddons = ProductAddon::where('category_id', $jerseyCategory->id)
            ->whereIn('name', ['Dropnidle', 'Kerah Resleting Full', 'Lengan Panjang', 'XXL'])
            ->pluck('id')
            ->toArray();

        Order::create([
            'tracking_id' => 'CTX-DUMMY001',
            'customer_name' => 'Budi Santoso (Tim FC Malang)',
            'customer_whatsapp' => '081234567890',
            'product_id' => $jerseyProduct->id,
            'status' => 'processing',

            // --- STRUKTUR JSON BARU SESUAI FORMAT REPEATER ---
            'selected_addons' => [
                [
                    'addons' => $selectedJerseyAddons, // Berisi array ID variasi (misal XXL, Dropnidle)
                    'quantity' => 12 // Qty khusus baris ini
                ]
            ],

            'quantity' => 12, // Total kuantitas keseluruhan
            'total_price' => (90000 + 15000 + 25000 + 15000 + 10000) * 12,
            'payment_status' => 'dp',
            'dp_amount' => 1000000,
            'notes' => 'Tolong dijahit yang rapi, lengan panjang semua.',
        ]);
    }
}
