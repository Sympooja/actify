@extends('layouts.default')
@section('content')
    <section class="four-oh-four my-10 md:my-20">
        <div class="container">

            <div class="md:flex justify-between items-center">
                <article class="text-center md:text-left">
                    <h6 class="c--accent text-[30px] lg:text-[60px] font-bold">404</h6>
                    <h1 class="mb-16 text-[16px] lg:text-[32px]">Uh oh, we can't find that page</h1>
                    <p class="mb-2 mt-0 fs--20">Let's get you back somewhere safe</p>
                    @include('elements.link', [
                        'link' => ['title' => 'Back home', 'url' => '/'],
                        'show_arrow' => true,
                    ])
                </article>
                <div class="u-6/12@tablet">
                    {{-- <img src="{{ themosis_theme_assets() }}/images/404.png" alt="404" draggable="false"/> --}}
                </div>
            </div>
        </div>
    </section>
@endsection