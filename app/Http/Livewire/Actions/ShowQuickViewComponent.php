<?php

namespace App\Http\Livewire\Actions;

use Livewire\Component;

class ShowQuickViewComponent extends Component
{
    public int $productId;

    public string $class = '';

    public function render()
    {
        return view('livewire.actions.show-quick-view-component');
    }
}
