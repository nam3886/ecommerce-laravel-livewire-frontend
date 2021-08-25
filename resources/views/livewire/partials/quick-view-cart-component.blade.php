<div wire:ignore.self id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
  {{-- Start Offcanvas Header --}}
  <div class="offcanvas-header text-right">
    <button class="offcanvas-close"><i class="ion-android-close"></i></button>
  </div>
  {{-- End Offcanvas Header --}}

  {{-- Start  Offcanvas Addcart Wrapper --}}
  <div class="offcanvas-add-cart-wrapper">
    <h4 class="offcanvas-title">Shopping Cart</h4>
    <ul class="offcanvas-cart">

      @foreach ($carts->content as $cart)
        <li class="offcanvas-cart-item-single">
          <div class="offcanvas-cart-item-block">
            <x-data.link class="offcanvas-cart-item-image-link" :value="$cart->options->slug">
              <x-images.lazy :src="$cart->options->image ?? null" alt="cart-img" class="offcanvas-cart-image" />
            </x-data.link>
            <div class="offcanvas-cart-item-content">
              <x-data.link class="offcanvas-cart-item-link" :value="$cart->options->slug">
                <x-data.name :value="$cart->name" />
              </x-data.link>
              <div class="offcanvas-cart-item-details">
                <span class="offcanvas-cart-item-details-quantity">
                  {{ $cart->qty }} x
                </span>
                <span class="offcanvas-cart-item-details-price">
                  <x-data.price :value="$cart->price" />
                </span>
              </div>
              <div class="offcanvas-cart-item-details">
                <span class="offcanvas-cart-item-details-price">
                  Options: {{ Str::limit($cart->options->variant, 15) }}
                </span>
              </div>
              <div class="offcanvas-cart-item-details">
                <span class="offcanvas-cart-item-details-price">
                  SKU: {{ Str::limit($cart->options->sku, 15) }}
                </span>
              </div>
            </div>
          </div>
          <div class="offcanvas-cart-item-delete text-right">

            <button wire:click.prevent="remove('{{ $cart->rowId }}')" wire:loading.attr='disabled' type="button"
              class="offcanvas-cart-item-delete">
              <i class="fa fa-trash-o"></i>
            </button>

          </div>
        </li>
      @endforeach

    </ul>

    @if ($carts->content->count())
      <div class="offcanvas-cart-total-price">
        <span class="offcanvas-cart-total-price-text">Price total:</span>
        <span class="offcanvas-cart-total-price-value">
          <x-data.price :value="$carts->total_price" />
        </span>
      </div>
      <ul class="offcanvas-cart-action-button">
        <li><a href="{{ route('cart') }}" class="btn btn-block btn-golden">View Cart</a></li>
        <li><a href="{{ route('checkout') }}" class=" btn btn-block btn-golden mt-5">Checkout</a></li>
      </ul>
    @endif
  </div>
  {{-- End  Offcanvas Addcart Wrapper --}}
</div>
