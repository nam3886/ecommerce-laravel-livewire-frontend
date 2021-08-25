<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThankForPaymentComponent extends Component
{
    public string $orderNumber;

    public function mount(string $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function render()
    {
        return view('livewire.thank-for-payment-component');
    }
}
