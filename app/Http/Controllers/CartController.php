<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Termwind\Components\Dd;

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
            'coupon_code' => 'nullable|string|exists:coupons,code' // Changed to nullable
        ]);

        // Step 2: Retrieve cart information and user data
        $customer = auth()->user();
        $cartItems = Cart::content();
        $subtotal = (float) str_replace(',', '', Cart::subtotal(2, '.', '')); // Convert to float
        $shippingMethodName = $request->input('shipping-method');

        // Find the selected shipping method and its price
        $shippingMethod = ShippingMethod::where('name', $shippingMethodName)->first();
        $shippingAmount = $shippingMethod ? $shippingMethod->price : 0;

        // Initialize coupon variables
        $coupon = null;
        $couponCode = $request->input('coupon_code');
        $discountAmount = 0;
        $couponId = null;

        // If coupon is provided then process
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->whereNull('starts_at')
                        ->orWhere('starts_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('ends_at')
                        ->orWhere('ends_at', '>=', now());
                })
                ->first();

            if (!$coupon) {
                return redirect()->back()->with('error', 'Invalid or expired coupon code!');
            }

            // Check if coupon has usage limit
            if ($coupon->max_uses && $coupon->used >= $coupon->max_uses) {
                return redirect()->back()->with('error', 'The coupon code has been expired!');
            }

            // Check minimum order amount
            if ($coupon->min_order && $subtotal < $coupon->min_order) {
                return redirect()->back()->with('error', 'Minimum required order amount for this coupon is $' . number_format($coupon->min_order, 2));
            }

            // Calculation of the discount
            if ($coupon->type === 'percent') {
                $discountAmount = ($subtotal * $coupon->value) / 100;
            } else {
                $discountAmount = $coupon->value;
            }

            // Ensure that discount doesn't exceed subtotal
            if ($discountAmount > $subtotal) {
                $discountAmount = $subtotal;
            }

            $couponId = $coupon->id;
        }

        $totalAmount = $subtotal + $shippingAmount - $discountAmount;

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
        $order->coupon_id = $couponId;
        $order->coupon_code = $couponCode;
        $order->discount = $discountAmount;
        $order->status = 'pending'; // Default status
        $order->payment_method = $request->input('payment-method');
        $order->payment_status = 'pending';
        $order->subtotal = $subtotal;
        $order->tax_amount = 0; // Assuming no tax for now
        $order->shipping_amount = $shippingAmount;
        $order->discount_amount = $discountAmount; // Fixed: Use the calculated discount amount
        $order->total = $totalAmount;
        $order->currency = 'USD'; // Default currency
        $order->shipping_address = json_encode($shippingAddress);
        $order->billing_address = json_encode($billingAddress);
        $order->notes = null;
        $order->shipping_method = $shippingMethodName;
        $order->tracking = null;
        $order->save();



        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;

            $orderItem->product_id = $item->id->id ?? $item->id;

            $orderItem->product_name = $item->name;
            $orderItem->sku = $item->options->sku ?? null;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->total = $item->price * $item->qty;

            $variantData = [
                'color' => $item->options->color ?? null,
                'size'  => $item->options->size ?? null,
            ];

            $orderItem->variant = json_encode($variantData);
            $orderItem->notes = null;
            $orderItem->save();
        }



        if ($coupon) {
            $coupon->increment('used');
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
            'weight'     => 'nullable|numeric',
        ]);

        $product = Product::findOrFail($request->product_id);

        $options = [
            'color' => is_array($request->variant_color) ? implode(',', $request->variant_color) : $request->variant_color,
            'size'  => is_array($request->variant_size) ? implode(',', $request->variant_size) : $request->variant_size,
        ];

        $item = Cart::add([
            'id'      => $product,
            'name'    => $product->name,
            'qty'     => $request->quantity,
            'price'   => $product->price,
            'weight'  => $request->weight ?? 0,
            'options' => $options,
        ])->associate(\App\Models\Product::class);
        // dd($item);
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
