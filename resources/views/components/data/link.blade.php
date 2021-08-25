@props(['value' => null, 'route' => 'product_detail'])

<a href="{{ route($route, $value) }}" {{ $attributes }}>
    {{ $slot }}
</a>
