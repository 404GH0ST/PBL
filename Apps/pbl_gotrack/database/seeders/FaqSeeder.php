<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara memesan produk di Deenhag?',
                'answer' => 'Pelanggan dapat memilih produk melalui katalog, kemudian menghubungi admin melalui WhatsApp untuk konsultasi desain, jumlah pesanan, ukuran, dan estimasi biaya. Setelah pembayaran dilakukan, admin akan membuat data pesanan dan mengirimkan kode tracking.',
            ],
            [
                'question' => 'Di mana pelanggan dapat melihat progres pesanan?',
                'answer' => 'Pelanggan dapat membuka menu Lacak Pesanan, memasukkan kode tracking yang diberikan admin, lalu melihat status produksi, riwayat progres, dan informasi pesanan secara mandiri.',
            ],
            [
                'question' => 'Apakah pelanggan harus login untuk melacak pesanan?',
                'answer' => 'Tidak. Pelanggan cukup menggunakan kode tracking yang dikirimkan melalui WhatsApp setelah pesanan dibuat oleh admin.',
            ],
            [
                'question' => 'Kapan pelanggan dapat memberikan ulasan?',
                'answer' => 'Ulasan dapat diberikan setelah pesanan selesai atau saat pelanggan mengonfirmasi bahwa pesanan sudah diterima dengan baik.',
            ],
            [
                'question' => 'Produk apa saja yang tersedia di katalog?',
                'answer' => 'Katalog menampilkan layanan digital printing dan konveksi seperti jersey, banner atau spanduk, serta stempel. Produk dapat dilihat berdasarkan kategori dan detail harga.',
            ],
            [
                'question' => 'Siapa yang memperbarui status pesanan?',
                'answer' => 'Admin memperbarui status pesanan melalui dashboard. Setiap perubahan progres akan tampil pada halaman tracking pelanggan sesuai kode pesanan.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::updateOrCreate(
                [
                    'question' => $faq['question'],
                    'sort_order' => $index + 1,
                ],
                [
                    'answer' => $faq['answer'],
                    'is_active' => true,
                ],
            );
        }
    }
}
