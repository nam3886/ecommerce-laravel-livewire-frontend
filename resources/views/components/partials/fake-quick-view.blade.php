<div class="row" {{ $attributes }}>
    <div class="col-md-6">
        <div class="product-details-gallery-area mb-7">
            {{-- Start Large Image --}}
            <div class="product-large-image modal-product-image-large swiper-container">
                <div class='loading-skeleton loading image'>
                    <x-images.lazy src="{{ asset('/svg/image-placeholder-400x400.svg') }}" />
                </div>
            </div>
            {{-- End Large Image --}}
            {{-- Start Thumbnail Image --}}
            <div class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class='loading-skeleton loading image mr-1' style="width: 25%">
                            <x-images.lazy src="{{ asset('/svg/image-placeholder-400x400.svg') }}" />
                        </div>
                        <div class='loading-skeleton loading image mx-1' style="width: 25%">
                            <x-images.lazy src="{{ asset('/svg/image-placeholder-400x400.svg') }}" />
                        </div>
                        <div class='loading-skeleton loading image mx-1' style="width: 25%">
                            <x-images.lazy src="{{ asset('/svg/image-placeholder-400x400.svg') }}" />
                        </div>
                        <div class='loading-skeleton loading image ml-1' style="width: 25%">
                            <x-images.lazy src="{{ asset('/svg/image-placeholder-400x400.svg') }}" />
                        </div>
                    </div>
                </div>
                {{-- Add Arrows --}}
                <div class="gallery-thumb-arrow swiper-button-next"></div>
                <div class="gallery-thumb-arrow swiper-button-prev"></div>
            </div>
            {{-- End Thumbnail Image --}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="modal-product-details-content-area">
            <div class="product-details-text mb-2">
                <div class="col-10 loading-skeleton loading text"></div>
            </div>
            <div class="product-details-text">
                <div class="col-3 loading-skeleton loading text endl"></div>
                <div class="col-2 loading-skeleton loading text endl"></div>
            </div>
            <div class="product-details-variable">
                <div class="col-4 loading-skeleton loading text mb-5"></div>
                <div class="col-3 loading-skeleton loading text mb-4"></div>
                <div class="variable-single-item">
                    <div class="col-2 loading-skeleton loading text"></div>
                    <div class="col-12 loading-skeleton loading text text-lg endl"></div>
                </div>
                <div class="variable-single-item">
                    <div class="col-2 loading-skeleton loading text"></div>
                    <div class="col-12 loading-skeleton loading text text-lg endl"></div>
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <div class="variable-single-item ">
                        <span>Quantity</span>
                        <div class="product-variable-quantity">
                            <input min="1" max="100" value="1" type="number" disabled>
                        </div>
                    </div>

                    <div class="product-add-to-cart-btn">
                        <button type='button' disabled>
                            + ADD TO CART
                        </button>
                    </div>
                </div>
            </div>
            {{-- End Product Variable Area --}}
            <div class="modal-product-about-text">
                <div class="price col-12 loading-skeleton loading text"></div>
                <div class="price col-12 loading-skeleton loading text endl"></div>
                <div class="price col-12 loading-skeleton loading text endl"></div>
                <div class="price col-12 loading-skeleton loading text endl"></div>
                <div class="price col-8 loading-skeleton loading text mt-1 mb-4"></div>
            </div>
        </div>
    </div>
</div>
