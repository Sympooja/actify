<div class="{{ $background }} py-9 px-7">
  @include('elements.text', ['text' => $options['blog']['other_articles_title'], 'type' => 'h4', 'size' => 22, 'weight' => 500 ])
  <div class="mt-4">
    @foreach(apply_filters('posts_to_array', $options['blog']['other_articles']) as $article)
      @include('components.blog-preview-small', ['article' => $article])
    @endforeach
  </div>
</div>