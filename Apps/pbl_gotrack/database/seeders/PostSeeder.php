<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('email', 'admin@gmail.com')->first()
            ?? User::first();

        if (! $author) {
            $this->command?->warn('No users found. Skipping PostSeeder.');

            return;
        }

        $posts = [
            [
                'category' => 'Fashion',
                'title' => 'Tren Streetwear Lokal 2026: Kolaborasi Konveksi dan Brand Komunitas',
                'excerpt' => 'Streetwear lokal semakin mengukuhkan posisinya di tahun 2026. Kolaborasi antara konveksi skala kecil dan brand komunitas menciptakan identitas visual yang unik dan dekat dengan anak muda.',
                'seed' => 'streetwear-lokal-2026',
                'image' => 'images/catalog/kaos-black.png',
            ],
            [
                'category' => 'Fashion',
                'title' => 'Kenapa Kaos Katun Combed 30s Masih Jadi Favorit Setelah Puluhan Tahun',
                'excerpt' => 'Di balik deretan bahan baru yang bermunculan, combed 30s tetap menjadi pilihan utama brand clothing Indonesia. Apa rahasianya?',
                'seed' => 'combed-30s-favorit',
                'image' => 'images/catalog/kaos-red.png',
            ],
            [
                'category' => 'Gadgets',
                'title' => 'Printer DTF Terbaik 2026 untuk Usaha Konveksi Rumahan',
                'excerpt' => 'Kami merangkum lima printer DTF yang paling banyak dipakai oleh pemilik usaha konveksi rumahan, lengkap dengan kisaran harga dan kapasitas produksinya.',
                'seed' => 'printer-dtf-2026',
                'image' => 'images/product/cetak-dtf.png',
            ],
            [
                'category' => 'Gadgets',
                'title' => 'Laptop Ringkas untuk Desainer Apparel: Rekomendasi di Bawah 15 Juta',
                'excerpt' => 'Kerja desain tidak selalu butuh laptop mahal. Ini daftar laptop di bawah 15 juta yang mampu menjalankan Illustrator, Photoshop, dan CorelDRAW dengan lancar.',
                'seed' => 'laptop-desainer-apparel',
                'image' => 'images/catalog/banner-custom.png',
            ],
            [
                'category' => 'Travel',
                'title' => 'Menelusuri Sentra Konveksi di Jawa: Dari Bandung Hingga Ponorogo',
                'excerpt' => 'Perjalanan singkat melintasi kota-kota penghasil apparel terbesar di Jawa. Setiap daerah punya karakter dan kekuatan produksinya sendiri.',
                'seed' => 'sentra-konveksi-jawa',
                'image' => 'images/catalog/hero-workshop.png',
            ],
            [
                'category' => 'Travel',
                'title' => 'Ponorogo Bukan Hanya Reog: Menemukan Workshop Apparel Tersembunyi',
                'excerpt' => 'Di balik reputasinya sebagai kota budaya, Ponorogo diam-diam menumbuhkan ekosistem konveksi dan digital printing yang layak dilirik.',
                'seed' => 'ponorogo-workshop-apparel',
                'image' => 'images/order/produksi.png',
            ],
            [
                'category' => 'Reviews',
                'title' => 'Review Bahan Cotton Bamboo: Lebih Sejuk, Lebih Mahal, Sepadan?',
                'excerpt' => 'Kami uji kain cotton bamboo selama 30 hari. Bagaimana performanya dibanding combed standar untuk iklim tropis seperti Indonesia?',
                'seed' => 'review-cotton-bamboo',
                'image' => 'images/product/konveksi-apparel.png',
            ],
            [
                'category' => 'Reviews',
                'title' => 'Ulasan Mesin Jahit High Speed untuk Produksi Jersey Batch Besar',
                'excerpt' => 'Mesin jahit high speed jadi kunci kecepatan produksi. Kami bandingkan tiga unit populer di pasaran dengan harga yang berbeda-beda.',
                'seed' => 'mesin-jahit-highspeed',
                'image' => 'images/hero/jersey-front-new.png',
            ],
            [
                'category' => 'Sosial',
                'title' => 'Konveksi Ramah Lingkungan: Bagaimana Limbah Kain Diolah Kembali',
                'excerpt' => 'Industri apparel kerap disebut salah satu penyumbang polusi terbesar. Sejumlah konveksi lokal mulai membuktikan bahwa hal itu bisa diubah.',
                'seed' => 'konveksi-ramah-lingkungan',
                'image' => 'images/about/tentang-kami.png',
            ],
            [
                'category' => 'Sosial',
                'title' => 'Pemberdayaan Penjahit Rumahan: Dari Dapur Menjadi Rantai Produksi',
                'excerpt' => 'Kisah para penjahit rumahan yang kini menjadi bagian penting dalam rantai produksi brand fashion lokal.',
                'seed' => 'pemberdayaan-penjahit',
                'image' => 'images/order/konsultasi.png',
            ],
            [
                'category' => 'Fashion',
                'title' => 'Panduan Memilih Warna Kaos Custom Sesuai Identitas Brand',
                'excerpt' => 'Warna bukan sekadar estetika. Ia adalah bagian dari komunikasi brand. Berikut panduan memilih warna kaos custom yang tepat.',
                'seed' => 'warna-kaos-brand',
                'image' => 'images/product/media-promosi.png',
            ],
            [
                'category' => 'Gadgets',
                'title' => 'Software Desain Gratis yang Tak Kalah dari Adobe untuk Brand Pemula',
                'excerpt' => 'Belum ready untuk langganan bulanan Adobe? Ini alternatif gratis yang digunakan para desainer clothing lokal.',
                'seed' => 'software-desain-gratis',
                'image' => 'images/product/kebutuhan-bisnis.png',
            ],
            [
                'category' => 'Travel',
                'title' => 'Tur Pabrik: Melihat Langsung Proses Cutting Hingga Finishing di Deenhag',
                'excerpt' => 'Kami membuka pintu workshop. Lihat bagaimana satu order jersey diproses dari pola hingga dikemas siap kirim.',
                'seed' => 'tur-pabrik-deenhag',
                'image' => 'images/order/pilih-produk.png',
            ],
            [
                'category' => 'Reviews',
                'title' => 'Uji Ketahanan Cetak DTF pada 50 Kali Pencucian',
                'excerpt' => 'Kami cuci kaos cetak DTF sebanyak 50 kali selama 3 bulan. Hasilnya mengejutkan. Baca laporan lengkapnya.',
                'seed' => 'uji-dtf-50-cuci',
                'image' => 'images/catalog/dtf-kaos.png',
            ],
            [
                'category' => 'Fashion',
                'title' => 'Padu Padan Jersey Retro untuk Gaya Kasual Harian',
                'excerpt' => 'Jersey tidak harus dipakai hanya ke lapangan. Begini cara mengolahnya menjadi outfit kasual yang tetap stylish.',
                'seed' => 'padu-padan-jersey-retro',
                'image' => 'images/hero/jersey-back-new.png',
            ],
        ];

        $now = Carbon::now();

        foreach ($posts as $index => $data) {
            Post::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'author_id' => $author->id,
                    'title' => $data['title'],
                    'category' => $data['category'],
                    'content' => $this->buildContent($data['title'], $data['excerpt']),
                    'excerpt' => $data['excerpt'],
                    'image_path' => $data['image'],
                    'status' => Post::STATUS_PUBLISHED,
                    'is_published' => true,
                    'published_at' => $now->copy()->subDays($index * 2),
                ]
            );
        }
    }

    private function buildContent(string $title, string $excerpt): string
    {
        $paragraphs = [
            $excerpt,
            "{$title} menjadi salah satu topik yang ramai dibicarakan di kalangan pelaku industri kreatif Indonesia. Tren ini tidak muncul begitu saja, melainkan dibentuk oleh perubahan gaya hidup, daya beli, dan ekspektasi konsumen terhadap produk lokal yang makin menuntut kualitas tinggi.",
            'Dari sisi produksi, banyak konveksi yang mulai mengadopsi pendekatan yang lebih modern. Mereka memanfaatkan software desain, alat potong otomatis, hingga sistem manajemen pesanan yang terintegrasi untuk menekan waktu produksi. Hasilnya, pelanggan menerima barang lebih cepat tanpa mengorbankan kualitas jahitan atau akurasi sablon.',
            'Hal menarik lainnya adalah bagaimana komunitas kreatif ikut mendorong standar baru. Brand skala kecil kini lebih berani bereksperimen dengan bahan non-konvensional, pola potongan yang unik, hingga kolaborasi lintas disiplin. Konveksi yang mampu beradaptasi dengan ritme ini biasanya lebih cepat mendapatkan repeat order dari brand-brand muda.',
            'Meski begitu, tantangan tetap ada. Biaya bahan baku yang fluktuatif, persaingan harga, dan ekspektasi turnaround time yang semakin pendek menjadi ujian nyata. Konveksi yang mampu menjaga konsistensi kualitas sambil memberikan layanan responsif biasanya yang akan bertahan dalam jangka panjang.',
            'Bagi Anda yang sedang mempertimbangkan untuk memulai brand atau memindahkan produksi, artikel ini semoga memberi gambaran yang lebih lengkap. Di Deenhag sendiri, kami terus berusaha menjaga keseimbangan antara efisiensi produksi dan kualitas yang kami tawarkan untuk setiap pelanggan.',
        ];

        return implode("\n\n", $paragraphs);
    }
}
