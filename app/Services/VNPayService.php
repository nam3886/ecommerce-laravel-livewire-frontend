<?php

namespace App\Services;

use App\Models\Order;

class VNPayService
{
    private Order $order;
    private string $vnp_TmnCode;
    private string $vnp_HashSecret;
    private string $hashData;
    public array $urlParams;
    public int $moneyTrans = 100;

    public function __construct()
    {
        $this->urlParams        =   $this->getParams();
        $this->hashData         =   $this->getHashData();
        $this->vnp_HashSecret   =   config('settings.vnpay_secret_id');
        $this->vnp_TmnCode      =   config('settings.vnpay_client_id');
        abort_if(!$this->vnp_HashSecret || !$this->vnp_TmnCode, 500);
    }

    private function getParams(): array
    {
        $params = request()->except(['vnp_SecureHashType', 'vnp_SecureHash']);
        ksort($params);
        return $params;
    }

    private function getHashData()
    {
        $i = 0;
        $hashdata = "";
        foreach ($this->urlParams as $key => $value) {
            if (!is_string($value) && !is_numeric($value)) break;

            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
        }
        return $hashdata;
    }

    public function isValidSecureHash(): bool
    {
        $secureHash = hash('sha256', $this->vnp_HashSecret . $this->hashData);
        return $secureHash == request()->vnp_SecureHash;
    }

    public function createUrlOrder(Order $order)
    {
        $price = $order->order_total * $this->moneyTrans;
        $this->order            =   $order;
        $vnp_Url                =   "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $this->urlParams        =   [
            "vnp_Version"       =>  "2.0.0",
            "vnp_Locale"        =>  'vn',
            "vnp_Command"       =>  "pay",
            "vnp_CurrCode"      =>  "VND",
            "vnp_OrderType"     =>  'billpayment',
            "vnp_OrderInfo"     =>  'Thanh toán hóa đơn phí dich vụ',
            "vnp_CreateDate"    =>  date('YmdHis'),
            "vnp_IpAddr"        =>  request()->ip(),
            "vnp_ReturnUrl"     =>  route('vnpay.return'),
            "vnp_TmnCode"       =>  $this->vnp_TmnCode,
            "vnp_Amount"        =>  $price,
            "vnp_TxnRef"        =>  $this->order->order_code,
        ];
        ksort($this->urlParams);

        $vnp_Url .= '?' . http_build_query($this->urlParams);
        $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $this->getHashData());
        $vnp_Url .= '&vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        return $vnp_Url;
    }
}
