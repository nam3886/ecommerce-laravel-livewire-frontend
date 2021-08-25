<header class="header-section d-none d-xl-block">
    <div class="header-wrapper">
        <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        {{-- Start Header Logo --}}
                        <div class="header-logo">
                            <x-display.logo />
                        </div>
                        {{-- End Header Logo --}}

                        {{-- Start Header Main Menu --}}
                        <livewire:partials.header-component />
                        {{-- End Header Main Menu Start --}}

                        {{-- Start Header Action Link --}}
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                            <li>
                                <livewire:partials.count-wish-list-component key='normal' />
                            </li>
                            <li>
                                <livewire:partials.count-cart-component key='normal' />
                            </li>
                            <li>
                                @include('partials.items.button-search')
                            </li>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        {{-- End Header Action Link --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
