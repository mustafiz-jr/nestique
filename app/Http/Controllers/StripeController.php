<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe_payment()
    {
        return redirect()->route('thanks')->with('success', 'Successfully paid & order is placed!');
    }
}
