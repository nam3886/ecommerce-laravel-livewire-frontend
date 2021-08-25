@props(['value'])

<ul {{ $attributes }}>
    @for ($i = 1; $i <= 5; $i++)
        <li class="{{ $i > $value ? 'empty' : 'fill' }}"><i class="ion-android-star"></i></li>
    @endfor
</ul>
