@props(['url' => Request::url(), 'class' => ''])

<a wire:ignore x-data="socialShare()" @click.prevent="fbShare" href="#" data-href="{{ $url }}">
    <i class="fa fa-facebook"></i>
</a>

@push('scripts')
    @once
        <script>
            function socialShare() {
                return {
                    fbShare() {
                        if (typeof FB !== "undefined") {
                            FB.ui({
                                    method: 'share',
                                    href: this.$el.dataset.href,
                                },
                                // callback
                                function(response) {
                                    if (response && !response.error_message) {
                                        console.log('Posting completed.');
                                    } else {
                                        console.log('Error while posting.');
                                    }
                                }
                            );
                        }
                    }
                };
            }
        </script>
    @endonce
@endpush
