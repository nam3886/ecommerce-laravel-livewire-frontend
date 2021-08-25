@props(['thumbnail'])

<div class="blog-list-slider-arrow">
    <div class="blog-list-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($thumbnail as $image)
                <div class="blog-list-slider-img swiper-slide">
                    <x-images.lazy class='img-fluid' :src="$image" />
                </div>
            @endforeach
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
