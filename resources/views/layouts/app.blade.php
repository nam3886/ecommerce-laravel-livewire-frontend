<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="robots" content="index,follow" />
    <meta name="theme-color" content="#FEF5EF">
    <meta name="revisit-after" content="1 days" />
    <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

    @yield('meta-seo')

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-cache-control" content="no-cache">

    <title>@yield('title'){{ ' || ' . config('settings.site_name') }}</title>

    <meta property="og:url" content="{{ url()->full() }}" />

    @yield('social')

    <link rel="preload" href="{{ asset('svg/image-placeholder-400x400.svg') }}" as="image" type="image/svg+xml">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Google+Sans">
    <link rel="preload" href="{{ asset('fonts/font-awesome/fontawesome-webfont3e6e.woff2?v=4.7.0') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/simple-line-icon-fonts/Simple-Line-Iconsb26c.woff2?v=2.4.0') }}"
        as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/ionicon-fonts/ionicons28b5.ttf?v=2.0.0') }}" as="font" type="font/ttf"
        crossorigin>
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_site_image_link('site_favicon') }}">
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </noscript>
    <link rel="stylesheet" href="{{ asset('css/preloading.css') }}">

    @stack('styles')

    <script src="{{ asset('js/vendor/vendor.min.js') }}" defer></script>
    <script src="{{ asset('js/plugins/plugins.min.js') }}" defer></script>
    <script src="{{ asset('js/turbolinks.js') }}" defer></script>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <script src="{{ asset('js/lazysizes.min.js') }}" async></script>
    <livewire:scripts />
</head>

<body class="color-golden">
    @include('partials.header.index')

    {{ $slot ?? null }}

    @yield('content')

    @include('partials.footer.index')

    <script>
        var APP_URL = "{{ config('app.url') }}";
    </script>
    <livewire:styles />
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/livewire-turbolinks.js') }}" data-turbolinks-eval="false"></script>
    <script src="{{ asset('js/once-load.js') }}" data-turbolinks-eval="false" defer></script>
    @stack('scripts')
</body>

</html>
