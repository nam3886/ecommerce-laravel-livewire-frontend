<ul class="comment">
    @foreach ($comments as $comment)
        <li wire:key='comment{{ $comment->id }}' class="comment-list">
            <div class="comment-wrapper">
                <div class="comment-img">
                    <x-images.lazy :src="$comment->user?->avatarString()??asset('images/user.jpg')" alt="user-avatar" />
                </div>
                <div class="comment-content">
                    <div class="comment-content-top">
                        <div class="comment-content-left">
                            <h6 class="comment-name">{{ $comment->name }}</h6>
                            @unless($isReply || $isArticlePage)
                                <x-data.rating class='review-star' :value="$comment->star" />
                            @endunless
                        </div>
                        <div class="comment-content-right float-right">
                            <a href="#" wire:click.prevent="$toggle('replies.{{ $comment->id }}')">
                                <i class="fa fa-reply"></i>Reply
                            </a>
                        </div>
                    </div>

                    <div class="para-content">
                        <p>{{ $comment->content }}</p>
                    </div>

                    @if ($replies[$comment->id] ?? false)
                        <form wire:submit.prevent='reply({{ $comment->id }})' class="mb-5">
                            <div class="col-12">
                                <x-inputs.group model='user.reply.{{ $comment->id }}' for='user-reply'>
                                    <x-inputs.required.text wire:model.defer='user.reply.{{ $comment->id }}'
                                        id="user-reply" placeholder="Reply . . ." />
                                </x-inputs.group>
                            </div>
                            <div class="col-12">
                                <x-inputs.button-spinner class='btn btn-md btn-black-default-hover' type='submit'
                                    target='review'>
                                    Reply
                                </x-inputs.button-spinner>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Start - Review Comment Reply --}}
            <ul class="comment-reply">
                @include('partials.body.products.feedback-list', [
                'comments' => $comment->replies,
                'isReply' => true,
                '$isArticlePage' => $isArticlePage,
                ])
            </ul>
            {{-- End - Review Comment Reply --}}
        </li>
    @endforeach
</ul>
