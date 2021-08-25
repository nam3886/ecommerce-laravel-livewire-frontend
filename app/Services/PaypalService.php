<?php

namespace App\Services;

use App\Helpers\Currency;
use App\Models\Order;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Support\Str;

class PaypalService
{
    private $client, $currencyCode;

    public function __construct()
    {
        $this->currencyCode = 'USD';
        $environment = new SandboxEnvironment(
            config('settings.paypal_client_id'),
            config('settings.paypal_secret_id')
        );
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder($orderId)
    {
        $request                    =   new OrdersCreateRequest;
        $request->headers["prefer"] =   "return=representation";
        $request->body              =   $this->checkoutData($orderId);

        return $this->client->execute($request);
    }

    public function captureOrder($paypalOrderId)
    {
        $request = new OrdersCaptureRequest($paypalOrderId);

        return $this->client->execute($request);
    }

    private function checkoutData(int $orderId): array
    {
        $order                  =   Order::findOrFail($orderId);
        $items                  =   $this->paypalOrderDetails($order);
        $shippingInformation    =   $this->paypalShippingInformation($order);
        $purchaseAmount         =   $this->paypalPurchaseAmount($order);

        $checkoutData                  =   [
            'intent'                   =>  'CAPTURE',
            'application_context'      =>  [
                'return_url'           =>  route('paypal.success', $order->order_code),
                'cancel_url'           =>  route('paypal.cancel', $order->order_code),
                'brand_name'           =>  config('app.name'),
                'locale'               =>  'en-US',
                'landing_page'         =>  'BILLING',
                'shipping_preference'  =>  'SET_PROVIDED_ADDRESS',
                'user_action'          =>  'PAY_NOW',
            ],
            'purchase_units'           =>  [
                [
                    'reference_id'     =>  Str::snake(uniqid(config('app.name') . '_')),
                    'description'      =>  Str::title(config('app.name') . ' order'),
                    'custom_id'        =>  'CUST-HighFashions',
                    'soft_descriptor'  =>  'HighFashions',
                    // 'items'            =>  $items,
                    'shipping'         =>  $shippingInformation,
                    'amount'           =>  $purchaseAmount,

                ]
            ],
        ];

        return $checkoutData;
    }

    private function paypalOrderDetails(Order $order): array
    {
        return $order->items->map(function ($item) use ($order) {
            return [
                'name'              =>  $item->name,
                'quantity'          =>  $item->pivot->quantity,
                'unit_amount'       =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $this->exChangeMoney($item->pivot->price, $order)
                ],
                'tax'               =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  '0',
                ],
            ];
        })->toArray();
    }

    private function paypalShippingInformation(Order $order): array
    {
        return [
            'method'                =>  'Giao hang nhanh',
            'name'                  =>  ['full_name' => $order->name],
            'phone'                 =>  $order->phone,
            'address'               =>  [
                'address_line_1'    =>  $order->address,
                'admin_area_2'      =>  $order->api_address->ghn->district,
                'admin_area_1'      =>  $order->api_address->ghn->ward,
                'postal_code'       =>  '100000',
                'country_code'      =>  'VN',
            ],
        ];
    }

    private function paypalPurchaseAmount(Order $order): array
    {
        return [
            'currency_code'         =>  $this->currencyCode,
            'value'                 =>  $this->exChangeMoney($order->order_total, $order),
            // 'breakdown'             =>  [
            //     'item_total'        =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  $this->exChangeMoney($order->sub_total, $order),
            //     ],
            //     'shipping'          =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  $this->exChangeMoney($order->delivery_fee, $order),
            //     ],
            //     'handling'          =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  '0',
            //     ],
            //     'tax_total'         =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  $this->exChangeMoney($order->tax_price, $order),
            //     ],
            //     'insurance'         =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  '0',
            //     ],
            //     'shipping_discount' =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  '0',
            //     ],
            //     'discount'          =>  [
            //         'currency_code' =>  $this->currencyCode,
            //         'value'         =>  $this->exChangeMoney($order->discount_price, $order),
            //     ],
            // ],
        ];
    }

    private function exChangeMoney(int $money, Order $order)
    {
        $money *= $order->exchange_rate;
        return round($money, 2);
    }
}
