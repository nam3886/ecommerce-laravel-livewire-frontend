<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    {{-- Start Offcanvas Header --}}
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div>
    {{-- End Offcanvas Header --}}
    {{-- Start Offcanvas Mobile Menu Wrapper --}}
    <div class="offcanvas-mobile-menu-wrapper">
        {{-- Start Mobile Menu --}}
        <livewire:partials.header-component :isMobile="true" />
        {{-- End Mobile Menu --}}

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

    </div> {{-- End Offcanvas Mobile Menu Wrapper --}}
</div>

@push('scripts')
    <script>
        (function() {
            const offCanvasNav = document.querySelector('.offcanvas-menu');
            const subMenus = offCanvasNav.querySelectorAll('.mobile-sub-menu');
            if (!subMenus) return;

            subMenus.forEach(subMenu => {
                const parent = subMenu.parentNode;
                const menuExpand = document.createElement('DIV');
                menuExpand.classList.add('offcanvas-menu-expand');
                parent.prepend(menuExpand);
                parent.addEventListener('click', function(event) {
                    // if anchor clicked => run default
                    if (event.target.tagName === 'A') return;

                    event.stopPropagation();
                    const isSelected = parent.classList.contains('selected');
                    parent.classList.toggle('selected', !isSelected);

                    if (isSelected) { // go to un-active
                        parent.querySelectorAll('.mobile-sub-menu')
                            .forEach(item => item.style.display = 'none');

                        parent.querySelectorAll('li.selected')
                            .forEach(item => item.classList.remove('selected'));
                    } else {
                        subMenu.style.display = 'block';
                    }
                });
            });

        })();
    </script>
@endpush
