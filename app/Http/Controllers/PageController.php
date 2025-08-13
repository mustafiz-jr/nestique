<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('frontend.pages.home');
    }

    public function product_details()
    {
        return view('frontend.pages.product_details');
    }

    public function shop()
    {
        return view('frontend.pages.shop');
    }

    public function men_product()
    {
        return view('frontend.pages.men_product');
    }
    public function women_product()
    {
        return view('frontend.pages.women_product');
    }
}
