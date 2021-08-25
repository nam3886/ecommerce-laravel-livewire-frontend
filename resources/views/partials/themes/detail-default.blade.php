<div data-aos="fade-up" data-aos-delay="200"
    class="product-details-content-area product-details--golden aos-init aos-animate">
    <div class="product-details-text">
        <h4 class="title">{{ $product->name }}</h4>
        <div class="d-flex align-items-center">
            <x-data.rating class='review-star' :value="$product->comments_avg_star" />
            @if ($product->comments_count)
                <a x-data='gotoReview' x-on:click.prevent='handleClick' href="#" class="customer-review ml-2">
                    ({{ $product->comments_count }} customers review )
                </a>
            @endif
        </div>
        <div wire:key='price'>
            @isset($variant)
                @if ($variant->discount)
                    <p class='price-preview'>
                        <del>
                            <x-data.price :value="$variant->price" />
                        </del>
                        <span class="price">
                            <x-data.price :value="$variant->price_after_discount" />
                        </span>
                        <span class="saving-price">
                            <x-data.price :value="$variant->discount->discount_format" :negative="true" />
                        </span>
                    </p>
                @else
                    <p class='price-preview'>
                        <span class="price">
                            <x-data.price :value="$variant->price" />
                        </span>
                    </p>
                @endif
            @else
                @if ($product->discount)
                    <p class='price-preview'>
                        <del>
                            <x-data.price :value="$product->price" />
                        </del>
                        <span class="price">
                            <x-data.price :value="$product->price_after_discount" />
                        </span>
                        <span class="saving-price">
                            <x-data.price :value="$product->discount->discount_format" :negative="true" />
                        </span>
                    </p>
                @else
                    <p class='price-preview'>
                        <span class="price">
                            <x-data.price :value="$product->price" />
                        </span>
                    </p>
                @endif
            @endisset
        </div>
    </div>
    <div class="product-details-variable mt-3">
        <h4 class="title">Available Options</h4>
        @include('partials.body.products.stock')
        @includeWhen($this->product->variants->count() > 1, 'partials.body.products.variant-option')
        @include('partials.body.products.quantity')
        <div class="product-details-meta mb-20">
            <livewire:actions.add-wish-list-component :wire:key="'detail-'.$product->id" :product="$product"
                theme='add-wish-list-product-detail' />
            <a href="#" class="icon-space-right"><i class="icon-refresh"></i>Compare</a>
        </div>
    </div>
    <div class="product-details-catagory mb-2">
        <span class="title">TAGS:</span>
        <ul>
            @foreach ($product->tags as $tag)
                <li><a href="{{ route('shop', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="product-details-social">
        <span class="title">LIKE THIS PRODUCT:</span>
        <ul>
            <li>
                <x-partials.socialites.facebook-like :url="route('product_detail', $product->slug)" />
            </li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <div class="product-details-social">
        <span class="title">SHARE THIS PRODUCT:</span>
        <ul>
            <li>
                <x-partials.socialites.facebook-share :url="route('product_detail', $product->slug)" />
            </li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
</div>

@push('scripts')
    <script>
        function gotoReview() {
            return {
                handleClick() {
                    const nav = $(`a[href="#review"]`);
                    nav.tab("show");
                    $("html, body").animate({
                        scrollTop: nav.offset().top
                    });
                }
            }
        }
    </script>
@endpush
