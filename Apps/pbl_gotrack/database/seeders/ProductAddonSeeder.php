<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ProductAddon;

class ProductAddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jerseyId = Category::where('name', 'Jersey')->value('id');
        $bannerId = Category::where('name', 'Banner / Spanduk')->value('id');
        $stempelId = Category::where('name', 'Stempel')->value('id');

        if (!$jerseyId) return;

        // ---- VARIASI JERSEY ----
        $addonsJersey = [
            ['type' => 'Material Kain', 'name' => 'Milano', 'price' => 0],
            ['type' => 'Material Kain', 'name' => 'Brazil', 'price' => 0],
            ['type' => 'Material Kain', 'name' => 'Dropnidle', 'price' => 15000],
            ['type' => 'Material Kain', 'name' => 'Embosh Topo', 'price' => 20000],

            ['type' => 'Jenis Kerah', 'name' => 'V-Neck Jahit Tengah', 'price' => 0],
            ['type' => 'Jenis Kerah', 'name' => 'V-Neck Jahit Rata', 'price' => 5000],
            ['type' => 'Jenis Kerah', 'name' => 'Kerah Polo Kain', 'price' => 15000],
            ['type' => 'Jenis Kerah', 'name' => 'Kerah Resleting Full', 'price' => 25000],

            ['type' => 'Jenis Lengan', 'name' => 'Lengan Pendek', 'price' => 0],
            ['type' => 'Jenis Lengan', 'name' => 'Lengan Panjang', 'price' => 15000],
            ['type' => 'Jenis Lengan', 'name' => 'Rib Lengan (Karet)', 'price' => 5000],

            ['type' => 'Ukuran (Size)', 'name' => 'Standar (S - XL)', 'price' => 0],
            ['type' => 'Ukuran (Size)', 'name' => 'XXL', 'price' => 10000],
            ['type' => 'Ukuran (Size)', 'name' => '3XL / 4XL', 'price' => 20000],
        ];

        foreach ($addonsJersey as $addon) {
            ProductAddon::create(array_merge(['category_id' => $jerseyId], $addon));
        }

        // ---- VARIASI BANNER ----
        $addonsBanner = [
            ['type' => 'Finishing Banner', 'name' => 'Mata Ayam 4 Sudut', 'price' => 2000],
            ['type' => 'Finishing Banner', 'name' => 'Lebihan Putih (Tanpa Lipat)', 'price' => 0],
            ['type' => 'Finishing Banner', 'name' => 'Selongsong Kanan Kiri (Untuk Bambu)', 'price' => 5000],
        ];

        foreach ($addonsBanner as $addon) {
            ProductAddon::create(array_merge(['category_id' => $bannerId], $addon));
        }

        // ---- VARIASI STEMPEL ----
        $addonsStempel = [
            ['type' => 'Warna Tinta', 'name' => 'Satu Warna (Bebas)', 'price' => 0],
            ['type' => 'Warna Tinta', 'name' => 'Dua Warna', 'price' => 10000],
            ['type' => 'Warna Tinta', 'name' => 'Tiga Warna', 'price' => 15000],
        ];

        foreach ($addonsStempel as $addon) {
            ProductAddon::create(array_merge(['category_id' => $stempelId], $addon));
        }
    }
}
