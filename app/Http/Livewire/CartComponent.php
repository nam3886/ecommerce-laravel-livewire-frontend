<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Options\WithCartSession;
use Livewire\Component;

class CartComponent extends Component
{
    use WithCartSession;

    protected $listeners    =   [
        'empty-cart' => 'redirectToEmptyCart',
        'cart-changed' => 'render',
    ];

    public function render()
    {
        $carts = $this->getCartInfo();

        return view('livewire.cart-component', compact('carts'));
    }

    public function remove($itemId)
    {
        $this->removeCart($itemId);
    }
}
