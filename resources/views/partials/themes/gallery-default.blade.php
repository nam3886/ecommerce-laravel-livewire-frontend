<div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
    {{-- Start Large Image --}}
    <div class="product-large-image product-large-image-horaizontal swiper-container">
        <div class="swiper-wrapper">

            @foreach ($images as $image)
                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                    <x-data.fancybox :src="$image" data-fancybox="gallery-detail">
                        <x-images.lazy :src="$image" alt="slider-img" />
                    </x-data.fancybox>
                </div>
            @endforeach

        </div>
    </div>
    {{-- End Large Image --}}
    {{-- Start Thumbnail Image --}}
    <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
        <div class="swiper-wrapper">

            @foreach ($images as $image)
                <div class="product-image-thumb-single swiper-slide">
                    <x-images.lazy class="img-fluid" :src="$image" alt="product-thumbnail" />
                </div>
            @endforeach

        </div>
        {{-- Add Arrows --}}
        <div class="gallery-thumb-arrow swiper-button-next"></div>
        <div class="gallery-thumb-arrow swiper-button-prev"></div>
    </div>
    {{-- End Thumbnail Image --}}
</div>
