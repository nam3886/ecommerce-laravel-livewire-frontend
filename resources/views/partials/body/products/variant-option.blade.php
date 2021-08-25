<div wire:ignore wire:key='variant-detail-default-{{ $isProductPage ?: 'quick-view' }}' x-data="variant($wire)"
    x-init="$watch('accepted',assignNewVariant)" @unless($isProductPage)
    x-on:clear-variant-quick-view.window="clearSelected" @endunless class="variant-options">
    @foreach ($attributes as $attribute)
        <div class="variable-single-item">
            <span class='text-capitalize'>{{ $attribute['name'] }}</span>
            @foreach ($attribute['values'] as $_item)
                <button x-on:click="select({{ $attribute['id'] }},'{{ $_item['code'] }}')"
                    :disabled="!isValid({{ $attribute['id'] }}, '{{ $_item['code'] }}')"
                    :class="classSelect({{ $attribute['id'] }}, '{{ $_item['code'] }}')" type="button"
                    class="variant btn">
                    {{ $_item['name'] }}
                </button>
            @endforeach
        </div>
    @endforeach
</div>
