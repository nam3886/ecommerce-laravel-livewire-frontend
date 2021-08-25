<ul @if ($isNested) class="{{ $isMobile ? 'mobile-' : '' }}sub-menu" @endif>
    @foreach ($menus[$parent] as $menu)
        <li>
            @if ($menu->children->count())
                @if ($menu->category)
                    <a href="{{ route('shop', ['category' => $menu->category->slug]) }}">
                        {{ $menu->category->name }}
                        @unless($isMobile)<i class="fa fa-angle-down"></i>@endunless
                    </a>
                    @include('partials.header.sub-menu',[
                    'menus' => $menus,
                    'isNested' => true,
                    'parent' => $menu->id,
                    ])
                @else
                    <a href="{{ url($menu->slug) }}">
                        {{ $menu->name }}
                        @unless($isMobile)<i class="fa fa-angle-down"></i>@endunless
                    </a>
                    @if ($menu->children)
                        @include('partials.header.sub-menu',[
                        'menus' => $menus,
                        'isNested' => true,
                        'parent' => $menu->id,
                        ])
                    @endif
                @endif
            @else
                @if ($menu->category)
                    <a
                        href="{{ route('shop', ['category' => $menu->category->slug]) }}">{{ $menu->category->name }}</a>
                @else
                    <a href="{{ url($menu->slug) }}">{{ $menu->name }}</a>
                @endif
            @endif
        </li>
    @endforeach

    @unless($isNested)
        <li class="has-dropdown">
            @auth
                <a href="{{ route('my_account') }}">My Account</a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Login / Register</a>
            @endguest
        </li>
    @endunless

</ul>
