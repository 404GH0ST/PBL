<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Jersey Futsal',
            'Jersey Voli',
            'Jersey Basket',
            'Kaos Event'
        ];

        foreach ($categories as $categoryName) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)], // Acuan agar tidak duplikat
                [
                    'name' => $categoryName,
                    'description' => 'Kategori untuk segala jenis pesanan ' . $categoryName,
                ]
            );
        }
    }
}
