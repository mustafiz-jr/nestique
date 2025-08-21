<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function show_cart()
    {
        $cartItems = Cart::content();

        return view('frontend.pages.cart', [
            'cartItems' => $cartItems,
            'subtotal' => Cart::subtotal(),
            'total' => Cart::total(),
            'tax' => Cart::tax(),
        ]);
    }

    public function add_cart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        Cart::add(
            $product->id,
            $product->name,
            $request->quantity,
            $product->price
        )->associate('App\Models\Product');

        return redirect()->back()->with('success', 'Cart added!');
    }

    public function update_cart(Request $request)
    {
        $request->validate([
            'rowId' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::update($request->rowId, $request->quantity);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove_cart(Request $request)
    {
        $request->validate(['rowId' => 'required']);

        Cart::remove($request->rowId);

        return redirect()->back()->with('success', 'cart removed!');
    }

    public function clear_Cart()
    {
        Cart::destroy();

        return redirect()->back()->with('success', 'cart cleard!');
    }
}
