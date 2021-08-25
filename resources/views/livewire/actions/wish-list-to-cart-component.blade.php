<div>
    @if ($countVariants <= 1)
        <x-inputs.button-spinner type="button" class="btn btn-md btn-golden" wire:click="transferToCart">
            Add To Cart
        </x-inputs.button-spinner>
    @else
        <div x-data>
            <x-inputs.button-spinner type="button" class="btn btn-md btn-golden"
                x-on:click="$dispatch('modal-shown', { id: {{ $item['id'] }} })" wire:click="transferToCart"
                data-bs-toggle="modal" data-bs-target="#modalQuickview"
                wire:click="$emit('open-quick-view', {{ $item['id'] }}, '{{ $item['rowId'] }}')">
                Add To Cart
            </x-inputs.button-spinner>
        </div>
    @endif
</div>
