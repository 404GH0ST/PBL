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
        //
        $category = Category::first();

        if ($category) {
            $products = [
                'Jersey Printing Lengan Pendek',
                'Jersey Printing Lengan Panjang'
            ];

            foreach ($products as $productName) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($productName)],
                    [
                        'category_id' => $category->id,
                        'name' => $productName,
                        'price' => 90000, // Harga flat
                        'description' => 'Detail lengkap mengenai produk ' . $productName,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
