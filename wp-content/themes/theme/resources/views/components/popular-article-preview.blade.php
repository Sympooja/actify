<div class="col-md-6 blog-feature-posts">
    <a href="{{ $article['url'] }}" class="col-span-12 flex items-center">
        <div class="w-full  thumbnail-container h-full rounded-tr-lg rounded-tl-lg rounded-bl-md rounded-br-md ">
            @if ($article['featured_image_id'])
                @img($article['featured_image_id'], 'small')
            @endif
        </div>
        <div class="flex-auto flex flex-col w-full px-6 py-10">
            @include('elements.text', [
                'text' => $article['title'],
                'type' => 'h5',
                'size' => '10',
                'weight' => 400,
            ])
            <div class="tracking-[-0.2px] text-[14px] flex items-center font-medium mt-1.5">
                Read full story
                <svg class="inline-block ml-3 group-hover:ml-6 transition-all duration-300" width="12" height="13"
                    viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 6.5H10.5" stroke="#186FE0" stroke-width="1.5" />
                    <path d="M5.25 1.25L10.5 6.5L5.25 11.75" stroke="#186FE0" stroke-width="1.5" />
                </svg>
            </div>
        </div>
    </a>
</div>