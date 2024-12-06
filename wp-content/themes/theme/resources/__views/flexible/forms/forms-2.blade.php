<div id="form2" class="container">
    <div class="mb-[30px] lg:mb-[55px] space-y-4 max-w-[750px]" data-aos=mixed_appear data-aos-once=true>
        @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40])
        @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-6 md:gap-y-12" data-aos=child_appear
        data-aos-once=true>
        @foreach ($items as $item)
            <div class="space-y-4">
                @include('elements.text', ['text' => $item['heading'], 'type' => 'h2', 'size' => 22])
                <div class="max-w-[270px]">
                    @include('elements.text', [
                        'text' => $item['description'],
                        'type' => 'wysiwyg',
                        'size' => 14,
                    ])
                </div>
                @if ($item['links'])
                    <div class="text-[13px] md:text-[14px] space-y-1">
                        @foreach ($item['links'] as $link)
                            <a class="block text-blue hover:text-black"
                                href="{{ $link['link']['url'] }}">{{ $link['link']['title'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
