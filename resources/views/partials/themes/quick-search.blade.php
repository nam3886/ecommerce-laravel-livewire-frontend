<div wire:ignore.self id="search" class="search-modal search-color--golden">
    <button type="button" class="close">×</button>
    <form x-data="{isTyped: false}" wire:submit.prevent='search' class="search-form">
        <div class="search-area">
            <input wire:model.debounce.500ms="search" type="search" placeholder="type keyword(s) here"
                aria-label="Search input" @input.debounce.400ms="isTyped = ($event.target.value !== '')" />

            <button type="submit" class="btn btn-lg btn-golden">
                <i class='ion-ios-search' aria-hidden="true"></i>
            </button>
        </div>

        <ul x-show="isTyped" x-cloak class='search-list'>
            @unless($products->count() || $categories->count() || $brands->count())
                <li class="not"><span>Nothings Found . . .</span></li>
            @endunless

            @if ($products->count())
                <li>
                    <span>products</span>
                    <ul class='autocomplete'>
                        @foreach ($products as $product)
                            <li>
                                <x-data.link :value="$product->slug">
                                    <u>{{ $product->name }}</u>
                                </x-data.link>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

            @if ($categories->count())
                <li>
                    <span>categories</span>
                    <ul class='autocomplete'>
                        @foreach ($categories as $category)
                            <li>
                                <x-data.link :value="$category->slug">
                                    <u>{{ $category->name }}</u>
                                </x-data.link>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

            @if ($brands->count())
                <li>
                    <span>brands</span>
                    <ul class='autocomplete'>
                        @foreach ($brands as $brand)
                            <li>
                                <x-data.link :value="$brand->slug">
                                    <u>{{ $brand->name }}</u>
                                </x-data.link>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </form>
</div>
