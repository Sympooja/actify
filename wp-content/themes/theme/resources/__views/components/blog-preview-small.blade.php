<a href="{{ $article['url'] }}" class="flex items-center border-t md:space-x-4 py-4 md:py-6">
  <div class="w-1/2 md:w-1/3 pr-4 md:pr-0">
    @if($article['featured_image_id'])
      @img($article['featured_image_id'], 'small')
    @endif
  </div>
  <div class="w-1/2 md:w-2/3 line-clamp-2">
    @include('elements.text', ['text' => $article['title'], 'type' => 'h5', 'size' => 16, 'weight' => 400])
  </div>
</a>
