<a href="#search"><i class="icon-magnifier"></i></a>

@push('scripts')
    @once
        <script>
            (function() {
                document.querySelectorAll('a[href="#search"]')
                    .forEach(function(item) {
                        item.addEventListener('click', function() {
                            event.preventDefault();
                            document.querySelector('#search').classList.add("open");
                            document.querySelector('#search form input[type="search"]').focus();
                        });
                    });

                document.querySelector('#search button.close')
                    .addEventListener('click', function() {
                        this.parentNode.classList.remove("open");
                    });

            })();

        </script>
    @endonce
@endpush
