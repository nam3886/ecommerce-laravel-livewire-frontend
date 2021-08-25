<div class="sidebar-single-widget">
    <h6 class="sidebar-title">CATEGORIES</h6>
    <div class="sidebar-content">
        <ul class="sidebar-menu">
            @foreach ($categories as $_category)
                <li>
                    @if ($_category->exists('children'))
                        <ul class="sidebar-menu-collapse">
                            <li class="sidebar-menu-collapse-list">
                                <div class="accordion">
                                    <a href="{{ route('shop', ['category' => $_category->slug]) }}"
                                        data-bs-target="#category{{ $_category->id }}" data-bs-toggle="collapse"
                                        aria-expanded="false" class="accordion-title collapsed text-capitalize">
                                        {{ $_category->name }} <i class="ion-ios-arrow-right"></i>
                                    </a>
                                    <div id="category{{ $_category->id }}" class="collapse">
                                        <ul class="accordion-category-list">
                                            @foreach ($_category->children as $_child)
                                                <li>
                                                    <a href="{{ route('shop', ['category' => $_child->slug]) }}"
                                                        class="text-capitalize">
                                                        {{ $_child->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('shop', ['category' => $_category->slug]) }}" class="text-capitalize">
                            {{ $_category->name }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
