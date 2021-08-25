<div class="login">
    <div class="login_form_container">
        <div class="account_login_form">
            <form wire:submit.prevent='changePassword'>

                <x-inputs.group model='edit.password' for='userPass' class='mb-20'>
                    <x-slot name='label'>
                        Password <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='edit.password' id='userPass' type="password">
                </x-inputs.group>

                <x-inputs.group model='edit.new_password' for='userNewPass' class='mb-20'>
                    <x-slot name='label'>
                        New Password <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='edit.new_password' id='userNewPass' type="password">
                </x-inputs.group>

                <x-inputs.group model='edit.new_password_confirmation' for='userNewPassConfirm' class='mb-20'>
                    <x-slot name='label'>
                        New Password Confirmation <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='edit.new_password_confirmation' id='userNewPassConfirm' type="password">
                </x-inputs.group>

                <div class="save_button mt-3">
                    <x-inputs.button-spinner target='changePassword' type="submit"
                        class="btn btn-md btn-black-default-hover">
                        Save
                    </x-inputs.button-spinner>
                </div>

            </form>
        </div>
    </div>
</div>
