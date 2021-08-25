<div id="fb-root" data-turbolinks-permanent></div>

<div class="fb-customerchat" data-turbolinks-no-cache attribution="biz_inbox"
    page_id="{{ config('settings.facebook_page_id') }}">
</div>

@push('scripts')
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&cookie=1&appId={{ config('settings.facebook_app_id') }}"
        nonce="vL4iX6Wc"></script>
@endpush
