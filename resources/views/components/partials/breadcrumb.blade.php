@props(['title' => Str::title(config('settings.site_name')), 'last' => null])

<div wire:ignore class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">{{ Str::title($title) }}</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul id='breadcrumb-list'>
                                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>

                                @foreach (Request::segments() as $segment)
                                    @if ($loop->last)
                                        @empty($last)
                                            <li class="active text-capitalize" aria-current="page">
                                                {{ Str::title($segment) }}
                                            </li>
                                        @else
                                            <li class="active text-capitalize" aria-current="page">
                                                {{ Str::title($last) }}
                                            </li>
                                        @endempty
                                    @else
                                        <li>
                                            <a class='text-capitalize' href="/{{ $segment }}">
                                                {{ Str::title($segment) }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
