<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Options\WithCartSession;
use Livewire\Component;

class QuickViewCartComponent extends Component
{
    use WithCartSession;

    protected $listeners = ['cart-changed' => 'render'];

    public function render()
    {
        $carts = $this->getCartInfo();

        return view('livewire.partials.quick-view-cart-component', compact('carts'));
    }

    public function remove($itemId)
    {
        $this->removeCart($itemId);
    }
}
