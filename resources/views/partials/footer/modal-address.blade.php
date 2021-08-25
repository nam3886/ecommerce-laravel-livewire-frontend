<div wire:ignore.self id="modalAddress" data-bs-backdrop="false" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <h5 class="modal-title text-capitalize">{{ __('new address') }}</h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form x-data="checkoutAddress" x-init="init;$watch('wards',value=>wardsChanged(value))"
                        @submit.prevent='confirmChangeAddress' @updated-user-address.window="hideModal" class="row">
                        <div class="col-lg-6">
                            <x-inputs.group model='user.name' for='userName'>
                                <x-slot name='label'>
                                    {{ __('Full Name') }} <span class='required'>*</span>
                                </x-slot>
                                <x-inputs.required.text x-model='newUser.name' id='userName'
                                    placeholder="{{ __('Enter your name') }}" />
                            </x-inputs.group>
                        </div>

                        <div class="col-lg-6">
                            <x-inputs.group model='user.phone' for='userPhone'>
                                <x-slot name='label'>
                                    {{ __('Phone') }} <span class='required'>*</span>
                                </x-slot>
                                <x-inputs.number x-model='newUser.phone' id='userPhone'
                                    placeholder="{{ __('Enter your Phone no.') }}" required />
                            </x-inputs.group>
                        </div>

                        <div class="col-12">
                            <x-inputs.group model='user.district' for='userDistrict'>
                                <x-slot name='label'>
                                    {{ __('District') }} <span class="required">*</span>
                                </x-slot>
                                <div wire:ignore>
                                    <select id='userDistrict' data-placeholder="{{ __('Select District') }}"
                                        class="form-select select2">
                                        <option></option>
                                    </select>
                                </div>
                            </x-inputs.group>
                        </div>

                        <div class="col-12">
                            <x-inputs.group model='user.ward' for='userWard'>
                                <x-slot name='label'>
                                    {{ __('Ward') }} <span class="required">*</span>
                                </x-slot>
                                <div wire:ignore>
                                    <select id='userWard' data-placeholder="{{ __('Select Ward') }}"
                                        class="form-select select2">
                                        <option></option>
                                    </select>
                                </div>
                            </x-inputs.group>
                        </div>

                        <div class="col-12">
                            <x-inputs.group model='user.street' for='userStreet'>
                                <x-slot name='label'>
                                    {{ __('Address') }} <span class='required'>*</span>
                                </x-slot>
                                <x-inputs.required.text x-model='newUser.street' id='userStreet'
                                    placeholder="{{ __('Ward, Street, apartment, suite, unit etc...') }}" />
                            </x-inputs.group>
                        </div>

                        <div class="col-12 text-right">
                            @if ($user->get('fullAddress'))
                                <button x-on:click="cancelChangeAddress" data-bs-dismiss="modal" type="button"
                                    class="btn btn-md btn-goldden-default-hover mr-5">{{ __('Close') }}</button>
                            @else
                                <a href="javascript:window.history.back()"
                                    class="btn btn-md btn-goldden-default-hover mr-5">{{ __('Close') }}</a>
                            @endif
                            <x-inputs.button-spinner type="submit" class="btn btn-md btn-black-default-hover">
                                {{ __('Complete') }}
                            </x-inputs.button-spinner>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function checkoutAddress() {
            return {
                wardElement: null,
                districts: @entangle('districts'),
                wards: @entangle('wards'),
                user: @entangle('user'),
                newUser: {},
                init() {
                    $("#modalAddress").on('shown.bs.modal', () => {
                        !this.districts && this.initSelect2();
                        console.log('init select2');
                    });

                    if (this.user.fullAddress) {
                        @this.updateDelivery();
                    } else {
                        $('#modalAddress').modal('show')
                    }

                    this.newUser = {
                        ...this.user
                    };
                },
                initSelect2() {
                    const districtElement = $('#userDistrict');

                    districtElement.select2().on('change', (event) => {
                        @this.set('user.district', event.target.value);
                    });

                    this.wardElement = $('#userWard').select2().on('change', (event) => {
                        @this.set('user.ward', event.target.value);
                    });

                    @this.getDistricts().then(() => {
                        districtElement.empty().prepend(new Option).select2({
                            data: this.districts,
                        });
                    });

                    if (this.user.ward) {
                        @this.getWards().then(() => this.wardsChanged());
                    }
                },
                wardsChanged() {
                    this.wardElement.empty().prepend(new Option).select2({
                        data: this.wards,
                    });
                },
                confirmChangeAddress() {
                    @this.updateUserAddress(this.newUser);
                },
                cancelChangeAddress() {
                    this.newUser = {
                        ...this.user
                    };
                },
                hideModal() {
                    $('#modalAddress').modal('hide');
                }
            }
        }
    </script>
@endpush
