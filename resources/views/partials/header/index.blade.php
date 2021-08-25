@include('partials.header.page-loading')

@include('partials.header.menu-normal')

@include('partials.header.mobile')

@include('partials.header.menu-mobile')

@include('partials.canvas.about')

<livewire:partials.quick-view-cart-component />

<livewire:partials.quick-view-wish-list-component />

<livewire:partials.search-component key="quickSearch" />

@include('partials.canvas.overlay')
