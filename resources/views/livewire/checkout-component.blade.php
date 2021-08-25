<div>
    <x-partials.breadcrumb :title="__('checkout')" />
    <div class="checkout-section">
        <div class="container">
            <div wire:ignore.self data-aos="fade-up" data-aos-delay="400" class="row checkout_form">
                <div class="accordion row" id="accordionPanelsStayOpenExample">
                    <div class="col-12 mb-1">
                        <div class="accordion-item checkout-list">
                            <h3 class="accordion-header" id="headingStepOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseStepOne" aria-expanded="true"
                                    aria-controls="collapseStepOne">
                                    {{ __('Billing Details') }}&nbsp;
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </h3>
                            <div wire:ignore.self id="collapseStepOne" aria-labelledby="headingStepOne"
                                class="checkout-item accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @include('partials.form.checkout.address')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1">
                        <div class="accordion-item checkout-list">
                            <h3 class="accordion-header" id="headingStepTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseStepTwo" aria-expanded="false"
                                    aria-controls="collapseStepTwo">
                                    {{ __('Your order') }}&nbsp;
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </h3>
                            <div wire:ignore.self id="collapseStepTwo" aria-labelledby="headingStepTwo"
                                class="checkout-item accordion-collapse collapse show">
                                <div class="accordion-body invoice">
                                    @include('partials.form.checkout.invoice')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1">
                        <div class="accordion-item checkout-list">
                            <h3 class="accordion-header" id="headingStepFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseStepFour" aria-expanded="false"
                                    aria-controls="collapseStepFour">
                                    {{ __('Voucher') }}&nbsp;
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </h3>
                            <div wire:ignore.self id="collapseStepFour" aria-labelledby="headingStepFour"
                                class="checkout-item accordion-collapse collapse">
                                <div class="accordion-body">
                                    @include('partials.form.checkout.voucher')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-1">
                        <div class="accordion-item checkout-list">
                            <h3 class="accordion-header" id="headingStepFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseStepFive" aria-expanded="false"
                                    aria-controls="collapseStepFive">
                                    {{ __('Payment Method') }}&nbsp;
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </h3>
                            <div wire:ignore.self id="collapseStepFive" aria-labelledby="headingStepFive"
                                class="checkout-item accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @include('partials.form.checkout.payment-method',[
                                    'payments' => $payments,
                                    'cart' => $cart
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="accordion-item checkout-list">
                            <h3 class="accordion-header" id="headingStepSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseStepSix" aria-expanded="false"
                                    aria-controls="collapseStepSix">
                                    {{ __('Process Checkout') }}&nbsp;
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </h3>
                            <div wire:ignore.self id="collapseStepSix" aria-labelledby="headingStepSix"
                                class="checkout-item accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @include('partials.form.checkout.checkout', $cart)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer.modal-address')
    @include('partials.footer.modal-delivery', $deliveries)
</div>

@section('title', 'Checkout')
