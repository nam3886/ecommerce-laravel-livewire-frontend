<div>
    <x-partials.breadcrumb :title="__('wish list')" />

    <div class="wishlist-section">
        {{-- Start Cart Table --}}
        <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0" wire:ignore.self>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    {{-- Start Wishlist Table Head --}}
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_stock">Stock Status</th>
                                            <th class="product_addcart">Add To Cart</th>
                                        </tr>
                                    </thead>
                                    {{-- End Cart Table Head --}}
                                    <tbody>

                                        @foreach ($wishlist->content as $item)
                                            <tr>
                                                <td class="product_remove">
                                                    <button wire:click='remove("{{ $item->rowId }}")'
                                                        wire:loading.attr='disabled' type="button">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                                <td class="product_thumb">

                                                    <x-data.link :value="$item->options->slug" class="img-link">
                                                        <x-images.lazy alt="cart-img"
                                                            :src="$item->options->image ?? null" />
                                                    </x-data.link>

                                                </td>
                                                <td class="product_name">
                                                    <x-data.link :value="$item->options->slug">
                                                        {{ $item->name }}
                                                    </x-data.link>
                                                </td>
                                                <td class="product-price">
                                                    <x-data.price :value="$item->price" />
                                                </td>
                                                @if ($item->model->quantity > 1)
                                                    <td class="product_stock">In Stock</td>
                                                @else
                                                    <td class="product_stock">Out of Stock</td>
                                                @endif
                                                <td class="product_addcart">

                                                    <livewire:actions.wish-list-to-cart-component :key="$item->rowId"
                                                        :item="$item"
                                                        :countVariants="$item->model->variants()->count()" />

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
    </div>
</div>

@section('title', 'Wish List')
