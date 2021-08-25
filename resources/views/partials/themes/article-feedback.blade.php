<div class="comment-area">
    <div class="comment-box" data-aos="fade-up" data-aos-delay="0">
        <h4 class="title mb-4">{{ $comments->count() }} Comments</h4>
        @include('partials.body.products.feedback-list', [
        'comments' => $comments,
        'isReply' => false,
        '$isArticlePage' => $isArticlePage,
        ])
    </div>

    {{-- Start comment Form --}}
    <div class="comment-form" data-aos="fade-up" data-aos-delay="0">
        <div class="coment-form-text-top mt-30">
            <h4 class="title mb-3 mt-3">Leave a Reply</h4>
            <p>Your email address will not be published. Required fields are marked *</p>
        </div>

        <form wire:submit.prevent='review' x-data @reviewed.window="grecaptcha.reset()">
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
                        <x-inputs.required.textarea wire:model.defer='user.content' id="comment-review-text"
                            placeholder="Write a review" />
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
                        <span wire:ignore x-ref="btnReview">Post Comment</span>
                    </x-inputs.button-spinner>
                </div>
            </div>
        </form>
    </div>
    {{-- End comment Form --}}
</div>
