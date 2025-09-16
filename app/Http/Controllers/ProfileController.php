<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Order $orders)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with('orderItems')
            ->get();
        return view('frontend.pages.customer_profile.index', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($request->only([
            'name',
            'email',
            'phone',
            'address',
            'city',
            'state',
            'zip',
            'country'
        ]));

        return redirect()->route('profile.index')->with('success', 'Profile information updated!');
    }

    public function invoice($id)
    {
        $user = Auth::user();

        $order = Order::where('id', $id)
            ->where('user_id', $user->id)
            ->with('orderItems')
            ->firstOrFail(); // returns 404 if not found

        return view('frontend.pages.customer_profile.invoice', compact('user', 'order'));
    }
}
