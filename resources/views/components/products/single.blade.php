@props(['product', 'unique' => ''])

<div {{ $attributes->merge(['class' => 'product-default-single-item product-color--golden']) }}>
    <div class="image-box">
        <x-data.link :value="$product->slug" class="image-link">

            <x-products.single-images :images="$product->gallery" :alt='$product->slug' />

        </x-data.link>

        @if ($product->flag)
            <div class="tag"><span>{{ $product->flag }}</span></div>
        @endif
        @if ($product->quantity <= 0)
            <div class="tag out-of-stock"><span>sold out</span></div>
        @endif

        @if ($product->discount)
            <div class="tag sale">
                <span>
                    <x-data.price :value="$product->discount->discount_format" :negative="true" />
                </span>
            </div>
        @endif
        <div class="action-link">
            <div class="action-link-left">
                <livewire:actions.add-cart-component :key="$product->id.$unique" :product="$product" />
            </div>
            <div class="action-link-right">
                <livewire:actions.show-quick-view-component :key="$product->id.$unique" :productId="$product->id" />

                <livewire:actions.add-wish-list-component :key="$product->id.$unique" :product="$product" />

                <a href="compare.html"><i class="icon-shuffle"></i></a>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="content-left">
            <h6 class="title">
                <x-data.link :value="$product->slug" class="image-link">
                    <x-data.name :value="$product->name" />
                </x-data.link>
            </h6>

            @if ($product->comments_avg_star)
                <x-data.rating class='review-star' :value="$product->comments_avg_star" />
            @endif

        </div>

        @if ($product->discount)
            <div class="content-right text-right">
                <span class="price">
                    <del class="pr-0">
                        <x-data.price :value="$product->price" />
                    </del>
                    <x-data.price :value="$product->price_after_discount" />
                </span>
            </div>
        @else
            <div class="content-right">
                <span class="price">
                    <x-data.price :value="$product->price" />
                </span>
            </div>
        @endif

    </div>
</div>
