<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Options\WithWishListSession;
use Livewire\Component;

class WishListComponent extends Component
{
    use WithWishListSession;

    protected $listeners = ['wish-changed' => 'render'];

    public function render()
    {
        $wishlist = $this->getWishListInfo();
        return view('livewire.wish-list-component', compact('wishlist'));
    }

    public function remove($itemId): void
    {
        $this->removeWishList($itemId);
    }
}
