<?php

namespace App\Http\Livewire\Actions;

use App\Http\Livewire\Options\WithWishListSession;
use App\Models\Product;
use Livewire\Component;

class AddWishListComponent extends Component
{
    use WithWishListSession;

    public Product  $product;
    public string   $theme = 'add-wish-list-single';
    protected int   $quantity = 1;

    public function render()
    {
        return view("partials.themes.{$this->theme}");
    }

    public function add()
    {
        $this->addWishList($this->product, $this->quantity);
    }
}
