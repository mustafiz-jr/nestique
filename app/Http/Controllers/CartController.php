<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart_add()
    {
        Cart::add([
            ['id' => '1', 'name' => 'Product 1', 'qty' => 1, 'price' => 10.00, 'weight' => 550],
            ['id' => '2', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00, 'weight' => 550, 'options' => ['size' => 'large']]
        ]);

        // Cart::add([$product1, $product2]);
    }
}
