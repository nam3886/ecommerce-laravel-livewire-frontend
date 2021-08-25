<div class="d-inline-block">
    @if ($product->quantity <= 0)
        <x-data.link :value="$product->slug" class='align-middle {{ $class }}'>
            CLICK TO VIEW
        </x-data.link>
    @else
        <x-inputs.button-spinner class='align-middle {{ $class }}' wire:click='add' type="button">
            ADD TO CART
        </x-inputs.button-spinner>
    @endif
</div>
