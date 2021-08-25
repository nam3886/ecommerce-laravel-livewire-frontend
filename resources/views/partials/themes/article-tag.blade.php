<div class="sidebar-single-widget">
    <h6 class="sidebar-title">Tags</h6>
    <div class="sidebar-content">
        <div class="tag-link">
            @foreach ($tags as $eachTag)
                <a href="{{ route('shop', ['tag' => $eachTag->slug]) }}">
                    {{ $eachTag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
