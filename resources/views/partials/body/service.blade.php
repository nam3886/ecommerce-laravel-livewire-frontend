<div class="service-promo-section section-top-gap-100">
    <div class="service-wrapper">
        <div class="container">
            <div class="row">

                @foreach ($services as $service)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                            <div class="image">
                                <img class="lazyload" src="{{ $service->imageString() }}"
                                    alt="{{ Str::slug($service->name) }}">
                            </div>
                            <div class="content">
                                <h6 class="title">{{ $service->name }}</h6>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
