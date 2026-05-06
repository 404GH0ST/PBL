<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ProductionStage;
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
            // 1. Cari Kategori berdasarkan nama, jika belum ada buat baru beserta slug-nya
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)] // <-- Mengisi kolom slug yang wajib
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
