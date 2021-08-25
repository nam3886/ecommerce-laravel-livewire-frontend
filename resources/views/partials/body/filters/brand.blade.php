<div class="sidebar-single-widget">
    <h6 class="sidebar-title">Brand</h6>
    <div class="sidebar-content">
        <div class="filter-type-select">
            <ul>

                @foreach ($brands as $brand)
                    <li>
                        <div class="checkbox-default">
                            <input type="checkbox" id="brand{{ $brand['id'] }}" value="{{ $brand['id'] }}"
                                x-model="filters.brand">
                            <label for="brand{{ $brand['id'] }}">
                                {{ $brand['name'] }} ({{ $brand['products_count'] }})
                            </label>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
