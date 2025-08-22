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
            'T-Shirts & Polos' => [
                'Men\'s Classic V-Neck T-Shirt',
                'Casual Polo Shirt with Pocket',
            ],
            'Shirts' => [
                'Slim-Fit Oxford Shirt',
                'Linen Blend Short Sleeve Shirt',
            ],
            'Jeans & Trousers' => [
                'Distressed Skinny Jeans',
                'Comfort-Fit Khaki Trousers',
            ],
            'Jackets & Coats' => [
                'Fleece-Lined Winter Jacket',
                'Lightweight Windbreaker Coat',
            ],
            'Ethnic Wear' => [
                'Traditional Kurta Pajama Set',
                'Embroidered Sherwani Jacket',
            ],

            // Women
            'Tops & Blouses' => [
                'Floral Print Blouse',
                'Elegant Silk Camisole',
            ],
            'Dresses' => [
                'Summer Sundress with Pockets',
                'Evening Gown with Sequins',
            ],
            'Sarees' => [
                'Handloom Cotton Saree',
                'Banarasi Silk Saree',
            ],
            'Salwar Kameez' => [
                'Printed Cotton Salwar Suit',
                'Designer Anarkali Suit',
            ],
            'Kurtis & Tunics' => [
                'Casual A-Line Kurti',
                'Embroidered Georgette Tunic',
            ],

            // Kids
            "Boys' Clothing" => [
                'Graphic Print T-Shirt for Boys',
                'Dinosaur Hoodie for Kids',
            ],
            "Girls' Clothing" => [
                'Glittery Unicorn Dress for Girls',
                'Pink Tutu Skirt',
            ],
            'Footwear' => [
                'Velcro Strap Sneakers',
                'Cartoon Character Sandals',
            ],
            'School Accessories' => [
                'Waterproof School Backpack',
                'Lunch Box with Padded Holder',
            ],

            // Accessories
            'Bags & Backpacks' => [
                'Laptop Backpack with USB Port',
                'Leather Messenger Bag',
            ],
            'Watches' => [
                'Digital Sports Watch',
                'Classic Analog Leather Watch',
            ],
            'Sunglasses' => [
                'Aviator Style Sunglasses',
                'Cat-Eye Frame Sunglasses',
            ],
            'Jewelry' => [
                'Silver Plated Chain Necklace',
                'Rose Gold Stud Earrings',
            ],
            'Belts & Wallets' => [
                'Genuine Leather Belt',
                'Bifold Wallet with RFID Protection',
            ],
        ];

        $brands = Brand::pluck('id')->toArray(); // Random brand_id pick

        foreach ($categoryStructure as $categoryName => $productNames) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($productNames as $productName) {
                DB::table('products')->insert([
                    'name' => $productName,
                    'slug' => Str::slug($productName) . '-' . uniqid(),
                    'description' => "Description for $productName",
                    'views' => rand(0, 100),
                    'category_id' => $category->id,
                    'brand_id' => $brands[array_rand($brands)] ?? null,
                    'thumbnail' => 'assets/frontend/images/jersey_01.webp',
                    'gallery' => json_encode([
                        'assets/frontend/images/jersey_02.webp',
                        'assets/frontend/images/jersey_03.webp',
                        'assets/frontend/images/jersey_04.webp',
                        'assets/frontend/images/jersey_05.webp'
                    ]),
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
