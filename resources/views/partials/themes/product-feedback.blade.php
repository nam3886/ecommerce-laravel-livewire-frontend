<div class="single-tab-content-item">

    @include('partials.body.products.feedback-list', [
    'comments' => $comments,
    'isReply' => false,
    ])

    <div class="review-form">
        <div class="review-form-text-top">
            <h5>YOU'RE REVIEWING: {{ $product->name }}</h5>
        </div>
        <div class="review-form-text-top flex-row align-items-center justify-content-start">
            <h5 class="mr-1">ADD VOTE:</h5>
            <x-inputs.group model='user.star' class='mb-3'>
                <div wire:ignore>
                    <input data-filled="fa fa-star rating-star" data-empty="fa fa-star-o text-muted rating-star"
                        type="hidden" value="5" class="rating-tooltip-manual rating">
                </div>
            </x-inputs.group>
        </div>
        <div class="review-form-text-top">
            <h5>ADD A REVIEW</h5>
            <p>Your email address will not be published. Required fields are marked
                <span class='required'>*</span>
            </p>
        </div>

        <form @submit.prevent='review' x-data="rating()" x-init="init" @reviewed.window="reset">
            <div class="row">
                @guest
                    <div class="col-md-6">
                        <x-inputs.group model='user.name' for='comment-review-text'>
                            <x-slot name='label'>Your name <span class='required'>*</span></x-slot>
                            <x-inputs.required.text wire:model.defer='user.name' id="comment-name" type="text"
                                placeholder="Enter your name" />
                        </x-inputs.group>
                    </div>
                    <div class="col-md-6">
                        <x-inputs.group model='user.email' for='comment-review-text'>
                            <x-slot name='label'>Your email <span class='required'>*</span></x-slot>
                            <x-inputs.required.text wire:model.defer='user.email' id="comment-email" type="email"
                                placeholder="Enter your email" />
                        </x-inputs.group>
                    </div>
                @endguest
                <div class="col-12">
                    <x-inputs.group model='user.content' for='comment-review-text'>
                        <x-slot name='label'>Your review <span class='required'>*</span></x-slot>
                        <x-inputs.required.textarea wire:model.defer='user.content' @change="handleFillText"
                            id="comment-review-text" placeholder="Write a review" />
                    </x-inputs.group>
                </div>
                <div class="col-12">
                    <x-inputs.group model='captcha'>
                        <x-slot name='label'>Captcha <span class='required'>*</span></x-slot>
                        <x-inputs.captcha id="gRecaptcha" />
                    </x-inputs.group>
                </div>
                <div class="col-12">
                    <x-inputs.button-spinner class='btn btn-md btn-black-default-hover' type='submit' target='review'>
                        <span wire:ignore x-ref="btnReview">Vote</span>
                    </x-inputs.button-spinner>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        function rating() {
            return {
                rating: null,
                value: 5,
                init() {
                    this.rating = $('.rating')
                        .rating({
                            extendSymbol: function() {
                                let count;
                                $(this)
                                    .tooltip({
                                        container: 'body',
                                        placement: 'bottom',
                                        trigger: 'manual',
                                        title: () => `Vote ${count}*`,
                                    })
                                    .on('rating.rateenter', function(t, n) {
                                        count = n;
                                        $(this).tooltip('show');
                                    })
                                    .on('rating.rateleave', function() {
                                        $(this).tooltip('hide');
                                    });
                            },
                        })
                        .on('change', (e) => this.value = e.target.value);
                },
                reset() {
                    this.rating.rating('rate', 5);
                    grecaptcha.reset();
                },
                review() {
                    @this.review(this.value);
                },
                handleFillText(event) {
                    this.$refs.btnReview.textContent = event.target.value?.trim() ?
                        "Submit Review" :
                        "Vote";
                }
            }
        }

    </script>
@endpush
