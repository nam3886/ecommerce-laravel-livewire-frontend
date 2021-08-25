<div>
    <x-partials.breadcrumb :title="__('view cart')" />

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
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product_name">Options</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead>
                                    {{-- End Cart Table Head --}}
                                    <tbody>

                                        @foreach ($carts->content as $cart)
                                            <tr>
                                                <td class="product_remove">

                                                    <button wire:click='remove("{{ $cart->rowId }}")'
                                                        wire:loading.attr='disabled' type="button">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>

                                                </td>
                                                <td class="product_thumb">
                                                    <x-data.link :value="$cart->options->slug" class="img-link">
                                                        <x-images.lazy alt="cart-img"
                                                            :src="$cart->options->image ?? null" />
                                                    </x-data.link>
                                                </td>
                                                <td class="product_name">
                                                    <x-data.link :value="$cart->options->slug">
                                                        {{ $cart->name }}
                                                    </x-data.link>
                                                </td>
                                                <td class="product_name">
                                                    {{ $cart->options->variant }}
                                                </td>
                                                <td class="product-price">
                                                    <x-data.price :value="$cart->price" />
                                                </td>
                                                <td class="product_quantity">

                                                    <livewire:actions.change-quantity-component
                                                        :key="$cart->rowId.'changePageCart'" :sku="$cart->options->sku"
                                                        :cartId="$cart->rowId" :quantity="$cart->qty" />

                                                </td>
                                                <td class="product_total">
                                                    <x-data.price :value="$cart->price*$cart->qty" />
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <x-inputs.button-spinner wire:click='$refresh' type="button"
                                    class="btn btn-md btn-golden">
                                    update cart
                                </x-inputs.button-spinner>
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
                            <h3>Coupon</h3>
                            <div class="coupon_inner">
                                <p>Enter your coupon code if you have one.</p>

                                <livewire:checkout.voucher-component key='checkout'
                                    :class="['button'=>'btn btn-md btn-golden','input'=>'mb-2']" />

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div wire:ignore.self class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">

                                @if ($carts->discount)
                                    <div class="cart_subtotal">
                                        <p>Price total</p>
                                        <p class="cart_amount">
                                            <x-data.price :value="$carts->total_price" />
                                        </p>
                                    </div>

                                    <div class="cart_subtotal">
                                        <p>Discount</p>
                                        <p class="cart_amount">
                                            -
                                            <x-data.price :value="$carts->discount" />
                                        </p>
                                    </div>
                                @endif

                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p class="cart_amount">
                                        <x-data.price :value="$carts->sub_total" />
                                    </p>
                                </div>

                                @if ($carts->tax)
                                    <div class="cart_subtotal">
                                        <p>Tax</p>
                                        <p class="cart_amount">
                                            <x-data.price :value="$carts->tax" />
                                        </p>
                                    </div>
                                @endif

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount">
                                        <x-data.price :value="$carts->grand_total" />
                                    </p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="{{ route('checkout') }}" class="btn btn-md btn-golden">
                                        Proceed to Checkout
                                    </a>
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

@section('title', 'Cart')
