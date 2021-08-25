@props([
    'negative' => false,
    'value',
])
<money {{ $attributes }}>
@if ($negative)-@endif
@unless(is_numeric($value))
{{ $value }}
@else
{{ \App\Helpers\Currency::autoFormatCurrency($value) }}
@endunless
</money>
