<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add price and duration according to the database table schema.
        $methods = [
            [
                'name' => 'FedEx',
                'price' => '15.99',
                'duration' => '3-5 business days'
            ],
            [
                'name' => 'UPS',
                'price' => '12.50',
                'duration' => '4-6 business days'
            ],
            [
                'name' => 'USPS',
                'price' => '7.25',
                'duration' => '5-7 business days'
            ],
            [
                'name' => 'DHL',
                'price' => '25.00',
                'duration' => '2-3 business days'
            ]
        ];

        foreach ($methods as $method) {
            ShippingMethod::create($method);
        }
    }
}
