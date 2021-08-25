<form wire:submit.prevent='addVoucher' x-data="{isValid:@entangle('isValid')}">

    <input wire:model.defer='voucher' :disabled="isValid" :class="{'is-valid':isValid}" required
        placeholder="Coupon code" type="text" class='{{ $class['input'] ?? null }}'>

    <x-inputs.button-spinner class="{{ $class['button'] ?? null }}" type="submit" target='addVoucher'
        x-show="!isValid" x-bind:disabled="isValid">
        Apply coupon
    </x-inputs.button-spinner>

    <x-inputs.button-spinner class="{{ $class['button'] ?? null }}" type="button" wire:click="removeVoucher"
        x-show="isValid" x-bind:disabled="!isValid">
        Remove coupon
    </x-inputs.button-spinner>

    @if ($voucherDescription)
        <div class='mt-2'>
            <p>{{ $voucherDescription }}</p>
        </div>
    @endif

</form>
