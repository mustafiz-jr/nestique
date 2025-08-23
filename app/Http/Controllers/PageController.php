<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function guest()
    {
        $categories = Category::limit(10)->get();
        $products = Product::all();
        return view('frontend.pages.home', compact('categories', 'products'));
    }

    public function home()
    {
        $categories = Category::limit(10)->get();
        $products = Product::all();
        return view('frontend.pages.home', compact('categories', 'products'));
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        return view('frontend.pages.product_details', compact('product'));
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.pages.shop', compact('categories', 'products'));
    }

    public function men_product()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.pages.men_product', compact('categories', 'products'));
    }
    public function women_product()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.pages.women_product', compact('categories', 'products'));
    }

    public function offer()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.pages.shop', compact('categories', 'products'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function cart()
    {
        return view('frontend.pages.cart');
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }

    public function wish_list()
    {
        return view('frontend.pages.wish_list');
    }
}
