<?php

namespace App\Http\Livewire\Actions;

use App\Http\Livewire\Options\WithCartSession;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

/**
 * When click add to cart => 2 case:
 * 1 only 1 variant => add cart and remove in wish list
 * 2 multiple variant => show modal, user choice variant => 2 case
 * => 1 add cart: => remove in wish list
 * => 2 nothing:
 */

class WishListToCartComponent extends Component
{
    use WithCartSession;

    public $item;
    public int $countVariants;

    public function mount()
    {
        $this->item = collect($this->item);
    }

    public function render()
    {
        return view('livewire.actions.wish-list-to-cart-component');
    }

    // only 1 variant
    public function transferToCart(): void
    {
        $product = Product::with('variants')->find($this->item['id'])->firstOrFail();
        $fields = $this->prepareData($product, $product->variants->first(), 1);

        $this->addCart($product->quantity, $fields, function () {
            Cart::instance('wishlist')->remove($this->item['rowId']);
            $this->emitTo('partials.quick-view-wish-list-component', 'wish-changed');
            $this->emitTo('partials.count-wish-list-component', 'wish-changed');
            $this->emitTo('wish-list-component', 'wish-changed');
        });
    }
}
