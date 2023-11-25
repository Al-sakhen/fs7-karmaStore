<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="flex-wrap breadcrumb-banner d-flex align-items-center justify-content-end">
            <div class="col-first">
                {{-- title --}}
                <h1>{{ $title }}</h1>
                <nav class="d-flex align-items-center">
                    {{-- links --}}
                    @foreach ($links as $key => $value)
                        @if (!$loop->last)
                            <a href="{{ $value }}">{{ $key }}<span class="lnr lnr-arrow-right"></span></a>
                        @endif
                        @if ($loop->last)
                            <span class="text-white">{{ $key }}</span>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</section>
