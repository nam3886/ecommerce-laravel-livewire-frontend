<div wire:ignore.self id="modalDelivery" x-data @calculated-shipping-fee.window="$('#modalDelivery').modal('hide')"
    data-bs-backdrop="false" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <h5 class="modal-title text-capitalize">{{ __('choose delivery method') }}</h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form wire:submit.prevent='calculateShippingFee'>
                        <div class="row">
                            <x-inputs.group model='user.delivery_id' class="mb-0">
                                @foreach ($deliveries as $delivery)
                                    <div class="panel-default">
                                        <div class="checkbox-default">
                                            <input wire:model.defer='user.delivery_id'
                                                id="delivery{{ $delivery->id }}" value='{{ $delivery->id }}'
                                                type="radio" name="delivery">
                                            <label for="delivery{{ $delivery->id }}">{{ $delivery->name }}</label>
                                        </div>
                                        <div class="delivery-item" style="margin-left: 33px">
                                            @foreach ($deliveryItems as $deliveryItem)
                                                <div class="panel-default">
                                                    <div class="checkbox-default">
                                                        <input wire:model.defer='user.delivery_service_id'
                                                            id="delivery{{ $deliveryItem['service_id'] }}"
                                                            value='{{ $deliveryItem['service_id'] }}' type="radio"
                                                            name="deliveryItem">
                                                        <label for="delivery{{ $deliveryItem['service_id'] }}">
                                                            {{ $deliveryItem['short_name'] }} -
                                                            <x-data.price :value="$deliveryItem['fee']" />
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </x-inputs.group>

                            <div class="col-12 text-right">
                                <button type="button" data-bs-dismiss="modal"
                                    class="btn btn-md btn-goldden-default-hover mr-5">Close</button>
                                <x-inputs.button-spinner target="calculateShippingFee" type="submit"
                                    class="btn btn-md btn-black-default-hover">
                                    {{ __('Complete') }}
                                </x-inputs.button-spinner>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
