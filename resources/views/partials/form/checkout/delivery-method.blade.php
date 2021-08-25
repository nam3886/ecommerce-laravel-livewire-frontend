<form wire:submit.prevent='calculate'>
    <x-inputs.group model='user.delivery_id' class="mb-0">
        @foreach ($deliveries as $delivery)
            <div class="panel-default">
                <div class="checkbox-default">
                    <input wire:model.defer='user.delivery_id' id="delivery{{ $delivery->id }}"
                        value='{{ $delivery->id }}' type="radio" name="delivery">
                    <label for="delivery{{ $delivery->id }}">{{ $delivery->name }}</label>
                </div>
            </div>
        @endforeach
    </x-inputs.group>

    <div class="text-capitalize mb-4">shipping fee: <strong>
            <x-data.price :value="$shippingFee" />
        </strong></div>

    <x-inputs.button-spinner target="calculate" type="submit" class="btn btn-md btn-black-default-hover">
        Calculate shipping fee
    </x-inputs.button-spinner>
</form>
