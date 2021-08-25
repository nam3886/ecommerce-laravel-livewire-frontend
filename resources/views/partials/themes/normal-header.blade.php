<div class="main-menu menu-color--black menu-hover-color--golden">
    <nav>
        @include('partials.header.sub-menu',[
        'menus' => $menus,
        'isNested' => false,
        'parent' => 'root',
        ])
    </nav>
</div>
