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
                'Ethnic Wear', // Same name as in Men
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

        $usedSlugs = [];

        foreach ($categories as $main => $subcategories) {
            foreach ($subcategories as $sub) {
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
                    'image' => null,
                    'description' => "This is a subcategory of $main.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
