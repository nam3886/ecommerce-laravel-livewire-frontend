<div class="banner-section section-top-gap-100 section-fluid">
    <div class="banner-wrapper">
        <div class="container-fluid">
            <div class="row mb-n6">
                <div class="col-lg-6 col-12 mb-6">
                    {{-- Start Banner Single Item --}}
                    <div class="banner-single-item banner-style-1 banner-animation img-responsive" data-aos="fade-up"
                        data-aos-delay="0">
                        <div class="image">
                            <x-images.lazy :src="$banners->first()->imageString()" alt="best-banner" />
                        </div>
                        <div class="content">
                            <h4 class="title">{!! $banners->first()->title !!}</h4>
                            <h5 class="sub-title">{!! $banners->first()->content !!}</h5>
                            <a href="{{ route('shop') }}" class="btn btn-lg btn-outline-golden icon-space-left">
                                <span class="d-flex align-items-center">discover now <i
                                        class="ion-ios-arrow-thin-right"></i></span></a>
                        </div>
                    </div>
                    {{-- End Banner Single Item --}}
                </div>

                <div class="col-lg-6 col-12 mb-6">
                    <div class="row mb-n6">

                        @foreach ($banners as $banner)

                            @if ($loop->first) @continue @endif

                            <div class="col-lg-6 col-sm-6 mb-6">
                                <div class="banner-single-item banner-style-2 banner-animation img-responsive"
                                    data-aos="fade-up" data-aos-delay="0">
                                    <div class="image">
                                        <x-images.lazy :src="$banner->imageString()" alt="best-banner-2" />
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{!! $banner->title !!}</h4>
                                        <a href="{{ route('shop') }}" class="link-text">
                                            <span>Shop now</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
