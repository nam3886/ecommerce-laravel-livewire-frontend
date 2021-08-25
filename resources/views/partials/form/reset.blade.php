<div class="col-lg-6 col-md-6">
    <div wire:ignore.self class="account_form" data-aos="fade-up" data-aos-delay="0">
        <h3>Reset password</h3>
        <form wire:submit.prevent='resetPassword' wire:key='reset-password-form'>

            <x-inputs.group model='user.reset.email' for='userResetEmail'>
                <x-slot name='label'>
                    Email address <span class='required'>*</span>
                </x-slot>
                <input wire:model.defer='user.reset.email' id='userResetEmail' type="email" disabled>
            </x-inputs.group>

            <x-inputs.group model='user.reset.password' for='userResetPassword'>
                <x-slot name='label'>
                    New Password <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.reset.password' id='userResetPassword' type="password" />
            </x-inputs.group>

            <x-inputs.group model='user.reset.password_confirmation' for='userResetPasswordConfirmation'>
                <x-slot name='label'>
                    New Password Confirmation <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.reset.password_confirmation'
                    id='userResetPasswordConfirmation' type="password" />
            </x-inputs.group>

            <div class="login_submit">
                <x-inputs.button-spinner type="submit" target='resetPassword'
                    class="btn btn-md btn-black-default-hover mb-4">
                    reset password
                </x-inputs.button-spinner>

                <div>
                    Remember It ? <a class='information' href="#" wire:loading.class='not-allowed'
                        wire:click.prevent="$set('mode', 1)">Sign In here</a>
                </div>
            </div>
        </form>
    </div>
</div>
