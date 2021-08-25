<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Options\WithWishListSession;
use Livewire\Component;

class QuickViewWishListComponent extends Component
{
    use WithWishListSession;

    protected $listeners = ['wish-changed' => 'render'];

    public function render()
    {
        $wishlist = $this->getWishListInfo();
        return view('livewire.partials.quick-view-wish-list-component', compact('wishlist'));
    }

    public function remove($itemId)
    {
        $this->removeWishList($itemId);
    }
}
