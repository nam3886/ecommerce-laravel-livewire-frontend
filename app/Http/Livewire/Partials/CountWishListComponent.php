<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Options\WithWishListSession;
use Livewire\Component;

class CountWishListComponent extends Component
{
    use WithWishListSession;

    public string $theme = 'quick-wish-list-count';

    protected $listeners = ['wish-changed' => 'render'];

    public function render()
    {
        $count = $this->wishlist()->count();
        return view("partials.themes.{$this->theme}", compact('count'));
    }
}
