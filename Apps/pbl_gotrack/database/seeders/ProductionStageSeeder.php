<?php

namespace Database\Seeders;

use App\Enums\CategoryIcon;
use App\Models\Category;
use App\Models\ProductionStage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductionStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            'Jersey' => [
                'Menunggu Antrean',
                'Proses Desain & Layout',
                'Cetak Sublim / Film',
                'Press Kain',
                'Potong Kain',
                'Proses Jahit',
                'Finishing / QC',
                'Siap Diambil',
            ],
            'Spanduk & Banner' => [
                'Menunggu Antrean',
                'Proses Setting Desain',
                'Sedang Dicetak (Mesin Besar)',
                'Finishing (Mata Ayam / Seaming)',
                'Siap Diambil',
            ],
            'Merchandise' => [
                'Menunggu Antrean',
                'Setting & Mirroring Desain',
                'Cetak & Press',
                'Perakitan',
                'Siap Diambil',
            ],
        ];

        foreach ($data as $categoryName => $stages) {
            $categoryIcon = match ($categoryName) {
                'Jersey' => CategoryIcon::Jersey->value,
                'Spanduk & Banner' => CategoryIcon::Banner->value,
                'Merchandise' => CategoryIcon::Shirt->value,
                default => CategoryIcon::Grid->value,
            };

            // 1. Cari Kategori berdasarkan nama, jika belum ada buat baru beserta slug-nya
            $category = Category::updateOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'icon' => $categoryIcon,
                ]
            );

            // 2. Masukkan tahapan produksi sesuai urutan array
            foreach ($stages as $index => $stageName) {
                ProductionStage::firstOrCreate(
                    [
                        'category_id' => $category->id,
                        'name' => $stageName,
                    ],
                    [
                        'sequence' => $index + 1,
                    ]
                );
            }
        }
    }
}
