(function ($) {
    "use strict";

    /*****************************
     * Commons Variables
     *****************************/
    var $window = $(window),
        $body = $("body");

    /****************************
     * Sticky Menu
     *****************************/
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
            $(".mobile-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
            $(".mobile-header").addClass("sticky");
        }
    });

    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".seperate-sticky-bar").removeClass("sticky");
        } else {
            $(".seperate-sticky-bar").addClass("sticky");
        }
    });

    /*****************************
     * Off Canvas Function
     *****************************/
    (function () {
        var $offCanvasToggle = $(".offcanvas-toggle"),
            $offCanvas = $(".offcanvas"),
            $offCanvasOverlay = $(".offcanvas-overlay"),
            $mobileMenuToggle = $(".mobile-menu-toggle");
        $offCanvasToggle.on("click", function (e) {
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr("href");
            $body.addClass("offcanvas-open");
            $($target).addClass("offcanvas-open");
            $offCanvasOverlay.fadeIn();
            if ($this.parent().hasClass("mobile-menu-toggle")) {
                $this.addClass("close");
            }
        });
        $(".offcanvas-close, .offcanvas-overlay").on("click", function (e) {
            e.preventDefault();
            $body.removeClass("offcanvas-open");
            $offCanvas.removeClass("offcanvas-open");
            $offCanvasOverlay.fadeOut();
            $mobileMenuToggle.find("a").removeClass("close");
        });
    })();

    /*************************
     *   Hero Slider Active
     **************************/
    var heroSlider = new Swiper(".hero-slider-active.swiper-container", {
        slidesPerView: 1,
        effect: "fade",
        speed: 1500,
        watchSlidesProgress: true,
        loop: true,
        autoplay: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    /****************************************
     *   Product Slider Active - 4 Grid 2 Rows
     *****************************************/
    var productSlider4grid2row = new Swiper(
        ".product-default-slider-4grid-2row.swiper-container",
        {
            slidesPerView: 4,
            spaceBetween: 30,
            speed: 1500,
            slidesPerColumn: 2,
            slidesPerColumnFill: "row",

            navigation: {
                nextEl: ".product-slider-default-2rows .swiper-button-next",
                prevEl: ".product-slider-default-2rows .swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        }
    );

    /*********************************************
     *   Product Slider Active - 4 Grid Single Rows
     **********************************************/
    var productSlider4grid1row = new Swiper(
        ".product-default-slider-4grid-1row.swiper-container",
        {
            slidesPerView: 4,
            spaceBetween: 30,
            speed: 1500,

            navigation: {
                nextEl: ".product-slider-default-1row .swiper-button-next",
                prevEl: ".product-slider-default-1row .swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        }
    );

    /*********************************************
     *   Product Slider Active - 4 Grid Single 3Rows
     **********************************************/
    var productSliderListview4grid3row = new Swiper(
        ".product-listview-slider-4grid-3rows.swiper-container",
        {
            slidesPerView: 4,
            spaceBetween: 30,
            speed: 1500,
            slidesPerColumn: 3,
            slidesPerColumnFill: "row",

            navigation: {
                nextEl: ".product-list-slider-3rows .swiper-button-next",
                prevEl: ".product-list-slider-3rows .swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        }
    );

    /*********************************************
     *   Blog Slider Active - 3 Grid Single Rows
     **********************************************/
    var blogSlider = new Swiper(".blog-slider.swiper-container", {
        slidesPerView: 3,
        spaceBetween: 30,
        speed: 1500,

        navigation: {
            nextEl: ".blog-default-slider > .swiper-button-next",
            prevEl: ".blog-default-slider > .swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        },
    });

    /*********************************************
     *   Company Logo Slider Active - 7 Grid Single Rows
     **********************************************/
    var companyLogoSlider = new Swiper(
        ".company-logo-slider.swiper-container",
        {
            slidesPerView: 7,
            speed: 1500,

            navigation: {
                nextEl: ".company-logo-slider .swiper-button-next",
                prevEl: ".company-logo-slider .swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 7,
                },
            },
        }
    );

    /********************************
     *  Product Gallery - Horizontal View
     **********************************/
    var galleryThumbsHorizontal = new Swiper(
        ".product-image-thumb-horizontal.swiper-container",
        {
            loop: true,
            speed: 1000,
            spaceBetween: 25,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        }
    );

    var gallerylargeHorizonatal = new Swiper(
        ".product-large-image-horaizontal.swiper-container",
        {
            slidesPerView: 1,
            speed: 1500,
            thumbs: {
                swiper: galleryThumbsHorizontal,
            },
        }
    );

    /********************************
     *  Product Gallery - Vertical View
     **********************************/
    var galleryThumbsvartical = new Swiper(
        ".product-image-thumb-vartical.swiper-container",
        {
            direction: "vertical",
            centeredSlidesBounds: true,
            slidesPerView: 4,
            watchOverflow: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            spaceBetween: 25,
            freeMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        }
    );

    var gallerylargeVartical = new Swiper(
        ".product-large-image-vartical.swiper-container",
        {
            slidesPerView: 1,
            speed: 1500,
            thumbs: {
                swiper: galleryThumbsvartical,
            },
        }
    );

    /********************************
     *  Product Gallery - Single Slide View
     * *********************************/
    var singleSlide = new Swiper(
        ".product-image-single-slide.swiper-container",
        {
            loop: true,
            speed: 1000,
            spaceBetween: 25,
            slidesPerView: 4,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        }
    );

    /********************************
     * Blog List Slider - Single Slide
     * *********************************/
    var blogListSLider = new Swiper(".blog-list-slider.swiper-container", {
        loop: true,
        autoHeight: true,
        speed: 1000,
        slidesPerView: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    /************************************************
     * Video  Popup
     ***********************************************/
    $(".video-play-btn").venobox();

    /************************************************
     * Scroll Top
     ***********************************************/
    $("body").materialScrollTop();

    /************************************************
     * Animate on Scroll
     ***********************************************/
    // AOS.init({
    //     duration: 1000,
    //     once: true,
    //     easing: "ease",
    // });
    // window.addEventListener("load", AOS.refresh);

    /************************************************
     * Tooltip
     ***********************************************/
    $('[data-bs-toggle="tooltip"]').tooltip();
})(jQuery);
