<?php
$has_heading = !in_array($layout, ['1', '2']) && $heading;
$name_on_separate_line = in_array($layout, ['2']);

$fill_testimonial_data = function ($testimonial) {
    return [
        'name' => get_field('name', $testimonial),
        'subtitle' => get_field('subtitle', $testimonial),
        'quote' => get_field('quote', $testimonial),
    ];
};

if ($item) {
    $item = $fill_testimonial_data($item);
}
if ($items) {
    $items = array_map($fill_testimonial_data, $items);
}

$has_inner_container = in_array($layout, ['1', '3']);
?>
<section data-type="testimonials" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] relative overflow-hidden">
    @if (!$has_inner_container)
    <div class="container">
        @endif
        @if ($has_heading)
        <div class="{{ $has_inner_container ? 'container' : '' }} text-center mb-4 lg:mb-8">
            @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40])
        </div>
        @endif
        @if ($layout === '1')
        <div class="container-outer bg-dark-grey text-white py-[30px] md:py-[50px] lg:py-[80px] overflow-hidden">
            <div class="container">
                <div class="absolute top-[-40px] md:top-[40px] left-[25px]">
                    @include('icons.quote-background')
                </div>
                <div class="md:flex relative" data-aos=child_appear data-aos-once=true>
                    <div class="w-[120px] relative md:top-[10px] mb-6 md:mb-0">
                        @include('icons.quote-alt')
                    </div>
                    <div class="flex-1">
                        @include('flexible.testimonials.item', $item)
                    </div>
                </div>
            </div>
        </div>
        @elseif ($layout === '2')
        <div class="text-center max-w-[1040px] mx-auto">
            @include('flexible.testimonials.item', $item)
        </div>
        @elseif (in_array($layout, ['3']))
        <div class="swiper swiper-visible-sides text-center relative" data-aos=appear data-aos-once=true>
            <ul class="swiper-wrapper pb-[35px] md:pb-[50px]">
                @foreach ($items as $item)
                <li class="swiper-slide max-w-[900px]">
                    <div class="container">
                        @include('flexible.testimonials.item', [
                        'name' => $item['name'],
                        'subtitle' => $item['subtitle'],
                        'quote' => $item['quote'],
                        'heading_size' => 16,
                        ])
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="swiper-pagination absolute bottom-0 z-10 left-0 right-0"></div>
        </div>
        @elseif (in_array($layout, ['4', '5']))
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 text-center gap-y-12 gap-6 {{ $layout === '4' ? 'lg:gap-12' : 'pt-[30px]' }}"
            data-aos=child_appear data-aos-once=true>
            @foreach ($items as $item)
            <li>
                @include('flexible.testimonials.item', $item)
            </li>
            @endforeach
        </ul>
        @elseif (in_array($layout, ['6']))
        <div class="swiper swiper-standard text-center relative" data-aos=appear data-aos-once=true>
            <ul class="swiper-wrapper pt-[35px] pb-[15px]">
                @foreach ($items as $item)
                <li class="swiper-slide">
                    <div class="px-[25px] md:px-[80px] xl:px-[140px]">
                        @include('flexible.testimonials.item', $item)
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="swiper-pagination absolute bottom-[35px] lg:bottom-[50px] z-10 left-0 right-0"></div>

            <div
                class="swiper-button-prev scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] left-[-10px] md:left-0">
                @include('icons.slider-arrow-left')
            </div>
            <div
                class="swiper-button-next scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] right-[-10px] md:right-0">
                @include('icons.slider-arrow-right')
            </div>
        </div>
        @elseif (in_array($layout, ['7']))
        <div class="md:flex items-center text-center {{ $video_options['flip_layout'] ? 'md:flex-row-reverse' : '' }}">
            <div class="flex-1 {{ $video_options['flip_layout'] ? 'md:ml-20' : 'md:mr-20' }}">
                <div class="relative" style="padding-bottom: 58%;">
                    <div class="cover-image-child">
                        @img($video_options['image']['ID'])
                    </div>
                    <a href="{{ $video_options['video_modal'] }}"
                        class="glightbox absolute top-0 bottom-0 left-0 right-0 block group hover:video-button">
                        <div
                            class="absolute top-0 left-0 right-0 bottom-0 bg-[#186FE0] opacity-50 group-hover:opacity-30 duration-500 transition-color">
                        </div>
                        <div class="absolute top-[50%] left-[50%] ml-[-47.5px] mt-[-47.5px]">
                            @include('icons.play-button-testimonial')
                        </div>
                    </a>
                </div>
            </div>
            <div class="mt-8 md:mt-6 md:w-[380px]">
                @include('flexible.testimonials.item', $item)
            </div>
        </div>
        @endif
        @if (!$has_inner_container)
        <div class="container">
            @endif
</section>