<?php

namespace App\Services\Checkout;

use App\Helpers\Currency;
use App\Http\Livewire\Options\WithCartSession;
use App\Models\Order;
use App\Models\Voucher;
use App\Services\GHN\GHNOrderService;
use Illuminate\Support\Collection;

abstract class CheckoutService
{
    use WithCartSession;

    protected $voucher;
    protected $transactionNumber;
    protected int $deliveryFee;
    protected Order $order;
    protected object $cart;
    protected Collection $user;

    public function __construct(Collection $user, int $deliveryFee, $transactionNumber)
    {
        $this->voucher = Voucher::whereCode(session($this->voucherSessionKey))->first();
        $this->cart = $this->getCartInfo();
        $this->transactionNumber = $transactionNumber;
        $this->deliveryFee = $deliveryFee;
        $this->user = $user;
    }

    /**
     * @return @this
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    public function createOrder(): void
    {
        $order                      =   new Order;
        $order->user_id             =   auth()->id();
        $order->payment_id          =   $this->user->get('payment_id');
        $order->delivery_id         =   $this->user->get('delivery_id');
        $order->voucher_id          =   $this->voucher?->id;
        $order->order_code          =   uniqid('VN');
        $order->items_count         =   $this->cart->count;
        $order->total_price         =   $this->cart->total_price;
        $order->discount_price      =   $this->cart->discount;
        $order->tax_price           =   $this->cart->tax;
        $order->sub_total           =   $this->cart->sub_total;
        $order->grand_total         =   $this->cart->grand_total;
        $order->order_total         =   $this->cart->grand_total + $this->deliveryFee;
        $order->transaction_number  =   $this->transactionNumber;
        $order->name                =   $this->user->get('name');
        $order->phone               =   $this->user->get('phone');
        $order->delivery_service_id =   $this->user->get('delivery_service_id');
        $order->delivery_fee        =   $this->deliveryFee;
        $order->address             =   $this->user->get('fullAddress');
        $order->api_address         =   ['ghn' => $this->user->only('district', 'ward', 'street')];
        $order->note                =   $this->user->get('note');

        $order->save();

        foreach ($this->cart->content as $cart) {
            $order->items()->attach($cart->id, [
                'sku'           =>  $cart->options->sku,
                'price'         =>  $cart->price,
                'quantity'      =>  $cart->qty,
                'discount_id'   =>  $cart->model->discount?->id,
            ]);
        }

        $this->order = $order;

        $this->postCreateOrder();
    }

    private function postCreateOrder(): void
    {
        if ($this->order->payment->code === 'paypal') {
            $this->order->exchange_currency = ['from' => 'VND', 'to' => 'USD'];
            $this->order->exchange_rate = Currency::getRate('VND', 'USD');
        } else {
            $this->order->exchange_currency = ['from' => 'VND', 'to' => 'VND'];
            $this->order->exchange_rate = 1;
        }
        $this->order->save();
    }

    public function createShipping(): Collection
    {
        $GHNOrderService = new GHNOrderService();

        return $GHNOrderService
            ->from(1463, 21804)
            ->to($this->order->api_address->ghn->district, $this->order->api_address->ghn->ward)
            ->setDeliveryInfo($this->order->name, $this->order->phone, $this->order->address)
            ->setServiceId($this->order->delivery_service_id)
            ->setPackage(10, 10, 10, 200)
            ->setOrder($this->order)
            ->createOrder();
    }

    public abstract function execute();

    public abstract function success();

    public abstract function failed($exception);
}
