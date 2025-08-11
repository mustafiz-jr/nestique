<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('product_details' , [PageController::class , 'product_details'])->name('product_details');
