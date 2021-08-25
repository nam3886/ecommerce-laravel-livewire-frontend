<div class="login">
    <div class="login_form_container">
        <div class="account_login_form">
            <form wire:submit.prevent='changeAccountDetail'>

                <x-inputs.group model='user.gender' class='mb-20'>
                    <div class="input-radio">
                        @foreach ($genders as $key => $gender)
                            <span class="custom-radio">
                                <input type="radio" value="{{ $key }}" name='gender'
                                    wire:model.defer='user.gender'>
                                {{ $gender }}</span>
                        @endforeach
                    </div>
                </x-inputs.group>

                <x-inputs.group model='user.name' for='userFName' class='mb-20'>
                    <x-slot name='label'>
                        Full Name <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='user.name' id='userFName' type="text">
                </x-inputs.group>

                <x-inputs.group model='user.phone' for='userPhone' class='mb-20'>
                    <x-slot name='label'>
                        Phone <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='user.phone' id='userPhone' type="text">
                </x-inputs.group>

                <x-inputs.group model='birthday' for='userBirthday' class='mb-20'>
                    <x-slot name='label'>
                        Birthday <span class='required'>*</span>
                    </x-slot>
                    <input wire:model.defer='birthday' id='userBirthday' type="date">
                </x-inputs.group>

                <x-inputs.group model='user.received_offer' class='mb-20'>
                    <div class="checkbox-default">
                        <input type="checkbox" id="offer" wire:model.defer='user.received_offer'>
                        <label for="offer" class='font-weight-normal'>
                            Receive offers from our partners
                        </label>
                    </div>
                </x-inputs.group>

                <x-inputs.group model='user.subscribed' class='mb-20'>
                    <div class="checkbox-default">
                        <input type="checkbox" id="newsletter" wire:model.defer='user.subscribed'>
                        <label for="newsletter" class='font-weight-normal'>
                            Subscribe to our newsletter<br><em>You may unsubscribe at any
                                moment. For that purpose, please find our contact info in
                                the
                                legal notice.</em>
                        </label>
                    </div>
                </x-inputs.group>

                <div class="save_button mt-3">
                    <x-inputs.button-spinner target='changeAccountDetail' type="submit"
                        class="btn btn-md btn-black-default-hover">
                        Save
                    </x-inputs.button-spinner>
                </div>

            </form>
        </div>
    </div>
</div>
