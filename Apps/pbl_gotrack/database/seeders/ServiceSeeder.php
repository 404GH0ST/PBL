<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'number' => '01',
                'title' => 'Konveksi Apparel',
                'subtitle' => 'Kualitas jahitan rapi',
                'description' => 'Pembuatan pakaian custom berkualitas tinggi seperti jersey, kaos, kemeja, jaket, dan seragam sesuai desain keinginan Anda.',
                'active_background' => 'bg-[#101218]',
                'feature_product' => 'konveksi-apparel',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'number' => '02',
                'title' => 'Media Promosi',
                'subtitle' => 'Cetak cepat & akurat',
                'description' => 'Nota custom berkualitas untuk kebutuhan transaksi usaha, toko, dan bisnis dengan hasil cetak yang rapi dan profesional.',
                'active_background' => 'bg-[#04111d]',
                'feature_product' => 'media-promosi',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'number' => '03',
                'title' => 'Cetak DTF',
                'subtitle' => 'Hasil tajam',
                'description' => 'Cetak stiker sablon DTF (Direct to Film) siap tempel dengan warna solid, detail tajam, dan daya tahan cuci yang luar biasa.',
                'active_background' => 'bg-[#101218]',
                'feature_product' => 'cetak-dtf',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'number' => '04',
                'title' => 'Kebutuhan Bisnis',
                'subtitle' => 'Profesionalitas terjamin',
                'description' => 'Layanan pembuatan stempel custom yang praktis dan profesional untuk menunjang identitas serta kebutuhan administrasi bisnis Anda.',
                'active_background' => 'bg-[#04111d]',
                'feature_product' => 'kebutuhan-bisnis',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
