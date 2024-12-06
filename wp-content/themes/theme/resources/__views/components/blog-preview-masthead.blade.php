<a href="{{ $article['url'] }}" class="col-span-12 flex-auto flex items-center shadow-lg flex-row max-h-48">
    <div class="w-2/5 h-full">
        @if ($article['featured_image_id'] && $article['featured_image_id'] !== 1700)
            @img($article['featured_image_id'], 'small w-full h-full object-cover')
        @else
            <div class="{{ getCategoryTag($article['category']) }} flex justify-center items-center h-full">
                <img src="{{ themosis_theme_assets() }}/images/actify-white-logo.svg"
                    style="max-width:80%; height:auto;" />
            </div>
        @endif
    </div>
    <div class="w-3/5 px-6 py-7 space-y-4 bg-white h-full">
        <span class="{{ getCategoryTag($article['category']) }} text-white uppercase px-2 py-0.5 text-[14px]">
            {{ $article['category'] }}
        </span>
        <div class="line-clamp-2">
            @include('elements.text', [
                'text' => $article['title'],
                'type' => 'h5',
                'size' => 18,
                'weight' => 400,
            ])
        </div>
    </div>
</a>
