<div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                {{-- Start Mobile Left Side --}}
                <div class="mobile-header-left">
                    <ul class="mobile-menu-logo">
                        <li>
                            <x-display.logo />
                        </li>
                    </ul>
                </div>
                {{-- End Mobile Left Side --}}

                {{-- Start Mobile Right Side --}}
                <div class="mobile-right-side">
                    <ul class="header-action-link action-color--black action-hover-color--golden">
                        <li>
                            @include('partials.items.button-search')
                        </li>
                        <li>
                            <livewire:partials.count-wish-list-component key='mobile' />
                        </li>
                        <li>
                            <livewire:partials.count-cart-component key='mobile' />
                        </li>
                        <li>
                            <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- End Mobile Right Side --}}
            </div>
        </div>
    </div>
</div>
