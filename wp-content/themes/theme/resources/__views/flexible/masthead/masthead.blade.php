<section data-type="masthead" data-layout="{{ $layout }}" data-aos=mixed_appear data-aos-once=true>
    @if (in_array($layout, ['1', '2']))
        <div class="container-outer relative">
            <div class="container {{ $layout === '1' ? 'py-8 md:py-32' : 'py-8 md:py-12' }}">
                <div class="md:flex items-center md:flex-row-reverse">
                    <div class="md:w-[40%] pb-10 md:pb-0">
                        @if ($layout === '1')
                            <div
                                class="absolute top-0 bottom-0 left-0 right-0 cover-image-child img-gradient-light-left">
                                @img($image['ID'])
                            </div>
                            <a href="{{ $video_modal }}"
                                class="glightbox relative block hover:video-button min-h-[200px]">
                                <div class="absolute absolute top-[50%] left-[50%] ml-[-75px] mt-[-75px]">
                                    @include('icons.play-button')
                                </div>
                            </a>
                        @else
                            <a href="{{ $video_modal }}" class="image glightbox relative block hover:video-button">
                                @img($image['ID'], 'large')
                                <div class="absolute absolute top-[50%] left-[50%] ml-[-75px] mt-[-75px]">
                                    @include('icons.play-button')
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="flex-1 pb-10 md:pb-0 md:pr-10 lg:pr-24">
                        @include('flexible.masthead.copy')
                    </div>
                </div>
            </div>
        </div>
    @elseif (in_array($layout, ['3', '5', '6']))
        <div
            class="container-outer {{ $layout !== '6' ? 'bg-back-cyan text-black' : '' }} {{ $layout === '5' ? 'md:mb-[40px] lg:mb-[90px] xl:mb-[105px]' : '' }}">
            <div class="container py-8 md:py-12">
                <div class="md:flex {{ $form_embed ? '' : 'items-center' }}">
                    <div class="flex-1 pb-10 md:pb-0 md:pr-10 lg:pr-24 {{ $form_embed ? 'lg:pt-12' : '' }}">
                        @include('flexible.masthead.copy')
                    </div>
                    <div class="flex-1">
                        @if ($layout === '3')
                            <div class="p-6 bg-white text-grey shadow-default">
                                <iframe src="{!! $form_embed !!}" width="100%" height="500" type="text/html"
                                    frameborder="0" allowTransparency="true" style="border: 0"></iframe>
                            </div>
                        @else
                            @if ($layout === '5')
                                <div class="image relative md:mb-[-40px] lg:mb-[-90px]">
                                    <div
                                        class="image bg-faded-aqua absolute w-[100%] h-[100%] top-[25px] left-[25px] hidden md:block">
                                    </div>
                                    <div class="relative">
                                        @img($image['ID'])
                                    </div>
                                </div>
                            @else
                                <div class="image">
                                    @img($image['ID'])
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif (in_array($layout, ['4']))
        <div class="container-outer relative bg-back-cyan">
            <!--<span class="bg-masthead-4 absolute inset-0"></span>-->
            @if ($add_looping_video && $video_looping)
                <span class="bg-white absolute inset-0 z-4 opacity-40"></span>
                <span class="bg-back-cyan absolute inset-0 z-4 opacity-50"></span>
                <span class="absolute inset-0">
                    <video class="absolute inset-0 object-cover h-full" width="100%" height="100%" autoplay loop
                        muted>
                        <source src="{{ $video_looping['url'] }}" type="video/mp4" />
                    </video>
                </span>
            @else
                <span class="bg-back-cyan absolute inset-0 z-4 opacity-70"></span>
                <span class="absolute inset-0">@img($image['ID'], 'w-full h-full object-cover')</span>
            @endif
            <div
                class="container relative {{ $add_looping_video && $video_looping ? 'py-24 md:py-48' : 'py-16 md:py-36' }} z-20">
                <div class="md:flex items-center md:flex-row-reverse">
                    <div class="flex-1 max-w-3xl mx-auto xl:px-4 text-center">
                        @include('flexible.masthead.copy')
                    </div>
                </div>
            </div>
        </div>
    @elseif (in_array($layout, ['7', '8']))
        <div class="container py-8 md:py-12">
            <div class="pb-8 md:pb-16 max-w-[750px] {{ $layout === '7' ? 'text-center mx-auto' : '' }}">
                @include('flexible.masthead.copy')
            </div>
            <div class="image">
                @img($image['ID'])
            </div>
        </div>
    @elseif (in_array($layout, ['9']))
        <div class="container-outer relative bg-grey">
            <div class="hidden md:block absolute top-0 left-0 z-[1] overflow-hidden">
                @include('icons.masthead-top-left')
            </div>
            <div class="hidden md:block absolute bottom-0 right-0 z-[1] overflow-hidden">
                @include('icons.masthead-bottom-right')
            </div>
            @if ($add_looping_video && $video_looping)
                <span class="bg-grey absolute inset-0 z-4 opacity-40"></span>
                <span class="absolute inset-0">
                    <video class="absolute inset-0 object-cover h-full" width="100%" height="100%" autoplay loop
                        muted>
                        <source src="{{ $video_looping['url'] }}" type="video/mp4" />
                    </video>
                </span>
            @else
                <span class="bg-grey absolute inset-0 z-4 opacity-20"></span>
                <span class="absolute inset-0">@img($image['ID'], 'w-full h-full object-cover')</span>
            @endif
            <div
                class="container relative {{ $add_looping_video && $video_looping ? 'py-24 md:py-48' : 'py-16 md:py-36' }} z-20">
                <div class="md:flex items-center md:flex-row-reverse">
                    <div class="flex-1 max-w-[1035px] mx-auto xl:px-4 text-center text-white">
                        <div class="space-y-4 relative">
                            @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 48])
                            <div class="max-w-[920px] mx-auto">
                                @include('elements.text', [
                                    'text' => $text,
                                    'type' => 'wysiwyg',
                                    'size' => 16,
                                ])
                            </div>
                            @if ($buttons)
                                <div class="space-y-1">
                                    @foreach ($buttons as $key => $button)
                                        @include('elements.button', [
                                            'link' => $button['link'],
                                            'color' => $key === 0 ? 'blue' : 'outline',
                                            'classes' => ['mr-3'],
                                            'size' => 'large',
                                        ])
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
