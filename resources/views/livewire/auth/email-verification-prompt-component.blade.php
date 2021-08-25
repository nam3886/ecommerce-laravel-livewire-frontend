<div>
    <x-partials.breadcrumb :title="__('verify email')" />
    <div class="customer-login">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div wire:ignore.self class="account_form" data-aos="fade-up" data-aos-delay="0">
                        <h3>{{ __('Verify Email') }}</h3>
                        <form method="POST" action="{{ route('verification.send') }}" class="mb-1">

                            @csrf

                            <div class="mb-4" role="alert">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="login_submit">
                                <x-inputs.button-spinner type="submit" target='sendMailResetLink'
                                    class="btn btn-md btn-black-default-hover mb-4">
                                    {{ __('Resend Verification Email') }}
                                </x-inputs.button-spinner>
                            </div>
                        </form>

                        @if (url()->previous() == url()->current())
                            <a href="{{ route('home') }}">
                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                <u>{{ __('Go home') }}</u>
                            </a>
                        @else
                            <a href="{{ url()->previous() }}">
                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                <u>{{ __('Go back') }}</u>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('title', 'Verify Email')
