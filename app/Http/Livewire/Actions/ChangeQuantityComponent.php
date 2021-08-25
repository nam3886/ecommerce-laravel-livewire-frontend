<?php

namespace App\Http\Livewire\Actions;

use App\Http\Livewire\Options\WithCartSession;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ChangeQuantityComponent extends Component
{
    use WithCartSession;

    public int $max, $min = 1;
    public string $cartId;
    public $quantity;

    public function mount(string $sku)
    {
        $variant    =   Variant::whereSku($sku)->firstOrFail();
        $this->max  =   $variant->quantity;
    }

    public function render()
    {
        return view('livewire.actions.change-quantity-component');
    }

    protected function updatedQuantity($value)
    {
        // $rule = "required|integer|min:{$this->min}|max:{$this->max}";
        $rule = "required|integer|min:1|max:{$this->max}";

        try {
            $this->validate(['quantity' => $rule]);

            $this->changeQuantity($this->cartId, $value);
        } catch (ValidationException $th) {
            $this->quantity = 1;

            $this->flashMessage($th->getMessage(), 'error');
        }
    }
}
