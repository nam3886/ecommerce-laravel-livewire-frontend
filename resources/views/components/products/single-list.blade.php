@props(['product', 'unique' => ''])

<div class="product-list-single product-color--golden">
    <x-data.link :value="$product->slug" class="product-list-img-link">

        <x-products.single-images :images="$product->gallery" :alt='$product->slug' />

    </x-data.link>

    <div class="product-list-content">
        <h5 class="product-list-link">
            <x-data.link :value="$product->slug">
                <x-data.name :value="$product->name" />
            </x-data.link>
        </h5>

        @if ($product->comments_avg_star)
            <x-data.rating class='review-star' :value="$product->comments_avg_star" />
        @endif

        <span class="product-list-price">
            @if ($product->discount)
                <del>
                    <x-data.price :value="$product->price" />
                </del>
                <x-data.price :value="$product->price_after_discount" />
            @else
                <x-data.price :value="$product->price" />
            @endif
        </span>

        <p>
            <x-data.content :value="$product->sub_description" />
        </p>
        <div class="product-action-icon-link-list">
            <livewire:actions.add-cart-component :key="$product->id.$unique" :product="$product"
                class='btn btn-lg btn-black-default-hover' />

            <livewire:actions.show-quick-view-component :key="$product->id.$unique" :productId="$product->id"
                class='btn btn-lg btn-black-default-hover' />

            <livewire:actions.add-wish-list-component :key="$product->id.$unique" :product="$product"
                theme='add-wish-list-single-list' />

            <a href="compare.html" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
        </div>
    </div>
</div>
