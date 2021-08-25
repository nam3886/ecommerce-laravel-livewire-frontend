<div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-details-gallery-area mb-7">
                                {{-- Start Large Image --}}
                                <div class="product-large-image modal-product-image-large swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-1.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-2.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-3.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-4.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-5.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="{{ asset('images/product/default/home-1/default-6.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                                {{-- End Large Image --}}
                                {{-- Start Thumbnail Image --}}
                                <div
                                    class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
                                    <div class="swiper-wrapper">
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-1.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-2.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-3.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-4.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-5.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid"
                                                src="{{ asset('images/product/default/home-1/default-6.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    {{-- Add Arrows --}}
                                    <div class="gallery-thumb-arrow swiper-button-next"></div>
                                    <div class="gallery-thumb-arrow swiper-button-prev"></div>
                                </div>
                                {{-- End Thumbnail Image --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-details-content-area">
                                {{-- Start  Product Details Text Area --}}
                                <div class="product-details-text">
                                    <h4 class="title">Nonstick Dishwasher PFOA</h4>
                                    <div class="price"><del>$70.00</del>$80.00</div>
                                </div> {{-- End  Product Details Text Area --}}
                                {{-- Start Product Variable Area --}}
                                <div class="product-details-variable">
                                    {{-- Product Variable Single Item --}}
                                    <div class="variable-single-item">
                                        <span>Color</span>
                                        <div class="product-variable-color">
                                            <label for="modal-product-color-red">
                                                <input name="modal-product-color" id="modal-product-color-red"
                                                    class="color-select" type="radio" checked>
                                                <span class="product-color-red"></span>
                                            </label>
                                            <label for="modal-product-color-tomato">
                                                <input name="modal-product-color" id="modal-product-color-tomato"
                                                    class="color-select" type="radio">
                                                <span class="product-color-tomato"></span>
                                            </label>
                                            <label for="modal-product-color-green">
                                                <input name="modal-product-color" id="modal-product-color-green"
                                                    class="color-select" type="radio">
                                                <span class="product-color-green"></span>
                                            </label>
                                            <label for="modal-product-color-light-green">
                                                <input name="modal-product-color" id="modal-product-color-light-green"
                                                    class="color-select" type="radio">
                                                <span class="product-color-light-green"></span>
                                            </label>
                                            <label for="modal-product-color-blue">
                                                <input name="modal-product-color" id="modal-product-color-blue"
                                                    class="color-select" type="radio">
                                                <span class="product-color-blue"></span>
                                            </label>
                                            <label for="modal-product-color-light-blue">
                                                <input name="modal-product-color" id="modal-product-color-light-blue"
                                                    class="color-select" type="radio">
                                                <span class="product-color-light-blue"></span>
                                            </label>
                                        </div>
                                    </div>
                                    {{-- Product Variable Single Item --}}
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="variable-single-item ">
                                            <span>Quantity</span>
                                            <div class="product-variable-quantity">
                                                <input min="1" max="100" value="1" type="number">
                                            </div>
                                        </div>

                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div> {{-- End Product Variable Area --}}
                                <div class="modal-product-about-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste
                                        laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam
                                        in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel
                                        recusandae</p>
                                </div>
                                {{-- Start  Product Details Social Area --}}
                                <div class="modal-product-details-social">
                                    <span class="title">SHARE THIS PRODUCT</span>
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>

                                </div> {{-- End  Product Details Social Area --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
