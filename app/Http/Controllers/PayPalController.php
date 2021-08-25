<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Checkout\PayPalCheckoutService;
use App\Services\PaypalService;

class PayPalController extends Controller
{
    private $paypalService;

    function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    public function expressCheckout($orderNumber)
    {
        $order      =   Order::whereOrderCode($orderNumber)->firstOrFail();
        $response   =   $this->paypalService->createOrder($order->id);
        abort_if($response->statusCode !== 201, 500);
        $order->transaction_number = $response->result->id;
        $order->save();

        foreach ($response->result->links as $link) {
            if ($link->rel == 'approve') return redirect($link->href);
        }
    }

    public function cancelCheckout($orderNumber)
    {
        $order = Order::whereOrderCode($orderNumber)->firstOrFail();
        return (new PayPalCheckoutService(order: $order))->failed();
    }

    public function expressCheckoutSuccess($orderNumber)
    {
        $order = Order::whereOrderCode($orderNumber)->firstOrFail();
        return (new PayPalCheckoutService(order: $order))->success();
    }
}
