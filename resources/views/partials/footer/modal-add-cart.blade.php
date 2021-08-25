<div wire:ignore.self id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog  modal-dialog-centered modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div x-data="modalAddCart()" @successful-add-cart.window="open" class="row mb-5">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="modal-add-cart-product-img">
                                        {{-- <template x-if='avatar'>
                                            <img class="img-fluid" :src="avatar" alt="img">
                                        </template> --}}
                                        <i class="fa fa-cart-plus" style="font-size: 5em;color: #b19361;"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="modal-add-cart-info">
                                        {{-- <i class="fa fa-check-square"></i> --}}
                                        Added to cart successfully!
                                    </div>
                                    <div class="modal-add-cart-product-cart-buttons">
                                        <a href="{{ route('cart') }}">View Cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 modal-border">
                            <ul class="modal-add-cart-product-shipping-info">
                                <li>
                                    <strong>
                                        <i class="icon-shopping-cart"></i>
                                        There Are
                                        <div class='d-inline' x-text='count'></div>
                                        Items In Your Cart.
                                    </strong>
                                </li>
                                <li> <strong>TOTAL PRICE: </strong> <span x-text="total"></span></li>
                                <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUE
                                        SHOPPING</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function modalAddCart() {
            return {
                avatar: '',
                count: 0,
                total: 0,
                open: function($event) {
                    this.avatar = $event.detail.avatar;
                    this.count = $event.detail.count;
                    this.total = $event.detail.total;
                    setTimeout(() => {
                        $('#modalAddcart').modal('show');
                    }, 1);
                }
            }
        }
    </script>
@endpush
