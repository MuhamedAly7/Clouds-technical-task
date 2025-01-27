<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1Qlk5NRrVtmLvQrRG6u53Nmj')
    {
        return $request->user()
            ->newSubscription(env('PRODUCT_ID'), $plan)
            ->checkout([
                'success_url' => route('success'),
                'cancel_url' => route('dashboard'),
            ]);
    }
}
