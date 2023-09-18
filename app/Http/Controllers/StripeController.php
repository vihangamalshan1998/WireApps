<?php

namespace App\Http\Controllers;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function session()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Product 1',
                        ],
                        'unit_amount' => 5000, // Amount in cents (50 USD)
                    ],
                    'quantity' => 2,
                ],
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Product 2',
                        ],
                        'unit_amount' => 1000, // Amount in cents (50 USD)
                    ],
                    'quantity' => 2,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => url('/'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Sucessfull!!!";
    }
}
