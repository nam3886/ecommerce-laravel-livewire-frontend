<?php

namespace App\Http\Livewire\Actions;

use App\Http\Livewire\Options\WithCartSession;
use App\Models\Product;
use Livewire\Component;

class AddCartComponent extends Component
{
    use WithCartSession;

    public Product  $product;
    public string   $class = '';

    protected int $quantity = 1;

    public function render()
    {
        return view('livewire.actions.add-cart-component');
    }

    public function add()
    {
        $variants           =   $this->product->variants;

        // more than 1 variants => user selects variant
        if ($variants->count() > 1) {

            return redirect()->route('product_detail', $this->product->slug);
        }

        $variant = $variants->first();

        $fields = $this->prepareData($this->product, $variants->first(), $this->quantity);

        $this->addCart($variant->quantity, $fields);
    }
}
