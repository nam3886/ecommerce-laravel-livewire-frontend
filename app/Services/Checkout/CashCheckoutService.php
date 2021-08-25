<?php

namespace App\Services\Checkout;

use App\Mail\OrderSuccess;
use App\Services\Checkout\CheckoutService;
use Exception;
use Illuminate\Support\Facades\Mail;

class CashCheckoutService extends CheckoutService
{
    public function execute()
    {
        try {
            $this->createOrder();
            $this->success();
        } catch (Exception $e) {
            throw $e;
            $this->failed($e);
        }
    }

    public function success()
    {
        $this->order->is_paid             =   false;
        $this->order->bank_tran_number    =   null;
        $this->order->bank_code           =   null;
        // thanh toan/dat hang thanh cong => dat van chuyen => có tiền thu hộ
        // đã thanh toán => đã thu tiền ship
        // chưa thanh toán => cần thu ship và tiền hàng
        $this->order->cod_amount          =   $this->order->delivery_fee + $this->order->grand_total;
        $this->order->save();

        $this->order->order_success       =   1;
        $this->order->delivery_order_code =   $this->createShipping()->get('order_code');
        $this->order->save();

        $this->cart()->destroy();
        session()->forget($this->voucherSessionKey);
        session()->flash('checkout_success', true);
        Mail::to($this->order->customer->email)->send(new OrderSuccess($this->order));
        return redirect()->route('thank_for_payment', $this->order->order_code);
    }

    public function failed($exception)
    {
        $this->order->order_success       =   2;
        $this->order->is_paid             =   false;
        $this->order->bank_tran_number    =   null;
        $this->order->bank_code           =   null;
        $this->order->delivery_order_code =   null;
        $this->order->cod_amount          =   null;
        $this->order->save();
        // soft delete order
    }
}
