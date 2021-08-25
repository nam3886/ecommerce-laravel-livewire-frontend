@props(['thumbnail'])

<div class="blog-video-box">
    <x-images.lazy class='img-fluid' :src="$thumbnail->image" />
    <a href="{{ $thumbnail->link_video }}" class="video-play-btn" data-autoplay="true" data-vbtype="video">
        <i class="fa fa-youtube-play"></i>
    </a>
</div>
