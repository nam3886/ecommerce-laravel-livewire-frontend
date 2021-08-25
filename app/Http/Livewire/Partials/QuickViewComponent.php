<?php

namespace App\Http\Livewire\Partials;

use App\Models\Product;
use Livewire\Component;

class QuickViewComponent extends Component
{
    public      ?Product $product           =   null;
    public      string   $wishListRowId     =   '';
    protected            $listeners         =   [
        'open-quick-view'   => 'openQuickView',
        'close-quick-view'  => 'closeQuickView',
    ];

    public function render()
    {
        return view('livewire.partials.quick-view-component');
    }

    public function openQuickView(int $id, string $wishListRowId = '')
    {
        $this->wishListRowId = $wishListRowId;

        if ($this->product?->id === $id) {
            return $this->skipRender();
        }

        $this->product = Product::findOrFail($id);
        $this->dispatchBrowserEvent('clear-variant-quick-view');
        $this->dispatchBrowserEvent('new-gallery', [
            'id'        =>  $this->product->id,
            'images'    =>  $this->product->gallery->imagesString(),
        ]);
    }
}
