<div id="form5" class="container-outer bg-lighter-grey relative h-[385px]">
    <div class="absolute z-0 inset-0 w-[95%] m-auto h-[95%] overflow-hidden">
        @include('icons.contact-bg')
    </div>
</div>
<div class="container">
    <div class="shadow-default bg-white relative top-[-200px] mb-[-200px]">
        <div class="lg:flex flex-row-reverse">
            <div class="flex-1 py-[30px] lg:py-[65px] px-[30px] lg:px-[60px]">
                <iframe src="{!! $form_embed !!}" width="100%" height="650" type="text/html" frameborder="0"
                    allowTransparency="true" style="border: 0"></iframe>
            </div>
            <div class="lg:w-[35%] bg-[#233741] text-white py-[30px] lg:py-[65px] px-[30px] lg:px-[60px] space-y-6">
                @include('elements.text', ['text' => $heading, 'type' => 'h3', 'size' => 32])
                @if ($image)
                    <div class="w-[150px] m-auto">
                        @img($image['ID'])
                    </div>
                @endif
                @if ($text)
                    <div class="">
                        @include('elements.text', [
                            'text' => $text,
                            'type' => 'wysiwyg',
                            'size' => 14,
                        ])
                    </div>
                @endif
                @if ($items)
                    <ul class="text-[12px] font-medium">
                        @foreach ($items as $item)
                            <li class="flex items-center space-x-3">
                                <span class="block h-[6px] w-[6px] bg-blue"></span>
                                <span>{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if ($link)
                    @include('elements.link', ['link' => $link])
                @endif
            </div>
        </div>
    </div>
</div>
