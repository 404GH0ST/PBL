<?php

namespace Database\Seeders;

use App\Models\OrderingStep;
use Illuminate\Database\Seeder;

class OrderingStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'number' => '01',
                'title' => 'Pilih Produk',
                'description' => 'Pilih produk apparel, media promosi, stempel, atau banner sesuai kebutuhan Anda dari katalog kami.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'number' => '02',
                'title' => 'Konsultasi',
                'description' => 'Diskusikan detail desain, bahan, ukuran, dan jumlah pesanan dengan tim desain kami via WhatsApp.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'number' => '03',
                'title' => 'Pembayaran',
                'description' => 'Lakukan pembayaran uang muka (DP) atau lunas secara aman sesuai dengan instruksi tagihan.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'number' => '04',
                'title' => 'Produksi',
                'description' => 'Pesanan Anda diproduksi dengan mesin cetak dan jahitan berkualitas tinggi. Pantau progresnya via tracking code.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'number' => '05',
                'title' => 'Pengiriman',
                'description' => 'Setelah produk selesai dikemas dan lolos QC, pesanan akan dikirim ke alamat Anda atau dapat diambil langsung.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            OrderingStep::updateOrCreate(
                ['number' => $step['number']],
                $step
            );
        }
    }
}
