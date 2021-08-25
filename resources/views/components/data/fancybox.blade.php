@props(['src', 'images' => is_string($src) ? $src : $src->get('sources'), 'noImage' => asset('/svg/no-image-placeholder.svg')])

<a @empty($src) data-srcset="{{ $noImage }}" href="{{ $noImage }}" @else data-srcset="{{ $images }}"
href="{{ $images }}" @endempty {{ $attributes }}>

{{ $slot }}

</a>
