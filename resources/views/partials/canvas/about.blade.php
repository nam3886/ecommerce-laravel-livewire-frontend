<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    {{-- Start Offcanvas Header --}}
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> {{-- End Offcanvas Header --}}
    {{-- Start Offcanvas Mobile Menu Wrapper --}}
    {{-- Start Mobile contact Info --}}
    <div class="mobile-contact-info">
        <x-display.logo style="filter: invert(1) contrast(2);" />

        <address class="address">
            <x-display.address />
            <x-display.phone />
            <x-display.email />
        </address>

        <x-display.social-link class="social-link" />

        <x-display.user-link />
    </div>
    {{-- End Mobile contact Info --}}
</div>
