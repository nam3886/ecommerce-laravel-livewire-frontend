<div>
    <x-partials.breadcrumb :title="$product->brand->name" :last="$product->name" />
    {{-- Start Product Details Section --}}
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    @include('partials.themes.gallery-default', [
                    'images' => $product->gallery->imagesString()
                    ])
                </div>
                <div class="col-xl-7 col-lg-6">
                    <livewire:products.detail-component :product="$product" wire:key="detail" />
                </div>
            </div>
        </div>
    </div>
    {{-- End Product Details Section --}}
    {{-- Start Product Content Tab Section --}}
    <div class="product-details-content-tab-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                        {{-- Start Product Details Tab Button --}}
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li>
                                <a class="nav-link active" data-bs-toggle="tab" href="#description">
                                    Description
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="tab" href="#specification">
                                    Specification
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="tab" href="#review">
                                    Reviews ({{ $product->comments_count }})
                                </a>
                            </li>
                        </ul>
                        {{-- End Product Details Tab Button --}}

                        {{-- Start Product Details Tab Content --}}
                        <div class="product-details-content-tab" id='productTabContent'>
                            <div class="tab-content">
                                {{-- Start Product Details Tab Content Singel --}}
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>
                                {{-- End Product Details Tab Content Singel --}}
                                {{-- Start Product Details Tab Content Singel --}}
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <table class="table table-bordered mb-20">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Compositions</th>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Styles</th>
                                                    <td>Girly</td>
                                                <tr>
                                                    <th scope="row">Properties</th>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p>Fashion has been creating well-designed collections since 2010. The brand
                                            offers feminine designs delivering stylish separates and statement dresses
                                            which have since evolved into a full ready-to-wear collection in which every
                                            item is a vital part of a woman's wardrobe. The result? Cool, easy, chic
                                            looks with youthful elegance and unmistakable signature style. All the
                                            beautiful pieces are made in Italy and manufactured with the greatest
                                            attention. Now Fashion extends to a range of accessories including shoes,
                                            hats, belts and more!</p>
                                    </div>
                                </div>
                                {{-- End Product Details Tab Content Singel --}}
                                {{-- Start Product Details Tab Content Singel --}}
                                <div class="tab-pane" id="review">
                                    <livewire:products.feedback-component :product="$product" />
                                </div>
                                {{-- End Product Details Tab Content Singel --}}
                            </div>
                        </div> {{-- End Product Details Tab Content --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Product Content Tab Section --}}
    {{-- Start Realted Product Default Slider Section --}}
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        {{-- Start Section Content Text Area --}}
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">RELATED PRODUCTS</h3>
                                <p>Browse the collection of our related products.</p>
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

                                    @foreach ($relatedProducts as $relatedProduct)
                                        <x-products.single class='swiper-slide' unique="productpage"
                                            :product="$relatedProduct" />
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
    {{-- End Realted Product Default Slider Section --}}
</div>

@section('social')
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{ $product->seo_title }}" />
    <meta property="og:description" content="{{ $product->seo_description }}" />
    <meta property="og:image:url" content="{{ $product->seo_image_link }}" />
@endsection

@section('meta-seo')
    <meta name="description" content="{{ $product->seo_description }}" />
    <meta name="keywords" content="{{ $product->seo_keyword }}">
@endsection

@section('title', $product->name)
