<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Skin Care', 'slug' => 'skin-care', 'status' => 'active', 'image' => 'skin.png'],
            ['name' => 'Hair Care', 'slug' => 'hair-care', 'status' => 'active', 'image' => 'hair.png'],
            ['name' => 'Detox & Digestion', 'slug' => 'detox', 'status' => 'active', 'image' => 'detox.png'],
            ['name' => 'General Health', 'slug' => 'health', 'status' => 'active', 'image' => 'health.png'],
            ['name' => 'Men\'s Wellness', 'slug' => 'men', 'status' => 'active', 'image' => 'men.png'],
            ['name' => 'Immunity', 'slug' => 'immunity', 'status' => 'active', 'image' => 'immunity.png'],
            ['name' => 'Statues', 'slug' => 'statues', 'status' => 'active', 'image' => 'statues.png'],
            ['name' => 'Jewelry', 'slug' => 'jewelry', 'status' => 'active', 'image' => 'jewelry.png'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'status' => 'active', 'image' => 'accessories.png'],
            ['name' => 'Spiritual', 'slug' => 'spiritual', 'status' => 'active', 'image' => 'spiritual.png'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
