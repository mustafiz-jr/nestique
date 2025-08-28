<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

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

    // products showing in shop page 
    public function shop(Request $request)
    {

        $query = Product::with(['category', 'brand'])->where('status', 'active');

        //filter by category(slug)
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // filter by brand 
        if ($request->has('brand') && $request->brand) {
            $query->whereHas('brand', function ($q) {
                $q->where('slug', request()->brand);
            });
        }

        // search by name/description
        if ($request->has('search') &&  $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // filter by price range (min & max)
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        //  short products
        $short = $request->get('sort', 'name');

        // shorting with _desc suffix 
        if (str_ends_with($short, '_desc')) {
            $short = str_replace('_desc', '', $short);
            $direction = 'desc';
        } else {
            $direction = 'asc';
        }

        switch ($short) {
            case 'price':
                $query->orderBy('price', $direction);
                break;
            case 'newest':
                $query->orderBy('created_at', '_desc');
                break;
            case 'popular':
                $query->orderBy('views', '_desc');
                break;
            case 'name':
            default:
                $query->orderBy('name', $direction);
                break;
        }

        $categories = Category::all();
        $brands = Brand::all();
        $products = $query->paginate(10);

        //   get current category for product
        $currentCategory = null;
        if ($request->has('category') && $request->category) {
            $currentCategory = Category::where('slug', $request->category)->first();
        }

        return view('frontend.pages.shop', compact('categories', 'products', 'brands'));
    }

    public function men_product()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
        return view('frontend.pages.men_product', compact('categories', 'products', 'brands'));
    }
    public function women_product()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
        return view('frontend.pages.women_product', compact('categories', 'products', 'brands'));
    }

    public function offer()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
        return view('frontend.pages.shop', compact('categories', 'products', 'brands'));
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
}
