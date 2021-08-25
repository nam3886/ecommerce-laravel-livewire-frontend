<div class="col-lg-6 col-md-6">
    <div wire:ignore.self class="account_form register" data-aos="fade-up" data-aos-delay="200">
        <h3>Register</h3>
        <form wire:submit.prevent='register' wire:key='register-form'>

            <x-inputs.group model='user.register.email' for='userEmailRegister'>
                <x-slot name='label'>
                    Email address <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.register.email' id='userEmailRegister' type="email" />
            </x-inputs.group>

            <x-inputs.group model='user.register.password' for='userPasswordRegister'>
                <x-slot name='label'>
                    Password <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.register.password' id='userPasswordRegister'
                    type="password" />
            </x-inputs.group>

            <x-inputs.group model='user.register.password_confirmation' for='userPasswordConfirmRegister'>
                <x-slot name='label'>
                    Confirm Password <span class='required'>*</span>
                </x-slot>
                <x-inputs.required.text wire:model.defer='user.register.password_confirmation'
                    id='userPasswordConfirmRegister' type="password" />
            </x-inputs.group>

            <div class="login_submit">
                <div class="checkbox-default mb-4">
                    <input wire:model.defer='user.register.agree_PP' type="checkbox" id="agreePrivacyPolicy">
                    <label for="agreePrivacyPolicy">
                        I have read and agree to the <a class='information' href="#">Privacy Policy</a>
                    </label>
                    <br>
                    @error('user.register.agree_PP')
                        <div class='mt-2 d-inline'>
                            <span class="toast-invalid error-validate d-inline">
                                {{ $message }}
                            </span>
                        </div>
                    @enderror
                </div>
                <x-inputs.button-spinner target='register' type="submit"
                    class="btn btn-md btn-black-default-hover mb-4">
                    Register
                </x-inputs.button-spinner>
            </div>

        </form>
    </div>
</div>
