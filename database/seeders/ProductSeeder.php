<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryStructure = [
            // Men
            'T-Shirts & Polos',
            'Shirts',
            'Jeans & Trousers',
            'Jackets & Coats',
            'Ethnic Wear',

            // Women
            'Tops & Blouses',
            'Dresses',
            'Sarees',
            'Salwar Kameez',
            'Kurtis & Tunics',

            // Kids
            "Boys' Clothing",
            "Girls' Clothing",
            'Footwear',
            'School Accessories',

            // Accessories
            'Bags & Backpacks',
            'Watches',
            'Sunglasses',
            'Jewelry',
            'Belts & Wallets',
        ];

        $brands = Brand::pluck('id')->toArray(); // Random brand_id pick

        foreach ($categoryStructure as $categoryName) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            for ($i = 1; $i <= 2; $i++) {
                $productName = $categoryName . " Product " . $i;

                DB::table('products')->insert([
                    'name' => $productName,
                    'slug' => Str::slug($productName) . '-' . uniqid(),
                    'description' => "Description for $productName",
                    'views' => rand(0, 100),
                    'category_id' => $category->id,
                    'brand_id' => $brands[array_rand($brands)] ?? null,
                    'thumbnail' => null,
                    'gallery' => json_encode([]),
                    'price' => rand(500, 5000),
                    'compare_at_price' => rand(5500, 7000),
                    'cost_per_item' => rand(300, 1000),
                    'track_quantity' => true,
                    'has_variants' => false,
                    'sku' => strtoupper(Str::random(10)),
                    'barcode' => rand(1000000000, 9999999999),
                    'weight' => rand(1, 10),
                    'height' => rand(5, 20),
                    'width' => rand(5, 20),
                    'length' => rand(5, 20),
                    'stock' => rand(0, 100),
                    'status' => 'active',
                    'published_at' => now(),
                    'tags' => json_encode(['Fashion', 'New', 'Trending']),
                    'options' => json_encode([]),
                    'variants' => json_encode([]),
                    'meta_title' => $productName . " - Buy Now",
                    'meta_description' => "Meta description for $productName",
                    'meta_keywords' => "fashion, " . strtolower($categoryName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
