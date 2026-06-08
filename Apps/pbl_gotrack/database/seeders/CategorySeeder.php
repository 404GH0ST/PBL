<?php

namespace Database\Seeders;

use App\Enums\CategoryIcon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Jersey', 'icon' => CategoryIcon::Jersey->value],
            ['name' => 'Banner / Spanduk', 'icon' => CategoryIcon::Banner->value],
            ['name' => 'Stempel', 'icon' => CategoryIcon::Dots->value],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']),
                    'icon' => $category['icon'],
                ]
            );
        }
    }
}
