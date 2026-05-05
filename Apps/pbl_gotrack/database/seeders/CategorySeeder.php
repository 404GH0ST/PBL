<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Jersey'],
            ['name' => 'Banner / Spanduk'],
            ['name' => 'Stempel'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']),
                ]
            );
        }
    }
}
