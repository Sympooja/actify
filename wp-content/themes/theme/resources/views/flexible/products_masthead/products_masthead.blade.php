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
if ($slides) {
    foreach ($slides as $slide) {
        array_push($slide_headings, $slide['slide_heading']);
    }
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.0.5/swiper-bundle.min.js"
    integrity="sha512-cEcJcdNCHLm3YSMAwsI/NeHFqfgNQvO0C27zkPuYZbYjhKlS9+kqO5hZ9YltQ4GaTDpePDQ2SrEk8gHUVaqxig=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<section data-type="products_masthead" data-layout="{{ $layout }}" data-aos=mixed_appear data-aos-once=true>
    <div class="py-8 lg:px-14 px-2">
        <div class="{{ $container_background_color }} py-8 lg:py-20 rounded-[18px]">
            <div class="container">
                @if ($slides)
                    <div class="swiper swiper-product-masthead relative">
                        <div class="swiper-wrapper !h-auto md:mb-6">
                            @foreach ($slides as $slideKey => $slide)
                                <div class="swiper-slide" data-hash="{{ str_replace(' ', '', $slide['slide_heading']) }}">
                                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-y-12 lg:gap-y-0">
                                        <div class="col-span-2 lg:max-w-md flex h-full items-center overflow-hidden">
                                            <div class="fade-in-from-left">
                                                <div class="space-y-8">
                                                    @include('elements.text', [
                                                        'text' => $slide['heading'],
                                                        'type' => 'h1',
                                                        'size' => 40,
                                                    ])
                                                    @include('elements.text', [
                                                        'text' => $slide['content'],
                                                        'type' => 'div',
                                                        'size' => 18,
                                                    ])
                                                    @if ($slide['links'])
                                                        <div class="flex gap-x-6 gap-y-4 items-center">
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

                                        <div class="col-span-3">
                                            @if ($slide['tabs'])
                                                <?php
                                                $tab_headings = [];
                                                if ($slide['tabs']) {
                                                    foreach ($slide['tabs'] as $tab) {
                                                        array_push($tab_headings, $tab['heading']);
                                                    }
                                                }
                                                ?>
                                                <div class="swiper-outer-container relative">
                                                    <button class="previous-arrow"
                                                        onmousedown="scrollSliderLeft('swiper-tab-masthead-{{ $slideKey }}')"
                                                        onmouseup="stopSliderScroll()"></button>
                                                    <div id="swiper-tab-masthead-{{ $slideKey }}"
                                                        class="swiper-pagination swiper-product-pagination-container swiper-tab-masthead-{{ $slideKey }}">
                                                    </div>
                                                    <button class="next-arrow"
                                                        onmousedown="scrollSliderRight('swiper-tab-masthead-{{ $slideKey }}')"
                                                        onmouseup="stopSliderScroll()"></button>
                                                </div>
                                                <div
                                                    class="swiper swiper-home-tab-masthead-{{ $slideKey }} relative">
                                                    <div class="swiper-wrapper !h-auto">

                                                        @foreach ($slide['tabs'] as $key => $tab)
                                                            <div class="swiper-slide"
                                                                data-hash="{{ str_replace(' ', '', $tab['heading']) }}">
                                                                <div
                                                                    class="max-w-lg m-auto text-center mb-7 min-h-[75px] space-y-1">
                                                                    @include('elements.text', [
                                                                        'text' => $tab['content'],
                                                                        'type' => 'h2',
                                                                        'size' => 20,
                                                                        'weight' => 500,
                                                                    ])
                                                                </div>
                                                                @if ($tab['type'] === 'image')
                                                                    @img($tab['image']['ID'], ' max-h-[400px] object-fill h-auto lg:h-full')
                                                                @endif
                                                                @if ($tab['type'] === 'video')
                                                                    <div>

                                                                        <video width="100%" height="auto" loop muted
                                                                            class="video h-auto lg:h-[400px] w-full object-fill">
                                                                            <source src="{{ $tab['video']['url'] }}"
                                                                                type="video/mp4" />
                                                                        </video>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <script>
                                                    var menu = <?php echo json_encode($tab_headings); ?>;
                                                    new Swiper(".swiper-home-tab-masthead-<?php echo $slideKey; ?>", {
                                                        loop: true,
                                                        effect: 'fade',
                                                        fadeEffect: {
                                                            crossFade: true
                                                        },
                                                        hashNavigation: {
                                                            replaceState: true,

                                                        },
                                                        pagination: {
                                                            el: ".swiper-tab-masthead-<?php echo $slideKey; ?>",
                                                            clickable: true,
                                                            renderBullet: function(index, className) {
                                                                return '<span class="' + className + ' slider-pagination whitespace-nowrap">' + menu[
                                                                    index] + "</span>";
                                                            },
                                                        },
                                                        on: {
                                                            init: function() {
                                                                var activeIndex = this.activeIndex;
                                                                var activeSlide = document.querySelectorAll(
                                                                    '.swiper-home-tab-masthead-<?php echo $slideKey; ?> .swiper-slide')[activeIndex];
                                                                var activeSlideVideo = activeSlide.getElementsByTagName('video')[0];
                                                                if (activeSlideVideo) {
                                                                    activeSlideVideo.play();
                                                                }
                                                            },
                                                            transitionStart: function() {
                                                                var videos = document.querySelectorAll('video');
                                                                Array.prototype.forEach.call(videos, function(video) {
                                                                    video.currentTime = 0;
                                                                    video.pause();
                                                                });
                                                            },

                                                            transitionEnd: function() {
                                                                var activeIndex = this.activeIndex;
                                                                var activeSlide = document.querySelectorAll(
                                                                    '.swiper-home-tab-masthead-<?php echo $slideKey; ?> .swiper-slide')[activeIndex];
                                                                var activeSlideVideo = activeSlide.getElementsByTagName('video')[0];
                                                                if (activeSlideVideo) {
                                                                    activeSlideVideo.play();
                                                                }
                                                            },

                                                        }
                                                    });
                                                </script>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-5">
                            <div class="col-span-2"></div>
                            <div class="col-span-3">
                                <div class="swiper-title-container">
                                    <div class="swiper-pagination swiper-masthead"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>




<script>
    var menu2 = <?php echo json_encode($slide_headings); ?>;
    new Swiper(".swiper-product-masthead", {
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        hashNavigation: {
            replaceState: true,
        },
        pagination: {
            el: ".swiper-masthead",
            clickable: true,
            renderBullet: function(index, className) {
                return '<span class="' + className + ' slider-pagination whitespace-nowrap">' + menu2[
                    index] + "</span>";
            },
        },
        on: {
            transitionStart: function() {

                var videos = document.querySelectorAll('video');

                Array.prototype.forEach.call(videos, function(video) {
                    video.currentTime = 0;
                    video.pause();
                });
            },

            transitionEnd: function() {

                var activeIndex = this.activeIndex;
                var activeSlide = document.querySelectorAll(
                    `.swiper-home-tab-masthead-${activeIndex} .swiper-slide`)[0];
                var activeSlideVideo = activeSlide.getElementsByTagName('video')[0];
                if (activeSlideVideo) {
                    activeSlideVideo.play();
                }
            },

        }
    });



    function getSliderTitlesWidth() {
        document.querySelectorAll('.swiper-product-pagination-container').forEach(function(slider) {
            if (slider.scrollWidth > slider.clientWidth) {
                slider.parentElement.classList.add("swiper-overflowing")
            } else {
                if (slider.parentElement.classList.contains("swiper-overflowing")) {
                    slider.parentElement.classList.remove("swiper-overflowing");
                }
            }
        });
    }
    setTimeout(() => {
        getSliderTitlesWidth();
    }, 200);

    var myInterval;

    function scrollSliderLeft(className) {
        myInterval = setInterval(() => {
            document.getElementById(className).scrollLeft -= 5;
        }, 10);
    }

    function scrollSliderRight(className) {
        myInterval = setInterval(() => {
            document.getElementById(className).scrollLeft += 5;
        }, 10);
    }

    function stopSliderScroll() {
        clearInterval(myInterval);
    }
</script>

<style>
    .swiper-product-masthead .swiper-outer-container .swiper-slide,
    .swiper-product-masthead .swiper-title-container .swiper-slide {
        height: auto;
    }

    .swiper-pagination.swiper-masthead {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px 0px;
    }

    .swiper-product-masthead .swiper-outer-container .slider-pagination {
        display: block;
        list-style: none;
        width: auto;
        height: auto;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 500;
        padding: 0px 0px;
    }

    .swiper-product-masthead .swiper-outer-container .slider-pagination::before,
    .swiper-product-masthead .swiper-outer-container .slider-pagination::after {
        content: unset;
    }

    .swiper-product-masthead .swiper-outer-container .slider-pagination:after {
        content: '';
        width: 0px;
        margin-left: 10%;
        height: 2px;
        background: linear-gradient(to right, #233741 50%, #48A2A2 50%);
        background-size: 200% 100%;
        background-position: right bottom;
        transition: all 0.4s ease;
        top: unset;
        bottom: -10px;
        border: unset;
        border-radius: 0px;

    }

    .swiper-product-masthead .swiper-outer-container .slider-pagination.swiper-pagination-bullet-active::after {
        width: 80%;
    }

    .swiper-product-masthead .swiper-outer-container .slider-pagination:hover::after {
        background-position: left bottom;
        transition: all 0.3s ease;
    }


    .swiper-product-pagination-container {
        display: flex;
        width: 100%;
        justify-content: center;
        overflow-x: scroll;
        white-space: nowrap;
        gap: 20px;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .swiper-outer-container {
        margin-left: 30px;
        margin-right: 30px;

    }

    .swiper-outer-container.swiper-overflowing .swiper-product-pagination-container {
        justify-content: left;
    }

    .swiper-outer-container .previous-arrow,
    .swiper-outer-container .next-arrow {
        display: none;
    }

    .swiper-outer-container.swiper-overflowing .previous-arrow,
    .swiper-outer-container.swiper-overflowing .next-arrow {
        display: block;
    }

    .swiper-outer-container .previous-arrow {
        background-image: url("<?php echo themosis_theme_assets(); ?>/images/previous-arrow.svg");
        background-repeat: no-repeat;
        background-position: center;
        width: 10px;
        height: 20px;
        position: absolute;
        top: 2px;
        left: -30px;
    }

    .swiper-outer-container .next-arrow {
        background-image: url("<?php echo themosis_theme_assets(); ?>/images/next-arrow.svg");
        background-repeat: no-repeat;
        background-position: center;
        width: 10px;
        height: 20px;
        position: absolute;
        top: 2px;
        right: -30px;
    }

    /* width */
    .swiper-pagination-horizontal {
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
        scrollbar-width: none;
        /* Firefox */
    }

    .swiper-pagination-horizontal::-webkit-scrollbar {
        display: none;
    }

    .swiper-product-masthead .swiper-title-container {
        background: #fff;
        width: fit-content;
        margin: auto;
        border-radius: 34px;
        padding: 6.5px 8px;
    }

    .swiper-product-masthead .swiper-title-container .slider-pagination {
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


    .swiper-product-masthead .swiper-title-container .slider-pagination::before,
    .swiper-product-masthead .swiper-title-container .slider-pagination::after {
        content: unset;
    }

    .swiper-product-masthead .swiper-title-container .slider-pagination.swiper-pagination-bullet-active {
        background-color: #2F7EA1;
        color: #fff;
        font-weight: 600;
        border-radius: 48px;
    }

    @media screen and (min-width:768px) {

        .swiper-product-masthead .swiper-outer-container .slider-pagination {
            font-size: 14px;
            padding: 0px 15px;
        }

        .swiper-product-masthead .swiper-title-container .slider-pagination {
            font-size: 14px;
        }

        .slider-pagination.swiper-masthead {
            gap: 25px 0px;
        }

        .swiper-product-masthead .swiper-title-container {
            border-radius: 54px;
        }

        .swiper-product-masthead .swiper-title-container .slider-pagination {
            width: auto;
        }
    }
</style>
