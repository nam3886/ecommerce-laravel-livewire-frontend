<div class="row">
    <div class="col-12">
        <div class="d-lg-inline">
            <strong>{{ $user->get('name') }}&nbsp;&nbsp;{{ $user->get('phone') }}</strong>
        </div>
        <div class="ml-lg-3 d-lg-inline">{{ $user->get('fullAddress') }}</div>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddress"
            class="text-uppercase float-lg-right">{{ __('change') }}</a>
    </div>
</div>
