<div x-data="editAddress()" @address-changed.window='isEditting=false'>
    <p>The following addresses will be used on the checkout page by default.</p>
    <h5 class="billing-address">Billing address</h5>
    <a href="#" class="view" @click.prevent="toggleMode" x-text="isEditting?'Cancel':'Edit'"></a>
    <p><strong>{{ $user->name }}</strong></p>
    <address x-show="!isEditting">
        {{ $user->address?->fullAddress }}<br>
    </address>
    <address x-show="isEditting">
        <form wire:submit.prevent='changeAddress'>
            <x-inputs.group for='province' class='mb-20' model='userAddress.province_id'>
                <x-slot name='label'>
                    Province <span class="required">*</span>
                </x-slot>
                <x-inputs.select id='province' wire:model='userAddress.province_id' :options="$provinces"
                    title="Province" class="form-select" />
            </x-inputs.group>
            <div @if ($districts->isEmpty()) class="d-none" @endif>
                <x-inputs.group for='district' class='mb-20' model='userAddress.district_id'>
                    <x-slot name='label'>
                        District <span class="required">*</span>
                    </x-slot>
                    <x-inputs.select id='district' wire:model='userAddress.district_id' :options="$districts"
                        title="District" class="form-select" />
                </x-inputs.group>
            </div>
            <x-inputs.group for='street' class='mb-20' model='userAddress.street'>
                <x-slot name='label'>
                    Street <span class='required'>*</span>
                </x-slot>
                <input id='street' type="text" wire:model='userAddress.street'>
            </x-inputs.group>
            <div class="save_button mt-3">
                <x-inputs.button-spinner target='changeAddress' type="submit"
                    class="btn btn-md btn-black-default-hover">
                    Save
                </x-inputs.button-spinner>
            </div>
        </form>
    </address>
    {{-- <p>{{ str_replace('_', '-', app()->getLocale()) }}</p> --}}
</div>

@push('scripts')
    <script>
        function editAddress() {
            return {
                isEditting: false,
                toggleMode() {
                    this.isEditting = !this.isEditting;
                    this.isEditting && @this.getInitAddress();
                },
            };
        }
    </script>
@endpush
