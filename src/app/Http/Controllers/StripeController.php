<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function option () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_OPTION');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }
    public function right () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_PLAN_RIGHT');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }
    public function business () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_PLAN_BUSINESS');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }
}
