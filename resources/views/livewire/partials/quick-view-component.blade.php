<div wire:ignore.self id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid position-relation">
                    <div x-data x-init="$('#skeleton').show();$('#quickViewContent').hide()"
                        x-on:close-modal-quick-view.window="$('#modalQuickview').modal('hide')" class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>

                    <x-partials.fake-quick-view id="skeleton" wire:ignore wire:key='fake-quick-view' />

                    <div class="row" id="quickViewContent" wire:key='quick-view'>
                        <div class="col-md-6">
                            @include('partials.themes.gallery-quick-view')
                        </div>

                        <div class="col-md-6">
                            @if ($product)
                                <livewire:products.detail-component :product="$product" :key="'quickview'.$product->id"
                                    :isProductPage="false" :wishListRowId="$wishListRowId" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FOR VARIANT OPTIONS --}}
@push('scripts')
    <script>
        function variant($wire) {
            return {
                _variants: $wire.entangle('variants'),
                accepted: null,
                options: {},
                filtered: {},
                select: function(attributeId, code) {
                    if (this.options[attributeId] === code) {
                        delete this.options[attributeId];
                    } else {
                        this.options[attributeId] = code;
                    }

                    this.filter(attributeId);
                },
                filter: function(attributeId) {
                    const variants = this._variants;
                    const options = Object.values(this.options);
                    const optionKeys = Object.keys(this.options);
                    // filter out the variant whose combination matches all codes in the options
                    const temp = variants.filter(function(variant) {
                        return options.every(function(code) {
                            return variant.combination.includes(code);
                        });
                    });

                    this.filtered = this.groupByAttibuteId(temp);

                    if (optionKeys.length <= 1) {
                        delete this.filtered[optionKeys[0]];
                    }

                    this.validateVariant();
                },
                isValid: function(attributeId, code) {
                    return typeof this.filtered[attributeId] === 'undefined' ?
                        true :
                        this.filtered[attributeId].includes(code);
                },
                groupBy: function(key) {
                    return function(array) {
                        return array.reduce((objectsByKeyValue, obj) => {
                            const value = obj[key];
                            // objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                            objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj.code);
                            return objectsByKeyValue;
                        }, {});
                    }
                },
                groupByAttibuteId: function(variants) {
                    // flat variants
                    variants = Array.from(variants).reduce(function(prev, cur) {
                        return prev.concat(cur.values);
                    }, []);
                    return this.groupBy('attribute_id')(variants);
                },
                validateVariant: function() {
                    const combinations = this._variants
                        .reduce((prev, cur) => prev.concat(cur.combination), []);
                    const options = Object.values(this.options).sort();
                    const optionCombination = options.join('');
                    const matched = combinations.filter(combination => {
                        return combination.includes(optionCombination);
                    });
                    // only one combination and choice all it's attributes
                    if (
                        matched.length === 1 &&
                        Number(matched[0].match(/:(\d+)/)[1]) === options.length
                    ) {
                        this.accepted = matched[0];
                    } else {
                        this.accepted = null;
                    }
                },
                assignNewVariant: function(combination) {
                    $wire.assignNewVariant(combination);
                },
                clearSelected: function() {
                    this.options = {};
                    this.filtered = {};
                    this.accepted = null;
                },
                classSelect(attributeId, code) {
                    return {
                        '__checked': this.options[attributeId] === code,
                        '__disabled': !this.isValid(attributeId, code)
                    };
                }
            };
        }
    </script>
@endpush

{{-- FOR QUANTITY --}}
@push('scripts')
    <script>
        function touchSpin($wire, min, quantity, isDetail = true) {
            return {
                min,
                quantity,
                max: $wire.entangle('max'),
                input: null,
                touchSpin: null,
                changeCartTimeout: null,
                init() {
                    this.touchSpin = this.$refs.touchSpin;
                    this.input = $(this.$refs.input).TouchSpin({
                        verticalbuttons: !0,
                        min: this.min,
                        max: this.max,
                        buttondown_class: isDetail ? "btn btn-default disabled" : "btn btn-default",
                        buttonup_class: isDetail ? "btn btn-default disabled" : "btn btn-default"
                    }).on('change', (event) => {
                        this.quantity = event.target.value;

                        if (!isDetail) {
                            this.changeCartQuantity();
                        }
                    });

                    this.maxChanged(this.max);
                },
                maxChanged(value) {
                    this.touchSpin?.querySelectorAll('button').forEach(button => {
                        button.classList.toggle('disabled', value <= 0);
                    });

                    if (value <= 0) return this.input.prop('disabled', true);

                    this.input.prop('disabled', false)
                        .trigger("touchspin.updatesettings", {
                            max: value
                        });
                },
                submit() {
                    $wire.set('quantity', this.quantity);
                    $wire.add();
                },
                changeCartQuantity() {
                    clearTimeout(this.changeCartTimeout);
                    this.changeCartTimeout = setTimeout(() => {
                        $wire.set('quantity', this.quantity);
                    }, 1000);

                }
            };
        }
    </script>
@endpush
