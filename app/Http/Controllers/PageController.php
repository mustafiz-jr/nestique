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
}
