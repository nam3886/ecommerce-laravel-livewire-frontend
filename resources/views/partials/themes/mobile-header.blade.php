<div class="mobile-menu-bottom">
    {{-- Start Mobile Menu Nav --}}
    <div class="offcanvas-menu">
        @include('partials.header.sub-menu',[
        'menus' => $menus,
        'isNested' => false,
        'isMobile' => true,
        'parent' => 'root',
        ])
    </div>
    {{-- End Mobile Menu Nav --}}
</div>
