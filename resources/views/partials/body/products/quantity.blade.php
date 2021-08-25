<form x-data="touchSpin($wire,1,{{ $quantity }})" x-init="init;$watch('max',value=>maxChanged(value))"
    @submit.prevent="submit" class="d-sm-flex align-items-center">
    <div class="variable-single-item">
        <span>Quantity</span>
        <div wire:ignore x-ref="touchSpin" class="product-variable-quantity">
            <x-inputs.number x-ref="input" value="{{ $quantity }}" required />
        </div>
    </div>
    <div class="product-add-to-cart-btn mb-4 mb-sm-0">
        <x-inputs.button-spinner :disabled="$max <= 0" class='align-middle' type="submit">
            + ADD TO CART
        </x-inputs.button-spinner>
    </div>
</form>
