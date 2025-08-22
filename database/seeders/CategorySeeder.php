<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Men
            'Men' => [
                'T-Shirts & Polos',
                'Shirts',
                'Jeans & Trousers',
                'Jackets & Coats',
                'Ethnic Wear',
            ],
            // Women
            'Women' => [
                'Tops & Blouses',
                'Dresses',
                'Sarees',
                'Salwar Kameez',
                'Kurtis & Tunics',
            ],
            // Kids
            'Kids' => [
                "Boys' Clothing",
                "Girls' Clothing",
                'Footwear',
                'Ethnic Wear',
                'School Accessories',
            ],
            // Accessories
            'Accessories' => [
                'Bags & Backpacks',
                'Watches',
                'Sunglasses',
                'Jewelry',
                'Belts & Wallets',
            ],
        ];

        // Map category names to their corresponding image file names
        $imageMap = [
            'T-Shirts & Polos' => 'polo-shirt.png',
            'Shirts' => 'shirt.png',
            'Jeans & Trousers' => 'pant_category.png',
            'Jackets & Coats' => null, // No specific image provided
            'Ethnic Wear' => 'kurta.png',
            'Tops & Blouses' => null, // No specific image provided
            'Dresses' => 'dresses.png',
            'Sarees' => 'saaree.png',
            'Salwar Kameez' => 'kurta.png', // Reusing an image
            'Kurtis & Tunics' => 'kurta.png', // Reusing an image
            "Boys' Clothing" => 'boy_cloth.png',
            "Girls' Clothing" => 'girl_cloth.png',
            'Footwear' => 'shoes.png',
            'School Accessories' => 'bags.png',
            'Bags & Backpacks' => 'bags.png',
            'Watches' => null, // No specific image provided
            'Sunglasses' => null, // No specific image provided
            'Jewelry' => null, // No specific image provided
            'Belts & Wallets' => null, // No specific image provided
        ];

        $usedSlugs = [];

        foreach ($categories as $main => $subcategories) {
            foreach ($subcategories as $sub) {
                // Determine the correct image path
                $imagePath = isset($imageMap[$sub]) ? 'assets/frontend/images/categories/' . $imageMap[$sub] : null;

                // Make a unique slug: e.g. men-ethnic-wear
                $baseSlug = Str::slug($main . '-' . $sub);
                $slug = $baseSlug;

                $i = 1;
                while (in_array($slug, $usedSlugs)) {
                    $slug = $baseSlug . '-' . $i++;
                }

                $usedSlugs[] = $slug;

                DB::table('categories')->insert([
                    'name' => $sub,
                    'slug' => $slug,
                    'image' => $imagePath,
                    'description' => "This is a subcategory of $main.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
