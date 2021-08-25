<div class="modal-product-details-content-area">
    <div class="product-details-text">
        <h4 class="title">{{ $product->name }}</h4>
        <x-data.rating class='review-star' :value="$product->comments_avg_star" />
        @isset($variant)
            @if ($variant->discount)
                <div class="price">
                    <del>
                        <x-data.price :value="$variant->price" />
                    </del>
                    <span class='font-weight-bold'>
                        <x-data.price :value="$variant->price_after_discount" />
                    </span>
                </div>
            @else
                <div class="price">
                    <x-data.price :value="$variant->price" />
                </div>
            @endif
        @else
            @if ($product->discount)
                <div class="price">
                    <del>
                        <x-data.price :value="$product->price" />
                    </del>
                    <span class='font-weight-bold'>
                        <x-data.price :value="$product->price_after_discount" />
                    </span>
                </div>
            @else
                <div class="price">
                    <x-data.price :value="$product->price" />
                </div>
            @endif
        @endisset
    </div>
    <div class="product-details-variable">
        <h4 class="title">Available Options</h4>
        @include('partials.body.products.stock')
        @includeWhen($this->product->variants->count() > 1, 'partials.body.products.variant-option')
        @include('partials.body.products.quantity')
    </div>
    <div class="modal-product-about-text">
        <p>{{ $product->sub_description }}</p>
    </div>
</div>
