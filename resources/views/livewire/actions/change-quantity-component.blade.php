<div>
    <div class='justify-content' wire:ignore x-data="touchSpin($wire,1,{{ $quantity }},false)"
        x-init="init;$watch('max',(value) => maxChanged(value))">
        <x-inputs.number x-ref="input" value="{{ $quantity }}" required />
    </div>

    @error('quantity')
        <div class='mt-2'>
            <span class="toast-invalid error-validate">{{ $message }}</span>
        </div>
    @enderror
</div>
