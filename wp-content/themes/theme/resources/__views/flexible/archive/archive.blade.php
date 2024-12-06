<?php
$articles = [];
if ($selection === 'latest') {
    $articles = get_posts(['posts_per_page' => 4]);
} elseif ($selection === 'category') {
    $articles = get_posts(['posts_per_page' => 4, 'cat' => $category]);
} elseif ($selection === 'hand-picked') {
    $articles = $posts;
}
$articles = apply_filters('posts_to_array', $articles);
?>
@if ($articles)
    <section data-type="archive" class="py-[30px] md:py-[60px] relative">
        @if ($heading)
            <div class="container md:flex md:items-end justify-between items-center mb-6 md:mb-12">
                <div class="w-full md:w-3/4 lg:w-2/3">
                    @include('elements.text', [
                        'text' => $heading,
                        'type' => 'h1',
                        'size' => 40,
                        'weight' => 400,
                    ])
                </div>
                @if ($link)
                    <div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12 md:text-right pt-2 md:pt-0">
                        @include('elements.link', ['link' => $link, 'show_arrow' => true])
                    </div>
                @endif
            </div>
        @endif

        <div class="container">
            <div class="gap-4 grid grid-cols-12" data-aos=child_appear data-aos-once=true>
                @foreach ($articles as $article)
                    @include('components.blog-preview', [
                        'layout' => '1',
                        'cols' => 'sm:col-span-6 lg:col-span-3',
                        'article' => $article,
                    ])
                @endforeach
            </div>
        </div>
    </section>
@endif
