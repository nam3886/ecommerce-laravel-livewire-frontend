<div class="banner-section section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                {{-- Start Banner Single Item --}}
                <div class="banner-single-item banner-style-3 banner-animation img-responsive" data-aos="fade-up"
                    data-aos-delay="0">
                    <div class="image">
                        <x-images.lazy class="img-fluid" :src="$banner->imageString()" alt="best-banner-2" />
                    </div>
                    <div class="content">
                        <h3 class="title">{!! $banner->title !!}</h3>
                        <h5 class="sub-title">{!! $banner->content !!}</h5>
                        <a href="{{ route('shop') }}" class="btn btn-lg btn-outline-golden icon-space-left"><span
                                class="d-flex align-items-center">discover now <i
                                    class="ion-ios-arrow-thin-right"></i></span></a>
                    </div>
                </div>
                {{-- End Banner Single Item --}}
            </div>
        </div>
    </div>
</div>
