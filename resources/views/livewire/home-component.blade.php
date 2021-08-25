<div class='home'>
    @include('partials.body.hero-slider', ['banners' => $bannersSlider])

    @include('partials.body.service', $services)

    @includeWhen(!empty($bannersBody1), 'partials.body.banners.first', ['banners' => $bannersBody1])

    @include('partials.body.products.new', ['products' => $newProducts])

    @includeWhen(!empty($bannerBody2), 'partials.body.banners.second', ['banner' => $bannerBody2])

    @include('partials.body.products.best-sell', ['products' => $bestProducts])

    @include('partials.body.banners.third', $brands)

    @include('partials.body.blog-slider', $articles)
</div>

@section('title', 'Home')
