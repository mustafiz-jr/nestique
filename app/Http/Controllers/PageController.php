<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.home');
    }

    public function product_details()
    {
        return view('components.product_details');
    }
}
