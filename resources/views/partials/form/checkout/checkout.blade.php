<form class="row">
    <div class="col">
        @if ($cart->get('discount'))
            <div class="cart_subtotal">
                <p>Price total</p>
                <p class="cart_amount">
                    <x-data.price :value="$cart->get('total_price')" />
                </p>
            </div>

            <div class="cart_subtotal">
                <p>Discount</p>
                <p class="cart_amount">
                    -
                    <x-data.price :value="$cart->get('discount')" />
                </p>
            </div>
        @endif

        <div class="cart_subtotal">
            <p>Subtotal</p>
            <p class="cart_amount">
                <x-data.price :value="$cart->get('sub_total')" />
            </p>
        </div>

        @if ($cart->get('tax'))
            <div class="cart_subtotal">
                <p>Tax</p>
                <p class="cart_amount">
                    <x-data.price :value="$cart->get('tax')" />
                </p>
            </div>
        @endif

        <div class="cart_subtotal">
            <p>Shipping</p>
            <p class="cart_amount">
                <x-data.price :value="$shippingFee" />
            </p>
        </div>

        <div class="cart_subtotal">
            <p>Total</p>
            <p class="cart_amount">
                <x-data.price :value="$cart->get('grand_total') + $shippingFee" />
            </p>
        </div>

        <div class="order_button text-right">
            <x-inputs.button-spinner :disabled="$cart->isEmpty()" type="submit" form="paymentForm" id="complete-order"
                class="btn btn-md btn-black-default-hover">
                {{ __('Proceed to Checkout') }}
            </x-inputs.button-spinner>
        </div>
    </div>
</form>
