<div>
    <x-partials.breadcrumb :title="__('empty cart')" />

    <div class="empty-cart-section section-fluid">
        <div class="emptycart-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                        <div class="emptycart-content text-center">
                            <div class="image">
                                <x-images.lazy class="img-fluid" :src="asset('images/emprt-cart/empty-cart.png')"
                                    alt="empty-cart" />
                            </div>
                            <h4 class="title">Your Cart is Empty</h4>
                            <h6 class="sub-title">Sorry Mate... No item Found inside your cart!</h6>
                            <a href="{{ route('shop') }}" class="btn btn-lg btn-golden">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'Cart Empty')
