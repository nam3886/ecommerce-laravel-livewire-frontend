@props(['value'])

<span>
    {{ Str::limit($value, 25) }}
</span>
