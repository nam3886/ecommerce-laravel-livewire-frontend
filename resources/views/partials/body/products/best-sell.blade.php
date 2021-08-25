<div class="product-default-slider-section section-top-gap-100 section-fluid section-inner-bg">
    {{-- Start Section Content Text Area --}}
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">BEST SELLERS</h3>
                            <p>Add our best sellers to your weekly lineup.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Start Section Content Text Area --}}
    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-1row default-slider-nav-arrow">
                        {{-- Slider main container --}}
                        <div class="swiper-container product-default-slider-4grid-1row">
                            {{-- Additional required wrapper --}}
                            <div class="swiper-wrapper">
                                @foreach ($products as $product)
                                    <x-products.single class='swiper-slide' unique="bestSell" :product="$product" />
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
