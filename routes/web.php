<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('product_details/{id}', [PageController::class, 'product_details'])->name('product_details');
Route::get('shop', [PageController::class, 'shop'])->name('shop');
Route::get('men_products', [PageController::class, 'men_product'])->name('men_product');
Route::get('women_products', [PageController::class, 'women_product'])->name('women_product');
Route::get('offer', [PageController::class, 'offer'])->name('offer');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('cart', [PageController::class, 'cart'])->name('cart');
Route::get('checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/cart',[CartController::class , 'add_cart'])->name('cart.add');

// Route::get('ajax/get_cart_count', [AjaxController::class, 'get_cart_count'])->name('get_cart_count');
