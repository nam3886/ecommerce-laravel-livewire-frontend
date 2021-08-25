<div class="contact-details-single-item">
    <div class="contact-details-icon">
        <i class="fa fa-phone"></i>
    </div>
    <div class="contact-details-content contact-phone">
        @foreach (explode(', ', config('settings.default_phone')) as $phone)
            <a href="tel:{{ $phone }}">{{ $phone }}</a>
        @endforeach
    </div>
</div>
