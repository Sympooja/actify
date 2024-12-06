<div class="row">
    @foreach (apply_filters('posts_to_array', $options['blog_options']['featured_articles']) as $article)
        @include('components.popular-article-preview', ['article' => $article])
    @endforeach
</div>
