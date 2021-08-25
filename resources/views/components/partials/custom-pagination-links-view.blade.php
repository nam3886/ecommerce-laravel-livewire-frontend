@if ($paginator->hasPages())

    <div wire:ignore.self x-data="pagination()" @click='triggerEvent' data-aos="fade-up" data-aos-delay="0"
        class="page-pagination text-center">

        <ul>
            @unless($paginator->onFirstPage())

                {{-- First Page Link --}}
                <li>
                    <a wire:click.prevent="gotoPage(1)" href='{{ $paginator->toArray()['first_page_url'] }}'>
                        <i class="ion-ios-skipbackward"></i>
                    </a>
                </li>

            @endunless

            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Show active page two pages before and after it. --}}
                        @if ($page === $paginator->currentPage())
                            <li><span class='active'>{{ $page }}</span></li>
                        @elseif (
                            $page === $paginator->currentPage() + 1 ||
                            $page === $paginator->currentPage() - 1
                            )
                            <li>
                                <a href="{{ $url }}"
                                    wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif

                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href='{{ $paginator->url($paginator->lastPage()) }}'
                        wire:click.prevent="gotoPage({{ $paginator->lastPage() }})">
                        <i class="ion-ios-skipforward"></i>
                    </a>
                </li>
            @endif
        </ul>

    </div>

@endif

@push('scripts')
    <script>
        function pagination() {
            return {
                triggerEvent: function(e) {
                    if (e.target.closest('li a:not(.active)')) {
                        document.dispatchEvent(eventVisibleProducts);
                    }
                }
            }
        }
    </script>
@endpush
