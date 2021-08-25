<div class="sidebar-single-widget">
    <h6 class="sidebar-title">{{ $attribute['name'] }}</h6>
    <div class="sidebar-content">
        <div class="filter-type-select">
            <div class="row">

                @foreach ($attribute['values'] as $value)
                    <div class="checkbox-default col-6">
                        <input type="checkbox" id="{{ $attribute['code'] . $value['id'] }}"
                            value="{{ $value['id'] }}" x-model="filters.{{ $attribute['code'] }}">
                        <label for="{{ $attribute['code'] . $value['id'] }}">
                            {{ $value['name'] }}
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
