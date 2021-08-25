<div class="sidebar-single-widget">
    <form @submit.prevent="filterPrice($dispatch)">
        <h6 class="sidebar-title">
            FILTER BY PRICE
        </h6>
        <div wire:ignore class="filter-type-price">
            <input x-ref='amount' type="text">
        </div>
        <x-inputs.button-spinner x-show="!isNotInitValue() || isChanged()" x-bind:disabled="!isChanged()"
            target='assignNewFilters' type='submit' class='btn btn-md btn-golden mt-3 text-uppercase'>
            {{ __('search') }}
        </x-inputs.button-spinner>
        <x-inputs.button-spinner x-show="isNotInitValue() && !isChanged()" @click="clearFilter"
            target='assignNewFilters' type='button' class='btn btn-md btn-golden mt-3 text-uppercase'>
            {{ __('clear') }}
        </x-inputs.button-spinner>
    </form>
</div>
