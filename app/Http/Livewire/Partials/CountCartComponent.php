<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Options\WithCartSession;
use Livewire\Component;

class CountCartComponent extends Component
{
    use WithCartSession;

    public string $theme = 'quick-cart-count';

    protected $listeners = ['cart-changed' => 'render'];

    public function render()
    {
        $count = $this->cart()->content()->count();

        return view("partials.themes.{$this->theme}", compact('count'));
    }
}
