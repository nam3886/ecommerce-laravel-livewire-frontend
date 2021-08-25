<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Options\WithCartSession;
use App\Models\Order;
use App\Services\Checkout\VNPayCheckoutService;
use App\Services\VNPayService;
use Exception;
use Illuminate\Http\Request;

class VnPayController extends Controller
{
    use WithCartSession;

    private $vnPayService;

    public function __construct()
    {
        $this->vnPayService = new VNPayService;
    }

    public function return(Request $request)
    {
        $order = Order::whereOrderCode($request->vnp_TxnRef)->first();
        $vnPayCheckoutService = new VNPayCheckoutService(order: $order);
        $isValidSecureHash = $this->vnPayService->isValidSecureHash();

        if ($isValidSecureHash && $request->vnp_ResponseCode == '00') {
            // dev environment
            // $vnPayCheckoutService->success();
            $this->cart()->destroy();
            session()->forget($this->voucherSessionKey);
            session()->flash('checkout_success', true);
            return redirect()->route('thank_for_payment', $order->order_code);
        }

        if (!$isValidSecureHash) {
            $errorMessage = "Chu ky khong hop le";
        } elseif ($request->vnp_ResponseCode != '00') {
            $errorMessage = "GD Khong thanh cong";
        }

        return  $vnPayCheckoutService->failed($errorMessage);
    }

    public function notification(Request $request): void
    {
        $order = Order::whereOrderCode($request->vnp_TxnRef)->first();

        try {
            //Kiểm tra checksum của dữ liệu
            if ($this->vnPayService->isValidSecureHash()) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                $orderTotal = $this->vnPayService->urlParams['vnp_Amount'] / $this->vnPayService->moneyTrans;

                if ($order) {
                    if ($order->order_total == $orderTotal) {
                        if (!$order->order_success) {
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                            // production environment
                            (new VNPayCheckoutService(order: $order))->success();
                            //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}
