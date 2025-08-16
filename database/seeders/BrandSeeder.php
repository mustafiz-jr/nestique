<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'Levi\'s',
            'Zara',
            'Gucci',
            'Louis Vuitton',
            'H&M',
            'Uniqlo',
            'Under Armour',
            'Tommy Hilfiger',
            'Calvin Klein',
            'Versace',
            'Burberry',
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'description' => 'Brand: ' . $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
