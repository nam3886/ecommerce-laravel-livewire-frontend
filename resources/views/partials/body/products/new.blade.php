<div class="product-default-slider-section section-top-gap-100 section-fluid">
    {{-- Start Section Content Text Area --}}
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">THE NEW ARRIVALS</h3>
                            <p>Preorder now to receive exclusive deals & gifts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Start Section Content Text Area --}}
    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-2rows default-slider-nav-arrow">
                        {{-- Slider main container --}}
                        <div class="swiper-container product-default-slider-4grid-2row">
                            {{-- Additional required wrapper --}}
                            <div class="swiper-wrapper">

                                @foreach ($products as $product)
                                    <x-products.single class='swiper-slide' unique="new" :product="$product" />
                                @endforeach

                            </div>
                        </div>
                        {{-- If we need navigation buttons --}}
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
