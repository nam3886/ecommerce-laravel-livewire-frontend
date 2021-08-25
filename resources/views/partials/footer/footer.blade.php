<footer class="footer-section footer-bg {{ Request::is('home') ?: 'section-top-gap-100' }}">
    <div class="footer-wrapper">
        {{-- Start Footer Top --}}
        <div class="footer-top">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-lg-3 col-sm-6 mb-6">
                        {{-- Start Footer Single Item --}}
                        <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                            data-aos-delay="0">
                            <h5 class="title">INFORMATION</h5>
                            <ul class="footer-nav">
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="{{ route('contact_us') }}">Contact</a></li>
                                <li><a href="#">Returns</a></li>
                            </ul>
                        </div>
                        {{-- End Footer Single Item --}}
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        {{-- Start Footer Single Item --}}
                        <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                            data-aos-delay="200">
                            <h5 class="title">MY ACCOUNT</h5>
                            <ul class="footer-nav">
                                <li><a href="{{ route('my_account') }}">My account</a></li>
                                <li><a href="{{ route('wish_list') }}">Wishlist</a></li>
                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li><a href="faq.html">Frequently Questions</a></li>
                                <li><a href="{{ route('my_account', ['action' => 'order']) }}">
                                        Order History</a></li>
                            </ul>
                        </div>
                        {{-- End Footer Single Item --}}
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        {{-- Start Footer Single Item --}}
                        <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                            data-aos-delay="400">
                            <h5 class="title">CATEGORIES</h5>
                            <ul class="footer-nav">
                                <li><a href="#">Decorative</a></li>
                                <li><a href="#">Kitchen utensils</a></li>
                                <li><a href="#">Chair & Bar stools</a></li>
                                <li><a href="#">Sofas and Armchairs</a></li>
                                <li><a href="#">Interior lighting</a></li>
                            </ul>
                        </div>
                        {{-- End Footer Single Item --}}
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        {{-- Start Footer Single Item --}}
                        <div class="footer-widget-single-item footer-widget-color--golden" data-aos="fade-up"
                            data-aos-delay="600">
                            <h5 class="title">ABOUT US</h5>
                            <div class="footer-about">
                                <p>We are a team of designers and developers that create high quality Magento,
                                    Prestashop, Opencart.</p>

                                <address class="address">
                                    <x-display.address /><br>
                                    <x-display.email />
                                </address>
                            </div>
                        </div>
                        {{-- End Footer Single Item --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Footer Top --}}

        {{-- Start Footer Center --}}
        <div class="footer-center">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-6">
                        <div class="footer-social" data-aos="fade-up" data-aos-delay="0">
                            <h4 class="title">FOLLOW US</h4>
                            <x-display.social-link class="footer-social-link" />
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-6 mb-6">
                        <div class="footer-newsletter" data-aos="fade-up" data-aos-delay="200">
                            <h4 class="title">DON'T MISS OUT ON THE LATEST</h4>
                            <div class="form-newsletter">
                                <livewire:partials.subscribe-component />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Start Footer Center --}}

        {{-- Start Footer Bottom --}}
        <div class="footer-bottom">
            <div class="container">
                <div
                    class="row justify-content-between align-items-center align-items-center flex-column flex-md-row mb-n6">
                    <div class="col-auto mb-6">
                        <div class="footer-copyright">
                            {!! config('settings.footer_copyright_text') !!}
                        </div>
                    </div>
                    <div class="col-auto mb-6">
                        <div class="footer-payment">
                            <div class="image">
                                <img src="{{ asset('images/company-logo/payment.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Start Footer Bottom --}}
    </div>
</footer>
