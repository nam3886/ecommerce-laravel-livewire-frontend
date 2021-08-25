<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        * {
            font-family: Verdana, DejaVu Sans, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="{{ public_path('images/logo/logo-1024.png') }}" alt="" width="150" />
            </td>
            <td align="right">
                <h3>{{ config('settings.site_name') }}</h3>
                <pre>
                    {{ config('settings.site_name') }}
                    {{ config('settings.default_address') }}
                    {{ config('settings.default_email_address') }}
                    {{ config('settings.default_phone') }}
                </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>From:</strong> {{ config('settings.site_name') }}</td>
            <td colspan="2" align="right"><strong>To:</strong> {{ $order->name }}</td>
        </tr>
        <tr>
            <td colspan="3" align="right"><strong>Phone:</strong> {{ $order->phone }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td align="right"><strong>Delivery address:</strong>
                {{ $order->address }}
            </td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <x-data.link :value="$item->slug">
                            {{ $item->name }}
                        </x-data.link>
                    </td>
                    <td align="right">{{ $item->pivot->quantity }}</td>
                    <td align="right">
                        <x-data.price-order :order="$order" :value="$item->pivot->price" />
                    </td>
                    <td align="right">
                        <x-data.price-order :order="$order" :value="$item->pivot->price * $item->pivot->quantity" />
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            @if ($order->discount)
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Price total</td>
                    <td align="right">
                        -
                        <x-data.price-order :order="$order" :value="$order->discount" />
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="3"></td>
                <td align="right">Subtotal</td>
                <td align="right">
                    <x-data.price-order :order="$order" :value="$order->sub_total" />
                </td>
            </tr>
            @if ($order->tax)
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Tax</td>
                    <td align="right">
                        <x-data.price-order :order="$order" :value="$order->tax" />
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="3"></td>
                <td align="right">Shipping</td>
                @empty($order->delivery_fee)
                    <td align="right">FREE</td>
                @else
                    <td align="right">
                        <x-data.price-order :order="$order" :value="$order->delivery_fee" />
                    </td>
                @endempty
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total</td>
                <td align="right" class="gray">
                    <x-data.price-order :order="$order" :value="$order->order_total" />
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                @if ($order->is_paid)
                    <td align="right" style='color: #34c38f'>
                        Paid
                    </td>
                @else
                    <td align="right" style='color: #f46a6a'>
                        Unpaid
                    </td>
                @endif
            </tr>
            @if ($order->note)
                <tr>
                    <th scope="row">Notes</th>
                    <td colspan="5">{{ $order->note }}</td>
                </tr>
            @endif
        </tfoot>
    </table>

</body>

</html>
