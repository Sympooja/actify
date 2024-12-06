<?php
if (!$article) {
    return;
}
if (!isset($cols)) {
    $cols = 'sm:col-span-6';
}

?>
<a href="{{ $article['url'] }}"
    class="col-span-12 flex items-center shadow-lg @if ($layout === '1') flex-col rounded-lg {{ $cols }} @elseif($layout === '2') flex-row @elseif($layout === '3') flex-col {{ $cols }} rounded-lg @endif">
    <div
        class="w-full @if ($layout === '1') thumbnail-container rounded-tr-lg rounded-tl-lg rounded-bl-md rounded-br-md overflow-hidden @elseif($layout === '2') h-full @else thumbnail-container h-full rounded-tr-lg rounded-tl-lg rounded-bl-md rounded-br-md @endif">
        @if ($article['featured_image_id'] && $article['featured_image_id'] !== 1700)
            @img($article['featured_image_id'], 'small w-full h-full object-cover rounded-tr-lg rounded-tl-lg rounded-bl-md rounded-br-md')
        @else
            <div class="{{ getCategoryTag($article['category']) }} flex justify-center items-center h-full">
                <img src="{{ themosis_theme_assets() }}/images/actify-white-logo.svg" />
            </div>
        @endif
    </div>
    <div
        class="flex-auto flex flex-col w-full px-6 py-10 bg-white @if ($layout != '2') rounded-br-lg rounded-bl-lg @endif">
        @if ($article['category'])
            <div class="mb-8">
                <span
                    class="{{ getCategoryTag($article['category']) }} text-white uppercase text-[14px] @if ($layout != '2') rounded-md py-2.5 px-3 tracking-[-0.02em] leading-[14px] @else px-2 py-0.5 @endif ">
                    {{ $article['category'] }}
                </span>
            </div>
        @endif
        <div>
            @if ($layout === '3')
                @include('elements.text', [
                    'text' => $article['title'],
                    'type' => 'h5',
                    'size' => 22,
                    'weight' => 300,
                ])
            @else
                @include('elements.text', [
                    'text' => $article['title'],
                    'type' => 'h5',
                    'size' => 22,
                    'weight' => 400,
                ])
            @endif
        </div>
    </div>
</a>
