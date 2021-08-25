<div class="variable-single-item">
    <div class="product-stock">
        @if ((isset($variant) ? $variant->quantity : $product->quantity) > 0)
            <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span>
            {{ isset($variant) ? $variant->quantity : $product->quantity }} IN STOCK
        @else
            <span class="product-stock-out"><i class="ion-close-circled"></i></span>
            OUT OF STOCK
        @endif
    </div>
</div>
