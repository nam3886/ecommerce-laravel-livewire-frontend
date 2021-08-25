@props(['url' => Request::url(), 'class' => ''])

<div wire:ignore data-href="{{ $url }}" data-width="" data-layout="button_count" data-action="like"
    data-size="small" class="fb-like">
</div>
