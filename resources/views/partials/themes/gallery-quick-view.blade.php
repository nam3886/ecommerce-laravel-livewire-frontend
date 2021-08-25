<div class="product-details-gallery-area mb-7" wire:ignore x-data="gallery()" x-init="init"
    x-on:new-gallery.window="newGallery" x-on:modal-shown.window="handleModalShown">
    <div x-ref='top' class="product-large-image modal-product-image-large swiper-container">
        <div class="swiper-wrapper"></div>
    </div>

    <div x-ref='thumb' class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
        <div class="swiper-wrapper"></div>
        <div class="gallery-thumb-arrow swiper-button-next"></div>
        <div class="gallery-thumb-arrow swiper-button-prev"></div>
    </div>
</div>

@push('scripts')
    <script>
        function gallery() {
            return {
                id: null,
                images: [],
                galleryThumbs: null,
                galleryTop: null,
                isFirstTime: true,
                init() {
                    this.galleryThumbs = new Swiper(this.$refs.thumb, {
                        spaceBetween: 10,
                        slidesPerView: 4,
                        freeMode: true,
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        }
                    });

                    this.galleryTop = new Swiper(this.$refs.top, {
                        thumbs: {
                            swiper: this.galleryThumbs
                        }
                    });
                },
                newGallery(event) {
                    this.id = event.detail.id;
                    this.images = event.detail.images;
                    this.galleryThumbs.removeAllSlides();
                    this.galleryTop.removeAllSlides();

                    const top = this.images.map((image) => {
                        return `<div class="product-image-large-image swiper-slide img-responsive"><div class='placeholder-image loading'><img class='lazyload' data-sizes="auto" data-srcset="${image}" data-src="${image}" src="${APP_URL}/svg/image-placeholder-400x400.svg" alt="product-gallery" /></div></div>`;
                    });
                    const thumb = this.images.map((image) => {
                        return `<div class="product-image-thumb-single swiper-slide"><div class='placeholder-image loading'><img class='lazyload' data-sizes="auto" data-srcset="${image}" data-src="${image}" src="${APP_URL}/svg/image-placeholder-400x400.svg" alt="product-thumbnail" /></div></div>`;
                    });

                    this.galleryTop.appendSlide(top);
                    this.galleryThumbs.appendSlide(thumb);
                    let timeout = 1;
                    if (this.isFirstTime) {
                        timeout = 250;
                        this.isFirstTime = false;
                    }
                    setTimeout(() => {
                        $('#quickViewContent').show();
                        $('#skeleton').hide();
                    }, timeout);
                },
                handleModalShown(event) {
                    if (this.id != event.detail.id) {
                        $('#skeleton').show();
                        $('#quickViewContent').hide();
                    }
                }
            }
        }

    </script>
@endpush
