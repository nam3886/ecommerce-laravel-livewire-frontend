@props(['order', 'value'])
<money {{ $attributes }}>
{{ \App\Helpers\Currency::autoFormatOrderCurrency($value, $order) }}
</money>
