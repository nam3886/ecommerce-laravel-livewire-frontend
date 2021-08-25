<div class="banner-section">
    <div class="banner-wrapper clearfix">

        @foreach ($brands as $brand)
            <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive"
                data-aos="fade-up" data-aos-delay="0">
                <div class="image">
                    <x-images.lazy class="img-fluid" :src="$brand->imageString()" style="max-height: 240px" />
                </div>
                <a href="{{ route('shop', ['brand' => $brand->id]) }}" class="content">
                    <div class="inner">
                        <h4 class="title">{{ $brand->name }}</h4>
                        <h6 class="sub-title">{{ $brand->products_count }} products</h6>
                    </div>
                    <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
                </a>
            </div>
        @endforeach

    </div>
</div>
