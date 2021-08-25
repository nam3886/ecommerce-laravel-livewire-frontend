<div>
    <x-partials.breadcrumb :title="__('login & register')" />

    <div class="customer-login">
        <div class="container">
            <div class="row">
                @includeWhen($mode === 1, 'partials.form.login')
                @includeWhen($mode === 2, 'partials.form.forgot')
                @includeWhen($mode === 3, 'partials.form.reset')
                @include('partials.form.register')
            </div>
        </div>
    </div>
</div>

@section('title', 'Login & Register')
