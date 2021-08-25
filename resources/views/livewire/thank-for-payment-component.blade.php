<div>
    <x-partials.breadcrumb :title="__('thank for payment')" />

    <div class="empty-cart-section section-fluid">
        <div class="emptycart-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                        <div class="emptycart-content text-center">
                            <div class="image">
                                <x-images.lazy class="img-fluid" :src="asset('images/payment-success.png')"
                                    alt="payment-success" style="max-width: 25%;" />
                            </div>
                            <h4 class="title">&#8727;Payment Received&#8727;</h4>
                            <h6 class="sub-title">Thank you for your payment, you will receive a confirmation email
                                shortly</h6>
                            <a href="{{ route('shop') }}" class="btn btn-lg btn-golden mx-1">
                                Continue Shopping
                            </a>
                            <a href="{{ route('order_history', $orderNumber) }}" class="btn btn-lg btn-golden mx-1">
                                View Recent Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'Thank for payment')
