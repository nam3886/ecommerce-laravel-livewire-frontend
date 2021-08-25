<div>
    <x-partials.breadcrumb :title='$search ? "Search: $search" : __("shop")' />

    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-3">
                    <div wire:ignore.self x-data="filter" x-init="init" data-aos="fade-up" data-aos-delay="0"
                        class="siderbar-section">
                        @include('partials.body.filters.category', $categories)
                        @include('partials.body.filters.price')
                        @include('partials.body.filters.brand', $brands)
                        @each('partials.body.filters.attribute', $attributes, 'attribute')
                        @include('partials.themes.product-tag', $tags)
                        {{-- Ad banner --}}
                        <div class="sidebar-single-widget" wire:ignore>
                            <div class="sidebar-content">
                                <a href="#" class="sidebar-banner img-hover-zoom">
                                    <x-images.lazy class="img-fluid" :src="asset('images/banner/black-friday-sale.jpg')"
                                        alt="ads" />
                                </a>
                            </div>
                        </div>
                        {{-- End Ad banner --}}
                    </div>
                </div>
                <div class="col-lg-9">
                    {{-- Start Shop Product Sorting Section --}}
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                {{-- Start Sort Wrapper Box --}}
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column"
                                    data-aos="fade-up" data-aos-delay="0" wire:ignore.self>
                                    {{-- Start Sort tab Button --}}
                                    <div class="sort-tablist d-flex align-items-center">
                                        <ul wire:ignore class="tablist nav sort-tab-btn">
                                            <li>
                                                <a class="nav-link active" data-bs-toggle="tab" href="#layout-3-grid">
                                                    <i class="fa fa-th" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-bs-toggle="tab" href="#layout-list">
                                                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        {{-- Start Page Amount --}}
                                        <div class="page-amount ml-2">
                                            <span>
                                                Showing
                                                {{ $products->links()->paginator->total() ? $products->links()->paginator->perPage() * ($products->links()->paginator->currentPage() - 1) + 1 : 0 }}–{{ $products->links()->paginator->hasMorePages() ? $products->links()->paginator->perPage() * $products->links()->paginator->currentPage() : $products->links()->paginator->total() }}
                                                of {{ $products->links()->paginator->total() }}
                                                results
                                            </span>
                                        </div>
                                        {{-- End Page Amount --}}
                                    </div>
                                    {{-- End Sort tab Button --}}

                                    {{-- Start Sort Select Option --}}
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sort By:</label>
                                        <form>
                                            <fieldset>
                                                <select class="form-select sort-product" wire:model='order' name="speed"
                                                    id="speed">
                                                    <option value="0">Sort by newness</option>
                                                    <option value="5">Sort by popularity</option>
                                                    <option value="1">Product Name: A to Z</option>
                                                    <option value="2">Product Name: Z to A</option>
                                                    <option value="3">Sort by price: low to high</option>
                                                    <option value="4">Sort by price: high to low</option>
                                                    {{-- <option>Sort by average rating</option> --}}
                                                </select>
                                            </fieldset>
                                        </form>
                                    </div>
                                    {{-- End Sort Select Option --}}

                                </div>
                                {{-- Start Sort Wrapper Box --}}
                            </div>
                        </div>
                    </div>
                    {{-- End Section Content --}}

                    {{-- Start Tab Wrapper --}}
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom" wire:loading.remove
                                        wire:target="gotoPage,previousPage,nextPage,assignNewFilters,order">
                                        {{-- Start Grid View Product --}}
                                        <div wire:ignore.self class="tab-pane active show sort-layout-single"
                                            id="layout-3-grid">
                                            <div class="row">

                                                @forelse ($products as $product)
                                                    <div class="col-xl-4 col-sm-6 col-12">
                                                        <x-products.single :unique="time()" :product="$product"
                                                            data-aos="fade-up" data-aos-delay="0" wire:ignore.self />
                                                    </div>
                                                @empty
                                                    <x-products.empty />
                                                @endforelse

                                            </div>
                                        </div>
                                        {{-- End Grid View Product --}}
                                        {{-- Start List View Product --}}
                                        <div wire:ignore.self class="tab-pane sort-layout-single" id="layout-list">
                                            <div class="row">

                                                @forelse ($products as $product)
                                                    <div class="col-12">
                                                        <x-products.single-list :unique="time()" :product="$product" />
                                                    </div>
                                                @empty
                                                    <x-products.empty />
                                                @endforelse

                                            </div>
                                        </div>
                                        {{-- End List View Product --}}
                                    </div>
                                    <div class='shop-loading'
                                        wire:target="gotoPage,previousPage,nextPage,assignNewFilters,order"
                                        wire:loading>
                                        <x-inputs.spinner-2 />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Tab Wrapper --}}

                    <div wire:loading.remove wire:target="gotoPage,previousPage,nextPage,assignNewFilters,order">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var eventVisibleProducts = new CustomEvent("visible-products");
        document.addEventListener("visible-products", function() {
            document.getElementById('breadcrumb-list')?.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
            });
        });

        function filter() {
            return {
                availableAttributes: @entangle('availableAttributes'),
                backendFilters: @entangle('filters'),
                initValue: {
                    filters: {},
                    minPrice: {{ $minPrice }},
                    maxPrice: {{ $maxPrice }},
                    brand: '{{ $brand }}',
                    symbol: '{{ \App\Helpers\Currency::getSymbol() }}',
                },
                filters: {},
                initRange: {},
                amount: null,
                init() {
                    // assign the value of availableAttributes as the key of filters
                    this.availableAttributes.forEach(attribute => this.filters[attribute] = []);
                    this.filters.price = [this.initValue.minPrice, this.initValue.maxPrice];
                    this.initValue.filters = JSON.stringify(this.filters);
                    if (this.initValue.brand) this.filters.brand.push(this.initValue.brand);
                    this.temp = JSON.stringify(this.filters);
                    // init range slider
                    const {
                        min,
                        max
                    } = this.initPrice();

                    this.initRange = {
                        min: min,
                        max: max,
                        from: min,
                        to: max,
                    };
                    this.amount = $(this.$refs.amount).ionRangeSlider({
                        skin: "round",
                        type: "double",
                        grid: 1,
                        prefix: this.initValue.symbol,
                        onChange: (data) => this.filters.price = [data.from, data.to],
                        ...this.initRange,
                    });
                },
                initPrice() {
                    const maxThousands = Number("1E" + (this.initValue.maxPrice.toString().length - 2));
                    const minThousands = Number("1E" + (this.initValue.minPrice.toString().length - 2));
                    const max = Math.ceil(this.initValue.maxPrice / maxThousands) * maxThousands;
                    const min = Math.floor(this.initValue.minPrice / minThousands) * minThousands;
                    return {
                        min,
                        max
                    };
                },
                filterPrice($dispatch) {
                    const filtersJson = JSON.stringify(this.filters);

                    if (!this.isChanged()) {
                        return $dispatch('flash-messages', {
                            type: 'warning',
                            message: 'Filters don\'t change!!!'
                        });
                    };

                    this.temp = filtersJson;
                    document.dispatchEvent(eventVisibleProducts);
                    @this.assignNewFilters(this.filters);
                },
                clearFilter() {
                    if (!this.isNotInitValue()) return;

                    this.availableAttributes.forEach(attribute => this.filters[attribute] = []);
                    this.filters.price = [this.initValue.minPrice, this.initValue.maxPrice];
                    this.temp = JSON.stringify(this.filters);
                    this.amount.data("ionRangeSlider").update(this.initRange);

                    @this.assignNewFilters(this.filters);
                },
                isChanged() {
                    return JSON.stringify(this.filters) != this.temp;
                },
                isNotInitValue() {
                    return JSON.stringify(this.backendFilters) != '[]' &&
                        this.initValue.filters != JSON.stringify(this.backendFilters);
                },
            };
        }
    </script>
@endpush

@section('title', $search ? "Search: $search" : 'Shop')
