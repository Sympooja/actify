<div id="form1" class="container-outer bg-lighter-grey">
    <div class="container pb-[200px] lg:pb-[240px] pt-[40px] lg:pt-[90px] text-center">
        @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 48])
    </div>
</div>
<div class="container">
    <div class="shadow-default bg-white relative top-[-165px] mb-[-165px]">
        <div class="lg:flex flex-row-reverse">
            <div class="flex-1 py-[30px] lg:py-[65px] px-[30px] lg:px-[60px]">
                <iframe src="{!! $form_embed !!}" width="100%" height="1100" type="text/html" frameborder="0"
                    allowTransparency="true" style="border: 0"></iframe>
            </div>
            <div class="lg:w-[35%] bg-blue text-white py-[30px] lg:py-[65px] px-[30px] lg:px-[60px]">
                @include('elements.text', ['text' => $follow_title, 'type' => 'h3', 'size' => 22])
                <div class="pt-[5px] pb-[20px]">
                    @include('elements.text', [
                        'text' => $follow_description,
                        'type' => 'wysiwyg',
                        'size' => 14,
                    ])
                </div>
                <ul class="flex items-center space-x-[25px]">
                    @foreach ($options['connect_links'] as $item)
                        <li>
                            <a style="filter: brightness(0) invert(100%);" class="inline-block hover:opacity-[0.5]"
                                href="{{ $item['link']['url'] }}" title="{{ $item['link']['title'] }}">
                                @if ($item['icon'])
                                    @img($item['icon']['ID'])
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
