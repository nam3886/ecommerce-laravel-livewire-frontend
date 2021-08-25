<div class="blog-default-slider-section section-top-gap-100 section-fluid">
    {{-- Start Section Content Text Area --}}
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">THE LATEST BLOGS</h3>
                            <p>Present posts in a best way to highlight interesting moments of your blog.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Start Section Content Text Area --}}
    <div class="blog-wrapper" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-default-slider default-slider-nav-arrow">
                        {{-- Slider main container --}}
                        <div class="swiper-container blog-slider">
                            {{-- Additional required wrapper --}}
                            <div class="swiper-wrapper">

                                @foreach ($articles as $article)
                                    <div class="blog-default-single-item blog-color--golden swiper-slide">
                                        <div class="image-box">
                                            <x-dynamic-component :component="'blogs.'.$article->frontend_type"
                                                :thumbnail="$article->thumbnail" />
                                        </div>
                                        <div class="content">
                                            <h6 class="title">
                                                <x-data.link route="article_detail" :value="$article->slug">
                                                    {{ $article->title }}
                                                </x-data.link>
                                            </h6>
                                            <p>{{ $article->description }}</p>
                                            <div class="inner">
                                                <x-data.link route="article_detail" :value="$article->slug">
                                                    Read More <span>
                                                        <i class="ion-ios-arrow-thin-right"></i>
                                                    </span>
                                                </x-data.link>
                                                <div class="post-meta">
                                                    <a href="#" class="date">
                                                        {{ $article->created_at->diffForHumans() }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
