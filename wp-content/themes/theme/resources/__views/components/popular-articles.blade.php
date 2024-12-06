<div class="py-9">
    <div class="grid md:grid-cols-3 xl:gap-x-16 gap-x-8 gap-y-8 md:gap-y-0">
        @foreach(apply_filters('posts_to_array', $options['blog_options']['featured_articles']) as $article)
            @include('components.popular-article-preview', ['article' => $article])
        @endforeach
    </div>
</div>