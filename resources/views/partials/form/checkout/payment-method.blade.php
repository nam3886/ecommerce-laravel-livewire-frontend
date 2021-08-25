<form x-data="checkout()" x-init="$watch('payment',paymentChanged)" @submit.prevent="process"
    @stripe-ready.document="initStripe" id="paymentForm">
    <div class="payment_method">
        <x-inputs.group model="user.payment_id">
            <div class="payment-item">
                @foreach ($payments as $payment)
                    <div class="panel-default">
                        <div class="checkbox-default">
                            <input id="payment{{ $payment->id }}" value='{{ $payment->id }}' x-model="payment"
                                type="radio" name="payment">
                            <label for="payment{{ $payment->id }}" class="mw-100">
                                <i class="{{ $payment->icon }}" aria-hidden="true"></i>
                                &nbsp;{{ $payment->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-inputs.group>

        @foreach ($payments as $payment)
            <div wire:ignore.self :class="{'show':payment=='{{ $payment->id }}'}" class="collapse">
                <div class="card-body1">
                    <p>{{ $payment->description }}</p>
                </div>
            </div>
        @endforeach

        <div wire:ignore wire:key="stripe_card" id="stripe_card" class="col-12 d-none">
            <x-inputs.group :model="null" class="mb-0 mt-4">
                <x-slot name='label'>
                    {{ __('Credit or debit card') }} <span class='required'>*</span>
                </x-slot>
                <div>
                    <div id="card-element"></div>
                    <div id="card-errors" role='alert'></div>
                </div>
            </x-inputs.group>
        </div>
    </div>
</form>

@push('scripts')
    <script src="https://js.stripe.com/v3/" async onload="stripeReadyHandler()"></script>
    <script>
        function stripeReadyHandler() {
            document.dispatchEvent(new CustomEvent("stripe-ready"));
        }

        function checkout() {
            return {
                stripe: null,
                payment: null,
                elements: null,
                card: null,
                initStripe() {
                    const style = {
                        base: {
                            color: '#777',
                            lineHeight: '18px',
                            fontSize: 'inherit',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    };
                    this.stripe = Stripe('{{ config('settings.stripe_key') }}');
                    this.elements = this.stripe.elements();
                    this.card = this.elements.create('card', {
                        style: style,
                        hidePostalCode: true
                    });
                    this.card.mount('#card-element');
                    // Handle real-time validation errors from the card Element.
                    this.card.addEventListener('change', function(event) {
                        if (event.error) {
                            $('#card-errors').text(event.error.message);
                        } else {
                            $('#card-errors').text('');
                            $('#complete-order').prop('disabled', false);
                        }
                    });
                },
                process() {
                    if (this.payment != 1) {
                        return this.submitCheckout();
                    }

                    $('#complete-order').prop('disabled', true);

                    this.stripe.createToken(this.card, {
                        address_country: 'VN'
                    }).then((result) => {
                        if (result.error) {
                            $('#card-errors').text(result.error.message);
                            $('#complete-order').prop('disabled', true);
                        } else {
                            this.submitCheckout(result.token.id);
                        }
                    });
                },
                submitCheckout(token = null) {
                    @this.checkout(this.payment, token);
                },
                paymentChanged(value) {
                    const stripe = document.querySelector('#stripe_card');
                    if (value != 1) {
                        stripe.classList.add('d-none');
                        $('#complete-order').prop('disabled', false);
                    } else {
                        stripe.classList.remove('d-none');
                    }
                },
            };
        }
    </script>
@endpush

@push('styles')
    <style>
        .StripeElement {
            background-color: white;
            padding: 16px 16px;
            border: 1px solid #ededed;
            border-radius: 3px;
            color: #777;
        }

        .StripeElement--focus {
            /* box-shadow: 0 1px 3px 0 #cfd7df; */
            border-color: #b19361;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: #fa755a;
        }

    </style>
@endpush
