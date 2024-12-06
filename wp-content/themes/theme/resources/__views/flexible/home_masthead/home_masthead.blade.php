<?php

$container_background_color = '';
switch ($background_color) {
    case 'back-light-grey':
        $container_background_color = 'bg-back-light-grey';
        break;
    case 'back-light-cyan':
        $container_background_color = 'bg-back-light-cyan';
        break;
    case 'back-light-blue':
        $container_background_color = 'bg-back-light-blue';
        break;
    case 'back-light-green':
        $container_background_color = 'bg-back-light-green';
        break;
    case 'back-grey':
        $container_background_color = 'bg-back-grey';
        break;
    case 'back-cyan':
        $container_background_color = 'bg-back-cyan';
        break;
    case 'back-blue':
        $container_background_color = 'bg-back-blue';
        break;
    default:
        $container_background_color = '';
        break;
}

$slide_headings = [];
foreach ($slides as $slide) {
    array_push($slide_headings, $slide['slide_heading']);
}
?>

<section data-type="home_masthead" data-layout="{{ $layout }}" data-aos=mixed_appear data-aos-once=true>
    <div class="{{ $container_background_color }} py-10 md:py-16 lg:pt-28 lg:pb-20">
        <div class="container">
            @if ($slides)
                <div class="swiper swiper-home-masthead relative">
                    <div class="swiper-wrapper !h-auto md:mb-6">
                        @foreach ($slides as $key => $slide)
                            <div class="swiper-slide" data-hash="{{ str_replace(' ', '', $slide['slide_heading']) }}">
                                <div class="grid grid-cols-1 lg:grid-cols-6 gap-y-12 lg:gap-y-0">
                                    <div class="col-span-2 flex h-full items-center overflow-hidden">
                                        <div class="fade-in-from-left">
                                            <div class="space-y-8">
                                                @include('elements.text', [
                                                    'text' => $slide['heading'],
                                                    'type' => 'h1',
                                                    'size' => 61,
                                                ])
                                                @include('elements.text', [
                                                    'text' => $slide['content'],
                                                    'type' => 'div',
                                                    'size' => 18,
                                                ])
                                                @if ($slide['links'])
                                                    <div class="flex flex-col md:flex-row gap-x-6 gap-y-4 items-center">
                                                        @foreach ($slide['links'] as $link)
                                                            @if ($link['type'] === 'button')
                                                                @include('elements.button', [
                                                                    'link' => $link['link'],
                                                                    'color' => 'blue',
                                                                    'size' => 14,
                                                                ])
                                                            @endif
                                                            @if ($link['type'] === 'text')
                                                                @include('elements.link', [
                                                                    'link' => $link['link'],
                                                                    'show_arrow' => true,
                                                                ])
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-4 lg:pl-[50px]">
                                        @if ($slide['content_type'] === 'image')
                                            @img($slide['image']['ID'], ' max-h-[400px] object-cover lg:object-fill h-auto lg:h-full')
                                        @endif
                                        @if ($slide['content_type'] === 'cards')
                                            <div class="flex overflow-x-scroll gap-3 py-4">
                                                @foreach ($slide['cards'] as $card)
                                                    <div
                                                        class="relative flex-shrink-0 md:flex-shrink flex flex-col w-full p-3 pb-9 bg-white hover:bg-gray-50 rounded-lg space-y-5 shadow-lg duration-300 transition-all">
                                                        @if ($card['image'])
                                                            @img($card['image']['ID'], 'small w-full h-full max-h-[193px] object-cover rounded-tr-lg rounded-tl-l rounded-bl-md rounded-br-md')
                                                        @endif
                                                        @if ($card['tag'])
                                                            <div class="">
                                                                <span
                                                                    class="bg-[#82B2C7] text-white uppercase text-[12px] rounded-md py-1 px-3 tracking-[-0.02em] leading-[14px]">
                                                                    {{ $card['tag'] }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <div>

                                                            @include('elements.text', [
                                                                'text' => $card['heading'],
                                                                'type' => 'p',
                                                                'size' => 16,
                                                                'weight' => 300,
                                                            ])

                                                        </div>
                                                        @if ($card['link'] && $card['link']['url'])
                                                            <a href="{{ $card['link']['url'] }}"
                                                                class="absolute inset-0"
                                                                aria-label="Link to {{ $card['heading'] }}"></a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($slide['content_type'] === 'video')
                                            <div>
                                                <video width="100%" height="auto" loop muted
                                                    class="h-auto lg:h-[400px] w-full object-fill">
                                                    <source src="{{ $slide['video']['url'] }}" type="video/mp4" />
                                                </video>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-6">
                        <div class="col-span-2"></div>
                        <div class="col-span-4 lg:pl-[50px]">
                            <div class="swiper-title-container">
                                <div class="swiper-pagination swiper-masthead"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.0.5/swiper-bundle.min.js"
    integrity="sha512-cEcJcdNCHLm3YSMAwsI/NeHFqfgNQvO0C27zkPuYZbYjhKlS9+kqO5hZ9YltQ4GaTDpePDQ2SrEk8gHUVaqxig=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    var menu = <?php echo json_encode($slide_headings); ?>;
    new Swiper(".swiper-home-masthead", {
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        hashNavigation: {
            replaceState: true,
            watchState: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function(index, className) {
                return '<span class="' + className + ' slider-pagination whitespace-nowrap">' + menu[
                    index] + "</span>";
            },
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        on: {
            transitionStart: function() {

                var videos = document.querySelectorAll('video');

                console.log(videos);
                Array.prototype.forEach.call(videos, function(video) {
                    video.currentTime = 0;
                    video.pause();
                });
            },

            transitionEnd: function() {
                var activeIndex = this.activeIndex + 1;
                var activeSlide = document.getElementsByClassName('swiper-slide')[activeIndex];
                var activeSlideVideo = activeSlide.getElementsByTagName('video')[0];
                if (activeSlideVideo) {
                    activeSlideVideo.play();
                }
            },

        }
    });
</script>

<style>
    .swiper-home-masthead .swiper-slide {
        height: auto;
    }

    .swiper-pagination.swiper-masthead {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px 0px;
    }

    .swiper-home-masthead .swiper-title-container {
        background: #fff;
        width: fit-content;
        margin: auto;
        border-radius: 34px;
        padding: 6.5px 8px;
    }

    .swiper-home-masthead .swiper-title-container .slider-pagination {
        display: block;
        list-style: none;
        width: 100%;
        height: auto;
        font-size: 12px;
        text-align: center;
        text-transform: uppercase;
        font-weight: 500;
        padding: 9px 26px;
    }

    @media screen and (min-width:768px) {
        .swiper-home-masthead .swiper-title-container .slider-pagination {
            font-size: 14px;
        }
    }

    .swiper-home-masthead .swiper-title-container .slider-pagination::before,
    .swiper-home-masthead .swiper-title-container .slider-pagination::after {
        content: unset;
    }

    .swiper-home-masthead .swiper-title-container .slider-pagination.swiper-pagination-bullet-active {
        background-color: #2F7EA1;
        color: #fff;
        font-weight: 600;
        border-radius: 48px;
    }

    @media screen and (min-width:768px) {
        .slider-pagination.swiper-masthead {
            gap: 25px 0px;
        }

        .swiper-home-masthead .swiper-title-container {
            border-radius: 54px;
        }

        .swiper-home-masthead .swiper-title-container .slider-pagination {
            width: auto;
        }
    }
</style>
