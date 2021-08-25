<?php

namespace App\Services;

use App\Helpers\Currency;
use App\Models\Order;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Str;

class StripeService
{
    private $stripe, $currencyCode;

    public function __construct()
    {
        $this->currencyCode = Currency::getDefaultCurrency();
        $this->stripe = Stripe::make(config('settings.stripe_secret_key'));
    }

    public function createOrder(Order $order)
    {
        $items = $order->items->map(function ($item) {
            return "Name:{$item->name}; Variant:{$item->pivot->variant->name}; Quantity:{$item->pivot->quantity}; Price:" . Currency::getSymbol() . $item->pivot->price;
        });

        $this->stripe->charges()->create([
            'currency'      =>  $this->currencyCode,
            'amount'        =>  $order->order_total,
            'source'        =>  $order->transaction_number,
            'description'   =>  Str::title(config('app.name') . ' order'),
            'receipt_email' =>  auth()->user()->email,
            'metadata'      =>  [
                ...$items,
                'note'      =>  $order->note,
            ],
            'shipping'      =>  [
                // 'method'            =>  'Giao hang nhanh',
                // 'name'              =>  $order->name,
                // 'phone'             =>  $order->phone,
                // 'address'           =>  [
                //     'address'       =>  $order->address,
                //     'postal_code'   =>  '100000',
                //     'country_code'  =>  Currency::getLocale(),
                // ],
            ],
        ]);
    }
}
