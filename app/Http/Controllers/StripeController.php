<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout()
    {
        // Assuming you have a Cart model related to the user
        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate([]);

        // Fetch products in the cart
        $cartItems = $cart->products;

        // Calculate total price
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->price * $item->pivot->quantity);
        }, 0);

        return view('stripe.checkout', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('productname');
        $totalprice = $request->get('total');
        $total = $totalprice * 100; // Stripe uses cents

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            'name' => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Thanks for your order. You have just completed your payment. The seller will reach out to you as soon as possible.";
    }
}
