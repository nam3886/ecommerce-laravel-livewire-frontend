@component('mail::message')
# Order Success

Thanks for the purchase

Here is your receipt

<table class='table'>
<thead>
<tr>
<th>Product Name</th>
<th>Quantity</th>
<th>Price</th>
</tr>
</thead>
<tbody>

@foreach ($order->items as $item)
<tr>
<td scope='row'>{{ $item->name }}</td>
<td>{{ $item->pivot->quantity }}</td>
<td>
<x-data.price-order :value="$item->pivot->price" :order="$order" />
</td>
</tr>
@endforeach

</tbody>
</table>
<br>
Total:
<x-data.price-order :value="$order->order_total" :order="$order" />

@component('mail::button', ['url' => config('app.url')])
Continue to shopping
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
