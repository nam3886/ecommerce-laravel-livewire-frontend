<?php

namespace App\Services\Checkout;

use App\Mail\OrderSuccess;
use App\Models\Order;
use App\Services\Checkout\CheckoutService;
use App\Services\VNPayService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class VNPayCheckoutService extends CheckoutService
{
    private $vnPayService;

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
        $this->vnPayService = new VNPayService;
    }

    public function execute()
    {
        try {
            $this->createOrder();
            $url = $this->vnPayService->createUrlOrder($this->order);
            return redirect($url);
        } catch (Exception $e) {
            $this->failed($e);
        }
    }

    public function success()
    {
        $urlParams = $this->vnPayService->urlParams;
        $this->order->is_paid               =   true;
        $this->order->bank_code             =   $urlParams['vnp_TransactionNo']; // Mã giao dịch tại VNPAY
        $this->order->transaction_number    =   $urlParams['vnp_BankCode']; // Ngân hàng thanh toán
        $this->order->bank_tran_number      =   $urlParams['vnp_BankTranNo']; // Mã giao dịch tại Ngân hàng
        $this->order->cod_amount            =   0;
        $this->order->save();

        $this->order->order_success         =   1;
        $this->order->delivery_order_code   =   $this->createShipping()->get('order_code');
        $this->order->save();

        // $this->cart()->destroy();
        // session()->forget($this->voucherSessionKey);
        // session()->flash('checkout_success', true);
        Mail::to($this->order->customer->email)->send(new OrderSuccess($this->order));
        // return redirect()->route('thank_for_payment', $this->order->order_code);
    }

    public function failed($errorMessage)
    {
        $this->order->order_success       =   2;
        $this->order->is_paid             =   false;
        $this->order->bank_tran_number    =   null;
        $this->order->bank_code           =   null;
        $this->order->delivery_order_code =   null;
        $this->order->cod_amount          =   null;
        $this->order->save();
        // soft delete order
        return redirect()->route('checkout')->withError($errorMessage);
    }
}
