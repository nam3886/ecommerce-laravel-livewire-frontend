<div class="logo">
    <a href="{{ route('home') }}">
        <img src="{{ get_site_image_link('site_logo') }}" alt="site_logo"
            {{ $attributes->merge(['class' => 'lazyload']) }}>
    </a>
</div>
