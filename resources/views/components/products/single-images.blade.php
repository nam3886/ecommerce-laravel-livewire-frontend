@props(['images', 'alt'])

<x-images.lazy class='img-fluid' :src="$images->avatarString()" :alt="$alt.'-primary-img'" />
<x-images.lazy class='img-fluid' :src="$images->imagesString()->get(1)" :alt="$alt.'-secondary-img'" />
