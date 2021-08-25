<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\Options\WithCartSession;
use Illuminate\Validation\ValidationException;
use App\Models\AttributeValue;
use App\Models\Variant;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailComponent extends Component
{
    use WithCartSession;

    public Product  $product;
    public array    $attributes;
    public array    $variants;
    public string   $wishListRowId  =   '';
    public bool     $isProductPage  =   true;
    // available reset
    public ?Variant $variant        =   null;
    public int      $max            =   0;
    public          $quantity       =   1;

    protected       $listeners      =   ['cart-changed' => 'cartChanged'];
    protected       $rules          =   [
        'variant'                   =>  'required',
        'quantity'                  =>  'required|integer|min:1',
    ];

    public function mount()
    {
        $this->product->variants->count() > 1 && $this->getAttributesAndVariants();
        $this->variant = $this->product->variants->first();
        $this->updateMaxInputQuantity();
    }

    public function render()
    {
        $theme = $this->isProductPage ? 'default' : 'quickview';
        return view("partials.themes.detail-{$theme}");
    }

    public function cartChanged()
    {
        !empty($this->variant) && $this->updateMaxInputQuantity();
    }

    public function add()
    {
        $this->rules['quantity'] .= "|max:{$this->max}";

        try {
            $this->validate();
        } catch (ValidationException $th) {
            return $this->flashMessage($th->validator->getMessageBag()->first(), 'error');
        }

        $fields = $this->prepareData($this->product, $this->variant, $this->quantity);
        $this->addCart($this->variant->quantity, $fields, fn () => $this->handleAddCart());
    }

    public function assignNewVariant(?string $combination)
    {
        if (!$combination) {
            return $this->reset('variant', 'max');
        }

        $this->variant = $this->product->variants->where('combination', $combination)->first();
        $this->updateMaxInputQuantity();
    }

    private function updateMaxInputQuantity(): void
    {
        $quantityInCart = $this->cart()
            ->search(fn ($item) =>  $item->options->sku === $this->variant->sku)
            ->first()
            ?->qty;

        if ($quantityInCart) {
            $this->max = $this->variant->quantity - $quantityInCart;
        } else {
            $this->max = $this->variant->quantity;
        }
    }

    private function getAttributesAndVariants(): void
    {
        // get all attribute values of the product and group by attribute_id
        $this->attributes = cache()->rememberForever(
            "product_detail_attributes_{$this->product->slug}",
            function () {
                return AttributeValue::select('name', 'code', 'attribute_id')
                    ->with(['attribute' => fn ($query) => $query->select('id', 'name')])
                    ->whereHas('variants', fn ($query) => $query->whereProductId($this->product->id))
                    ->get()
                    ->groupBy('attribute_id')
                    ->map(fn ($item, $key) => collect([
                        'id'        =>  $key,
                        'name'      =>  $item->first()->attribute->name,
                        'values'    =>  $item,
                    ]))
                    ->toArray();
            }
        );

        // get all variants with attributeValues
        $this->variants = cache()->rememberForever(
            "product_detail_variants_{$this->product->slug}",
            function () {
                return $this->product->variants()->with('attributeValues')->get()
                    ->map(function ($variant) {
                        return [
                            'combination'       =>  $variant->combination,
                            'values'            =>  $variant->attributeValues->map(fn ($value) => [
                                'code'          =>  $value->code,
                                'attribute_id'  =>  $value->attribute_id
                            ]),
                        ];
                    })
                    ->toArray();
            }
        );
    }

    private function handleAddCart(): void
    {
        $this->updateMaxInputQuantity();
        $this->reset('quantity');
        $this->dispatchBrowserEvent('close-modal-quick-view');

        // wish list to cart
        if (!$this->isProductPage && $this->wishListRowId) {
            Cart::instance('wishlist')->remove($this->wishListRowId);
            $this->emitTo('partials.quick-view-wish-list-component', 'wish-changed');
            $this->emitTo('partials.count-wish-list-component', 'wish-changed');
            $this->emitTo('wish-list-component', 'wish-changed');
        }
    }
}
