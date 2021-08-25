@props(['target' => null])

<button @if ($target) wire:target='{{ $target }}' @endif
    wire:loading.attr='disabled' {{ $attributes->merge(['class' => 'btn-spinner']) }}>
    <div class="spinner" wire:loading.class='loading' @if ($target) wire:target='{{ $target }}' @endif>
        <x-inputs.spinner />
        <div class='text'>Loading...</div>
    </div>

    <span wire:loading.remove @if ($target) wire:target='{{ $target }}' @endif>{{ $slot }}</span>
</button>
