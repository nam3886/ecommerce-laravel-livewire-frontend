@props(['thumbnail', 'slug' => null, 'alt' => null])

<div class="image-box">
    @if ($slug)
        <x-data.link class="image-link" route="article_detail" :value="$slug">
            <x-images.lazy class='img-fluid' :src="$thumbnail" :alt="$alt" />
        </x-data.link>
    @else
        <x-images.lazy class='img-fluid' :src="$thumbnail" :alt="$alt" />
    @endif

</div>
