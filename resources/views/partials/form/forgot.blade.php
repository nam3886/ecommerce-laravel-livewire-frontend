<div class="col-lg-6 col-md-6">
    <div wire:ignore.self class="account_form" data-aos="fade-up" data-aos-delay="0">
        <h3>Forgot password</h3>
        <form wire:submit.prevent='sendMailResetLink' wire:key='forgot-password-form'>

            <div class="alert alert-success mb-4" role="alert">
                Enter your Email and instructions will be sent to you!
            </div>

            <x-inputs.group model='user.forgot.email' for='userForgotEmail'>
                <x-slot name='label'>
                    Email address <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.forgot.email' id='userForgotEmail' type="email" />
            </x-inputs.group>

            <div class="login_submit">
                <x-inputs.button-spinner type="submit" target='sendMailResetLink'
                    class="btn btn-md btn-black-default-hover mb-4">
                    send mail
                </x-inputs.button-spinner>

                <div>
                    Remember It ? <a class='information' href="#" wire:loading.class='not-allowed'
                        wire:click.prevent="$set('mode', 1)">Sign In here</a>
                </div>
            </div>
        </form>
    </div>
</div>
