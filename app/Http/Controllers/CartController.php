<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function checkout()
    {
        $customer = auth()->user();
        $cartItems = Cart::content();
        $shippingMethods = ShippingMethod::all();
        $subtotal = Cart::subtotal(2, '.', ''); // Retrieve the cart subtotal

        return view('frontend.pages.checkout', compact('cartItems', 'shippingMethods', 'customer', 'subtotal'));
    }



    public function order(Request $request)
    {
        // Step 1: Handle Request and Validation for shipping details
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'shipping-method' => 'required|string|max:255',
            'payment-method' => 'required|string|in:online,cod',
        ]);

        // Step 2: Retrieve cart information and user data
        $customer = auth()->user();
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal(2, '.', '');
        $shippingMethodName = $request->input('shipping-method');

        // Find the selected shipping method and its price
        $shippingMethod = ShippingMethod::where('name', $shippingMethodName)->first();
        $shippingAmount = $shippingMethod ? $shippingMethod->price : 0;

        $totalAmount = $subtotal + $shippingAmount;

        // Step 3: Generate a unique order number
        $orderNumber = 'ORD-' . strtoupper(Str::random(10));

        // Step 4: Create the shipping and billing address JSON
        $shippingAddress = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
        ];

        $billingAddress = [
            'name' => $customer->name,
            'email' => $customer->email,
            'address' => $customer->address,
            'city' => $customer->city,
            'country' => $customer->country,
            'zip' => $customer->zip,
            'phone' => $customer->phone,
        ];

        // Step 5: Save the order to the database
        $order = new Order();
        $order->order_number = $orderNumber;
        $order->user_id = $customer->id;
        $order->coupon_id = null; // As per your instruction, this is initially null
        $order->coupon_code = null;
        $order->discount = null;
        $order->status = 'pending'; // Default status
        $order->payment_method = $request->input('payment-method');
        $order->payment_status = 'pending';
        $order->subtotal = $subtotal;
        $order->tax_amount = 0; // Assuming no tax for now
        $order->shipping_amount = $shippingAmount;
        $order->discount_amount = 0;
        $order->total = $totalAmount;
        $order->currency = 'USD'; // Default currency
        $order->shipping_address = json_encode($shippingAddress);
        $order->billing_address = json_encode($billingAddress);
        $order->notes = null;
        $order->shipping_method = $shippingMethodName;
        $order->tracking = null;
        $order->save();
        // Step 5.1: Save each cart item to the order_items table
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->product_name = $item->name;
            $orderItem->sku = $item->options->sku ?? null;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->total = $item->price * $item->qty;
            $orderItem->variant = json_encode($item->options ?? []);
            $orderItem->notes = null;
            $orderItem->save();
        }

        // Step 6: Clear the cart
        Cart::destroy();

        // Step 7: Redirect or return a success response
        return redirect()->route('thanks', $order->order_number)->with('success', 'Order placed successfully!');
    }



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
