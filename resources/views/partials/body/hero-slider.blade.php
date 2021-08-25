<div class="hero-slider-section">
    {{-- Slider main container --}}
    <div class="hero-slider-active swiper-container">
        {{-- Additional required wrapper --}}
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="hero-single-slider-item swiper-slide">
                    {{-- Hero Slider Image --}}
                    <div class="hero-slider-bg">
                        <x-images.lazy :src="$banner->imageString()" alt="{{ Str::slug($banner->title) }}-banner" />
                    </div>
                    {{-- Hero Slider Content --}}
                    @if ($banner->title || $banner->content)
                        <div class="hero-slider-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="hero-slider-content">
                                            <h4 class="subtitle">
                                                <strong>
                                                    {!! $banner->title ?? null !!}
                                                </strong>
                                            </h4>
                                            <h2 class="title">{!! $banner->content ?? null !!}</h2>
                                            <a href="{{ route('shop') }}" class="btn btn-lg btn-outline-golden">
                                                shop now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>

        {{-- If we need pagination --}}
        <div class="swiper-pagination active-color-golden"></div>

        {{-- If we need navigation buttons --}}
        <div class="swiper-button-prev d-none d-lg-block"></div>
        <div class="swiper-button-next d-none d-lg-block"></div>
    </div>
</div>
