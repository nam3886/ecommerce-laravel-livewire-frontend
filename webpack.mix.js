const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js("resources/js/app.js", "public/js").postCss(
//     "resources/css/app.css",
//     "public/css",
//     [require("postcss-import"), require("tailwindcss"), require("autoprefixer")]
// );

mix.styles(
    [
        // "public/css/preloading.css",
        "public/css/vendor/font-awesome.min.css",
        "public/css/vendor/ionicons.css",
        "public/css/vendor/simple-line-icons.css",

        "public/css/plugins/animate.min.css",
        // "public/css/plugins/aos.min.css",
        "public/css/plugins/ion.rangeSlider.min.css",
        "public/css/plugins/swiper-bundle.min.css",
        "public/css/plugins/venobox.min.css",
        "public/css/plugins/jquery.fancybox.css",
        "public/css/plugins/toastr.min.css",
        "public/css/plugins/select2.min.css",
        "public/css/vendor/bootstrap.css",

        "public/css/style.css",
        "public/css/lazy-loading.css",
        "public/css/loading-skeleton.css",
        "public/css/search.css",
        "public/css/spinner.css",
        "public/css/select2.css",
        "public/css/pages/auth.css",
        "public/css/pages/checkout.css",
        "public/css/pages/cart.css",
    ],
    "public/css/app.css"
);
