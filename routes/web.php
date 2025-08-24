<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Publicly accessible routes (no login required)

Route::get('/', [PageController::class, 'guest'])->name('guest');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('shop', [PageController::class, 'shop'])->name('shop');
Route::get('men_products', [PageController::class, 'men_product'])->name('men_product');
Route::get('women_products', [PageController::class, 'women_product'])->name('women_product');
Route::get('offer', [PageController::class, 'offer'])->name('offer');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('product_details/{id}', [PageController::class, 'product_details'])->name('product_details');

// Authentication routes (login, register, logout)
Auth::routes();

// Protected routes (login required)
Route::middleware(['auth'])->group(function () {
    // Pages
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');

    // Cart and Ajax actions
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'show_cart')->name('cart.show');
        Route::post('/add-to-cart', 'add_cart')->name('cart.add');
        Route::post('/cart/update', 'update_cart')->name('cart.update');
        Route::post('/cart/remove', 'remove_cart')->name('cart.remove');
        Route::post('/cart/clear', 'clear_cart')->name('cart.clear');
    });
});
