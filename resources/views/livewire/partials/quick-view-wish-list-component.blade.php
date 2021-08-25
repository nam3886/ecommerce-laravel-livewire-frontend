<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section" wire:ignore.self>
    {{-- Start Offcanvas Header --}}
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div>
    {{-- ENd Offcanvas Header --}}

    {{-- Start Offcanvas Mobile Menu Wrapper --}}
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">

            @foreach ($wishlist->content as $item)
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">

                        <x-data.link class="offcanvas-wishlist-item-image-link" :value="$item->options->slug">
                            <x-images.lazy :src="$item->options->image ?? null" alt="cart-img"
                                class="offcanvas-wishlist-image" />
                        </x-data.link>

                        <div class="offcanvas-wishlist-item-content">

                            <x-data.link class="offcanvas-wishlist-item-link" :value="$item->options->slug">
                                <x-data.name :value="$item->name" />
                            </x-data.link>

                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">
                                    {{ $item->qty }} x
                                </span>
                                <span class="offcanvas-wishlist-item-details-price">
                                    <x-data.price :value="$item->price" />
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">

                        <button wire:click='remove("{{ $item->rowId }}")' wire:loading.attr='disabled' type="button"
                            class="offcanvas-wishlist-item-delete">
                            <i class="fa fa-trash-o"></i>
                        </button>

                    </div>
                </li>
            @endforeach

        </ul>

        @if ($wishlist->count)
            <ul class="offcanvas-wishlist-action-button">
                <li>
                    <a href="{{ route('wish_list') }}" class="btn btn-block btn-golden">
                        View wishlist
                    </a>
                </li>
            </ul>
        @endif

    </div>
    {{-- End Offcanvas Mobile Menu Wrapper --}}

</div>
