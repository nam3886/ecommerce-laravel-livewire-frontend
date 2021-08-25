<div>
    <x-partials.breadcrumb :title="__('order history')" />

    <div class="cart-section">
        {{-- Start Cart Table --}}
        <div wire:ignore.self class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    {{-- Start Cart Table Head --}}
                                    <thead x-data x-init="$wire.getOrderStatus()">
                                        <tr>
                                            <th class="product_remove">Sku</th>
                                            <th class="product_name">Product</th>
                                            <th class="product_name">Attributes</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead>
                                    {{-- End Cart Table Head --}}
                                    <tbody>

                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="product_name">
                                                    <x-data.link :value="$item->slug">
                                                        {{ $item->pivot->sku }}
                                                    </x-data.link>
                                                </td>
                                                <td class="product_name">
                                                    <x-data.link :value="$item->slug">
                                                        {{ $item->name }}
                                                    </x-data.link>
                                                </td>
                                                <td class="product_name">
                                                    {{ $item->pivot->variant->name }}
                                                </td>
                                                <td class="product-price">
                                                    <x-data.price-order :order="$order" :value="$item->pivot->price" />
                                                </td>
                                                <td class="product-price">
                                                    {{ $item->pivot->quantity }}
                                                </td>
                                                <td class="product_total">
                                                    <x-data.price-order :order="$order"
                                                        :value="$item->pivot->price*$item->pivot->quantity" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Cart Table --}}

        {{-- Start Coupon Start --}}
        <div class="coupon_area">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <div wire:ignore.self class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                            <h3>Order Status & Delivery Address</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal text-capitalize">
                                    <p>Payment</p>
                                    <p class="cart_amount">
                                        {{ $order->payment->name }}
                                    </p>
                                </div>
                                <div class="cart_subtotal text-capitalize">
                                    <p>Paid</p>
                                    <p class="cart_amount">
                                        @if ($order->is_paid)
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Paid
                                        @else
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Unpaid
                                        @endif
                                    </p>
                                </div>
                                <div class="cart_subtotal text-capitalize">
                                    <p>Status</p>
                                    <p class="cart_amount text-right" style="max-width: 60%">
                                        {{ $order->status }}
                                    </p>
                                </div>
                                <div class="cart_subtotal text-capitalize">
                                    <p>Address</p>
                                    <p class="cart_amount text-right" style="max-width: 60%">
                                        {{ $order->address }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div wire:ignore.self class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>Order Totals</h3>
                            <div class="coupon_inner">

                                @if ($order->discount)
                                    <div class="cart_subtotal">
                                        <p>Price total</p>
                                        <p class="cart_amount">
                                            <x-data.price-order :order="$order" :value="$order->total_price" />
                                        </p>
                                    </div>

                                    <div class="cart_subtotal">
                                        <p>Discount</p>
                                        <p class="cart_amount">
                                            -
                                            <x-data.price-order :order="$order" :value="$order->discount" />
                                        </p>
                                    </div>
                                @endif

                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p class="cart_amount">
                                        <x-data.price-order :order="$order" :value="$order->sub_total" />
                                    </p>
                                </div>

                                @if ($order->tax)
                                    <div class="cart_subtotal">
                                        <p>Tax</p>
                                        <p class="cart_amount">
                                            <x-data.price-order :order="$order" :value="$order->tax" />
                                        </p>
                                    </div>
                                @endif

                                <div class="cart_subtotal">
                                    <p>Shipping</p>
                                    <p class="cart_amount">
                                        @empty($order->delivery_fee)
                                            <span>FREE</span>
                                        @else
                                            <x-data.price-order :order="$order" :value="$order->delivery_fee" />
                                        @endempty
                                    </p>
                                </div>

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount">
                                        <x-data.price-order :order="$order" :value="$order->order_total" />
                                    </p>
                                </div>

                                <div class="checkout_btn">
                                    <x-inputs.button-spinner class="btn btn-md btn-golden" type="button"
                                        wire:click="exportPDF">
                                        Print invoice
                                    </x-inputs.button-spinner>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Coupon Start --}}
    </div>
</div>

@section('title', 'Order History')
