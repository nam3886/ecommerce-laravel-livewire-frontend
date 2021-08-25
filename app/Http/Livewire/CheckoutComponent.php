<?php

namespace App\Http\Livewire;

use App\Helpers\Currency;
use App\Http\Livewire\Options\WithCartSession;
use App\Http\Livewire\Options\WithLocation;
use Illuminate\Support\Collection;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\UserShippingAddress;
use App\Services\Checkout\CashCheckoutService;
use App\Services\Checkout\PayPalCheckoutService;
use App\Services\Checkout\StripeCheckoutService;
use App\Services\Checkout\VNPayCheckoutService;
use App\Services\GHN\GHNLocationService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use WithCartSession, WithLocation;

    public Collection   $user;
    public Collection   $payments;
    public Collection   $deliveries;
    public Collection   $cart;
    public Collection   $deliveryItems;
    public int          $shippingFee = 0;
    public string       $expectTime = '';

    protected $listeners    =   [
        'empty-cart' => 'redirectToEmptyCart',
        'cart-changed' => 'updateDelivery',
    ];
    protected $rules        =   [
        'user.name'         =>  'required|string',
        'user.phone'        =>  'required|regex:/(^0[1-9])[0-9]{8}$/',
        'user.district'     =>  'required|integer',
        'user.ward'         =>  'required',
        'user.street'       =>  'required|string|max:256',
        'user.note'         =>  'nullable|string|max:2048',
        'user.delivery_id'  =>  'required|exists:App\Models\Delivery,id',
        'user.payment_id'   =>  'required|exists:App\Models\Payment,id',
        'user.delivery_service_id' => 'required|integer',
    ];

    public function mount(): void
    {
        $this->user             =   collect();
        $this->deliveryItems    =   collect();
        $this->payments         =   Payment::whereActive(1)->get();
        $this->deliveries       =   Delivery::whereActive(1)->get();
        $this->user->put('delivery_id', $this->deliveries->first()->id);
        $this->getUserInformation();
    }

    public function render(): View
    {
        $this->cart = collect($this->getCartInfo());
        return view('livewire.checkout-component');
    }

    protected function updatedUserDistrict(): void
    {
        unset($this->user['ward']);
        $this->getWards();
    }

    public function updateUserAddress(array $user): void
    {
        $this->user = $this->user->merge(collect($user)->only('street', 'phone', 'name'));
        unset($this->rules['user.delivery_id'], $this->rules['user.payment_id'], $this->rules['user.delivery_service_id']);
        $this->validate();

        $fullAddress = $this->user->get('street')
            . ', '
            . $this->wards->where('id', $this->user->get('ward'))->first()['text']
            . ', '
            . $this->districts->where('id', $this->user->get('district'))->first()['text'];

        UserShippingAddress::updateOrCreate(
            [
                'user_id' => auth()->id()
            ],
            [
                'name' => $this->user->get('name'),
                'phone' => $this->user->get('phone'),
                'fullAddress' => $fullAddress,
                'api' => [
                    'ghn' => [
                        'district' => intval($this->user->get('district')),
                        'ward' => $this->user->get('ward'),
                        'street' => $this->user->get('street'),
                    ]
                ]
            ]
        );

        $this->getUserInformation();
        $this->updateDelivery();
        $this->flashMessage(Message::UPDATE_ADDRESS_SUCCESS);
        $this->dispatchBrowserEvent('updated-user-address');
    }

    public function getUserInformation(): void
    {
        $this->user->put('name', auth()->user()->address->name ?? auth()->user()->name);
        $this->user->put('phone', auth()->user()->address->phone ?? auth()->user()->phone);
        if (!auth()->user()->address) return;
        $this->user->put('fullAddress', auth()->user()->address->fullAddress);
        $this->user = $this->user->merge(auth()->user()->address->api->ghn);
    }

    public function updateDelivery(): void
    {
        if (auth()->user()->address) {
            $this->getDeliveryItems();
            $this->calculateShippingFee();
        }
    }

    private function getDeliveryItems()
    {
        $location = new GHNLocationService();
        $location->from(1463, 21804)->to($this->user->get('district'), $this->user->get('ward'));

        try {
            $this->deliveryItems = $location->getServices()
                ->where('service_type_id', '!==', 0)->map(function ($item) use ($location) {
                    return array_merge($item, [
                        'fee' => $this->autoGetFee($item['service_id'], $location)
                    ]);
                });
        } catch (\Throwable $th) {
            return $this->flashErrorMessage($th->getMessage());
        }

        $this->user->put('delivery_service_id', $this->deliveryItems->first()['service_id']);
    }

    public function calculateShippingFee()
    {
        $this->validateOnly('user.delivery_id');
        $this->validateOnly('user.district');
        $this->validateOnly('user.ward');

        $location = new GHNLocationService();
        $location->from(1463, 21804)->to($this->user->get('district'), $this->user->get('ward'));
        if ($this->user->has('delivery_service_id')) {
            try {
                $this->shippingFee = $this->autoGetFee($this->user->get('delivery_service_id'), $location);
                $expectTime = $location->calculateDeliveryTime()->get('leadtime');
            } catch (\Throwable $th) {
                return $this->flashErrorMessage($th->getMessage());
            }

            $this->expectTime = Carbon::createFromTimestamp($expectTime)->toFormattedDateString();
            $this->dispatchBrowserEvent('calculated-shipping-fee');
        }
    }

    private function autoGetFee(int $serviceId, $location)
    {
        $fee = $location->setServiceId($serviceId)
            ->setPackage(10, 10, 10, 200)
            ->calculateFee($this->getCartInfo()->grand_total)
            ->get('total');

        return Currency::ceilThousand($fee);
    }

    public function checkout($paymentId, $stripeToken = null)
    {
        // cart is empty
        if (!$this->cart->get('count')) return redirect()->route('empty_cart');
        $this->user->put('payment_id', $paymentId);
        $this->validate();

        $payment = Payment::find($paymentId);

        if ($payment->code === 'stripe' && is_null($stripeToken)) {
            return $this->flashErrorMessage(Message::ENTER_CREDIT_CARD);
        }

        $service = match ($payment->code) {
            'paypal' => PayPalCheckoutService::class,
            'stripe' => StripeCheckoutService::class,
            'vnpay'  => VNPayCheckoutService::class,
            default  => CashCheckoutService::class,
        };

        try {
            (new $service($this->user, $this->shippingFee, $stripeToken))->execute();
        } catch (\Throwable $th) {
        $this->flashErrorMessage($th->getMessage());
        }
    }
}
