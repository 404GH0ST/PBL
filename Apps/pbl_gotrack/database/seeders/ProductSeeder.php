<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari ID Kategori
        $jerseyId = Category::where('name', 'Jersey')->value('id');
        $bannerId = Category::where('name', 'Banner / Spanduk')->value('id');
        $stempelId = Category::where('name', 'Stempel')->value('id');

        if (!$jerseyId || !$bannerId || !$stempelId) {
            $this->command->error('Kategori belum ada. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        $products = [
            [
                'category_id' => $jerseyId,
                'name' => 'Jersey Futsal / Sepak Bola (Setelan)',
                'slug' => Str::slug('Jersey Futsal / Sepak Bola (Setelan)'), // Tambahkan slug
                'price' => 150000,
                'description' => 'Satu set jersey futsal lengan pendek lengkap dengan celana.',
            ],
            [
                'category_id' => $jerseyId,
                'name' => 'Jersey Voli (Atasan Saja)',
                'slug' => Str::slug('Jersey Voli (Atasan Saja)'), // Tambahkan slug
                'price' => 90000,
                'description' => 'Jersey atasan khusus voli bebas desain.',
            ],
            [
                'category_id' => $bannerId,
                'name' => 'Cetak Spanduk Flexi 280gr (Per Meter)',
                'slug' => Str::slug('Cetak Spanduk Flexi 280gr (Per Meter)'), // Tambahkan slug
                'price' => 25000,
                'description' => 'Cetak banner bahan standar flexi 280 gram. Harga per meter persegi.',
            ],
            [
                'category_id' => $stempelId,
                'name' => 'Stempel Flash Otomatis (Bulat)',
                'slug' => Str::slug('Stempel Flash Otomatis (Bulat)'), // Tambahkan slug
                'price' => 50000,
                'description' => 'Stempel otomatis tanpa bak tinta, ukuran standar.',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
