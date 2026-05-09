<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::whereNotNull('product_id')->take(5)->get();

        if ($orders->isEmpty()) {
            $this->command->warn('Tidak ada data Order dengan product_id. Silakan buat pesanan (Order) terlebih dahulu.');
            return;
        }

        // Kumpulan contoh ulasan dengan 2 tipe rating
        $dummyReviews = [
            [
                'product_rating' => 5,
                'service_rating' => 5,
                'comment' => 'Kualitas cetakan sangat bagus, warnanya tajam! Admin juga sangat ramah dan responsif saat saya minta revisi desain.',
                'is_visible' => true, // Ditampilkan ke publik
            ],
            [
                'product_rating' => 4,
                'service_rating' => 5,
                'comment' => 'Bahan kaosnya adem, sablon DTF-nya rapi banget. Pengiriman super cepat dari estimasi.',
                'is_visible' => true,
            ],
            [
                'product_rating' => 5,
                'service_rating' => 4,
                'comment' => 'Hasil cetak banner memuaskan, sesuai dengan file asli. Harganya juga paling terjangkau dibanding percetakan lain.',
                'is_visible' => true,
            ],
            [
                'product_rating' => 3,
                'service_rating' => 4,
                'comment' => 'Secara umum bagus, tapi sayangnya ada sedikit goresan di pinggir brosur. Mungkin packingnya bisa lebih aman lagi.',
                'is_visible' => false, // Sengaja disembunyikan agar tidak tampil di website utama
            ],
            [
                'product_rating' => 5,
                'service_rating' => 5,
                'comment' => 'Sangat recommended untuk cetak stiker die-cut! Potongannya presisi banget.',
                'is_visible' => true,
            ],
        ];

        // Looping untuk memasukkan data ulasan dan mengaitkannya ke Order & Product
        foreach ($orders as $index => $order) {
            if (isset($dummyReviews[$index])) {
                Review::create([
                    'order_id' => $order->id,
                    'product_id' => $order->product_id, // Otomatis ditarik dari Order
                    'product_rating' => $dummyReviews[$index]['product_rating'],
                    'service_rating' => $dummyReviews[$index]['service_rating'],
                    'comment' => $dummyReviews[$index]['comment'],
                    'is_visible' => $dummyReviews[$index]['is_visible'],
                ]);
            }
        }

        $this->command->info('Data dummy Reviews (Ulasan) berhasil ditambahkan!');
    }
}
