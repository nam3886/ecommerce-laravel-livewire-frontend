@props(['id'])

<div wire:ignore id="{{ $id }}" class="g-recaptcha"></div>

@push('scripts')
@once
<script type="text/javascript">
	var captchCallback = function() {
		grecaptcha.render('{{ $id }}', {
			'sitekey' : '{{ config('captcha.key') }}',
			'callback': token => @this.set('captcha', token),
		});
	};
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=captchCallback&render=explicit" async defer>
</script>
@endonce
@endpush