<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingMethod;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Stripe\Charge;
use Illuminate\Support\Str;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe_payment(Request $request)
    {
        // Step 1: Validation
        $request->validate([
            'stripe_token' => 'required|string', // Stripe টোকেন ভ্যালিডেশন
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'shipping-method' => 'required|string|max:255',
            'payment-method' => 'required|string|in:online,cod',
            'coupon_code' => 'nullable|string'
        ]);

        $customer = auth()->user();

        // Ensure cart is not empty (This will work after running the migrations above)
        if (\Gloudemans\Shoppingcart\Facades\Cart::count() == 0) {
            return redirect()->route('cart.show')->with('error', "Your cart is empty.");
        }

        $cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $subtotal = (float) str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal(2, '.', ''));
        $shippingMethodName = $request->input('shipping-method');

        $shippingMethod = ShippingMethod::where('name', $shippingMethodName)->first();
        $shippingAmount = $shippingMethod ? $shippingMethod->price : 0.00;

        $coupon = null;
        $couponCode = $request->input('coupon_code');
        $discountAmount = 0.00;
        $couponId = null;

        // Step 2: Coupon Processing with Checks (FIXED LOGIC)
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('is_active', true)
                ->where(fn($query) => $query->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
                ->where(fn($query) => $query->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
                ->first();

            if (!$coupon) {
                return redirect()->back()->with('error', 'Invalid or expired coupon code!');
            }

            // Re-adding essential checks from your previous order() function:
            if ($coupon->max_uses && $coupon->used >= $coupon->max_uses) {
                return redirect()->back()->with('error', 'The coupon code has been expired!');
            }
            if ($coupon->min_order && $subtotal < $coupon->min_order) {
                return redirect()->back()->with('error', 'Minimum required order amount for this coupon is $' . number_format($coupon->min_order, 2));
            }

            // Calculation only happens after all checks pass
            $discountAmount = ($coupon->type === 'percent')
                ? ($subtotal * $coupon->value) / 100
                : $coupon->value;

            if ($discountAmount > $subtotal) {
                $discountAmount = $subtotal;
            }

            $couponId = $coupon->id;
        }

        $totalAmount = round($subtotal + $shippingAmount - $discountAmount, 2);
        $totalAmountInCents = round($totalAmount * 100);

        // Step 3: Stripe Payment Processing (No change needed here)
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::create([
                'amount' => $totalAmountInCents,
                'currency' => 'usd',
                'description' => 'Online Order Payment Via Stripe',
                'source' => $request->stripe_token,
                'receipt_email' => $request->email,
            ]);
        } catch (CardException $e) {
            return back()->withInput()->with('error', $e->getError()->message);
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Payment failed: ' . $e->getMessage());
        }

        if ($charge->status !== 'succeeded') {
            return back()->with('error', 'Payment processing failed. Please try again!');
        }

        // Step 4: Save Order Data (No change needed here)
        $shippingAddress = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
        ];

        $billingAddress  = [
            'name' => $customer->name ?? $shippingAddress['name'],
            'email' => $customer->email ?? $shippingAddress['email'],
            'address' => $customer->address ?? $shippingAddress['address'],
            'city' => $customer->city ?? $shippingAddress['city'],
            'country' => $customer->country ?? $shippingAddress['country'],
            'zip' => $customer->zip ?? $shippingAddress['zip'],
            'phone' => $customer->phone ?? $shippingAddress['phone'],
        ];

        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(Str::random(10));
        $order->user_id = $customer->id ?? null;
        $order->coupon_id = $couponId;
        $order->coupon_code = $couponCode;
        $order->discount = $discountAmount;
        $order->status = 'completed';
        $order->payment_method = 'Stripe';
        $order->payment_status = 'completed';
        $order->payment_intent_id = $charge->id;
        $order->subtotal = $subtotal;
        $order->tax_amount = 0.00;
        $order->shipping_amount = $shippingAmount;
        $order->discount_amount = $discountAmount;
        $order->total = $totalAmount;
        $order->currency = strtoupper($charge->currency);
        $order->shipping_address = $shippingAddress;
        $order->billing_address = $billingAddress;
        $order->shipping_method = $shippingMethodName;
        $order->save();

        // Step 5: Save Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->qty,
                'total' => $item->price * $item->qty,
                'variant' => $item->options ?? [],
            ]);
        }

        // Step 6: Finalize
        if ($coupon) {
            $coupon->increment('used');
        }

        \Gloudemans\Shoppingcart\Facades\Cart::destroy();

        return redirect()->route('thanks', ['order_number' => $order->order_number])->with('success', 'Successfully paid & order is placed!');
    }
}
