<a class='{{ $class }}' data-bs-toggle="modal" data-bs-target="#modalQuickview" href="#" x-data
    x-on:click="$dispatch('modal-shown', { id: {{ $productId }} })"
    wire:click.prevent='$emit("open-quick-view", {{ $productId }})'>
    <i class="icon-magnifier"></i>
</a>
