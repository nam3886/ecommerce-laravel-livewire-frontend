<?php

namespace App\Services\Checkout;

use App\Http\Livewire\Message;
use App\Mail\OrderSuccess;
use App\Models\Order;
use App\Services\Checkout\CheckoutService;
use App\Services\PaypalService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class PayPalCheckoutService extends CheckoutService
{
    protected $paypalService;

    public function __construct(
        Collection $user = null,
        int $deliveryFee = null,
        $transactionNumber = null,
        Order $order = null
    ) {
        // có user => cần toạ mới 1 order
        // không có order => đã thanh toán => tạo order shipping =>chỉ cần handle success or failed
        if ($user) {
            parent::__construct($user,  $deliveryFee, $transactionNumber);
        } else {
            $this->order = $order;
        }
        $this->paypalService = new PaypalService;
    }

    public function execute()
    {
        $this->createOrder();

        return redirect()->route('paypal.create', $this->order->order_code);
    }

    public function success()
    {
        $response = $this->paypalService->captureOrder($this->order->transaction_number);

        if ($response->result->status != 'COMPLETED') {
            $this->failed();
            return redirect()->route('home')->withError(Message::PAYMENT_NOT_COMPLETED);
        }

        $this->order->is_paid             =   true;
        $this->order->bank_tran_number    =   null;
        $this->order->bank_code           =   null;
        // thanh toan/dat hang thanh cong => dat van chuyen => có tiền thu hộ
        // đã thanh toán => đã thu tiền ship
        // chưa thanh toán => cần thu ship và tiền hàng
        $this->order->cod_amount          =   0;
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

    public function failed($exception = null)
    {
        $this->order->order_success       =   2;
        $this->order->is_paid             =   false;
        $this->order->bank_tran_number    =   null;
        $this->order->bank_code           =   null;
        $this->order->delivery_order_code =   null;
        $this->order->cod_amount          =   null;
        $this->order->save();
        // soft delete order
        return redirect()->route('checkout')->withError(Message::PAYMENT_CANCELED);
    }
}
