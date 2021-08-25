<div class="order_table table-responsive">
    <table>
        <thead>
            <tr>
                <th>Products</th>
                <th></th>
                <th></th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->get('content') as $cartItem)
                <tr>
                    <td>
                        <x-data.link :value="$cartItem->options->slug">
                            <x-images.lazy :src="$cartItem->options->image ?? null" alt="cart-img"
                                style="max-width:50px" />
                        </x-data.link>
                    </td>
                    <td>
                        <x-data.link :value="$cartItem->options->slug">
                            {{ $cartItem->name }}
                        </x-data.link>
                    </td>
                    <td>{{ $cartItem->options->variant }}</td>
                    <td>
                        <x-data.price :value="$cartItem->price" />
                    </td>
                    <td>{{ $cartItem->qty }}</td>
                    <td>
                        <x-data.price :value="$cartItem->price*$cartItem->qty" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="delivery row">
    <div class="col-lg-4 delivery-item">
        <x-inputs.group model='user.note' for='order_note' class="delivery-note">
            <x-slot name='label'>{{ __('Order Notes') }}</x-slot>
            <input wire:model.defer='user.note' id="order_note"
                placeholder="{{ __('Notes about your order, e.g. special notes for delivery.') }}" type="text" />
        </x-inputs.group>
    </div>
    <div class="col-lg-8 delivery-item">
        <div class="row align-items-center">
            <div class="col-lg-3 d-flex justify-content-between my-1 my-lg-0">
                <span style="color: #00bfa5;">{{ __('Delivery method') }}:</span>
                <span class="d-lg-none text-right">Giao hàng nhanh</span>
            </div>
            <div class="col-lg-5 my-1 my-lg-0">
                <div class="d-none d-lg-block text-danger">Giao hàng nhanh</div>
                @if ($expectTime)
                    <div>{{ __('received on') }} {{ $expectTime }}</div>
                @else
                    <div style="color: #ff424f;">
                        {{ __('Please select your desired delivery time') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-4 col-12 d-flex justify-content-between text-uppercase my-1 my-lg-0">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelivery">{{ __('change') }}</a>
                <x-data.price :value="$shippingFee" style="font-weight: 600" />
            </div>
        </div>
    </div>
</div>
