<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'client_id' => 'pk_test_51IpUhCCW5SzcT8LIdZRZDwwi25pJ40fG4qz3SzmGs0fCj76iLyniv3hSDrv21t1xmT4qynoRC1DOAD69FwT3u4w000ZLSnjvjA',
            'secret_id' => 'sk_test_51IpUhCCW5SzcT8LIhaJYbtCqxzru932oCSM65GZ8XmV71YXL3zkgadvRHa8kX2DmZzYccf77QwtHkAwbO2Cgwa2400GnLZXli1',
            'updated_by' => 1,
            'name' => 'stripe',
            'code' => 'stripe',
            'description' => 'Pay via Stripe; you can pay with your credit card if you don’t have a Stripe account.',
            'icon' => 'fa fa-cc-stripe',
        ]);

        Payment::create([
            'client_id' => 'AS3_-EKsj0f2vfmKJeZ9ShfjT5Z7vxtsi-LWKqnvGfnUIT0p6naHTfV-T5GXrK3RCP1y0SWyla72LGv7',
            'secret_id' => 'EKZI5l_NZctECEufDQZfo4CX17kZVoMsjj6oE5dk0qJIJRv3H-4WMnOf-HvEWUDyW06KxlTQH7Cbw8bN',
            'updated_by' => 1,
            'name' => 'paypal',
            'code' => 'paypal',
            'description' => 'Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.',
            'icon' => 'fa fa-cc-paypal',
        ]);

        Payment::create([
            'client_id' => 'D2UU70D0',
            'secret_id' => 'YZYCUADHWFRLYKNAYGFPKQOHMJQRJYGI',
            'updated_by' => 1,
            'name' => 'vnpay',
            'code' => 'vnpay',
            'description' => 'Pay via vnpay; you can pay with your credit card if you don’t have a vnpay account.',
            'icon' => 'fa fa-credit-card',
        ]);

        Payment::create([
            'updated_by' => 1,
            'name' => 'cash on delivery',
            'code' => 'cash_on_delivery',
            'description' => 'Ship-to codes are used for postal and delivery addresses. Ship-to codes derive their address lines from the Location code; therefore, for every ship-to address, there is a Location address.',
            'price' => 100000,
            'icon' => 'fa fa-money',
        ]);
    }
}
