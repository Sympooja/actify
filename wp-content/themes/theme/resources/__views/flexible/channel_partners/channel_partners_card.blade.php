<?php
$map_position_x = $show_region_map === true ? $item['region_map_position']['map_position_x'] : $item['map_position_x'];
$map_position_y = $show_region_map === true ? $item['region_map_position']['map_position_y'] : $item['map_position_y'];
?>

<div class="group absolute cursor-pointer" style="top: {{ $map_position_x }}%; left: {{ $map_position_y }}%;">
    <div class="relative">
        <div data-aos="fade-in" data-aos-once=true class="w-2.5 h-2.5 rounded-full {{ $colours[$i % count($colours)] }}">
        </div>
        <div
            class="hover-card hover-card-button cursor-pointer pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition-opacity absolute bottom-[-100%] left-[50%] translate-x-[-50%] translate-y-[-25px] w-[300px] bg-white shadow z-[1] rounded">

            <div class="w-full h-1 {{ $colours[$i % count($colours)] }}"></div>
            <div class="flex items-center px-4 py-2 hover:bg-[#F8FAFC] transition-all duration-300">
                <div class="max-w-[60px]">
                    <div
                        class="flex items-center justify-center w-16 h-16 rounded-full {{ $colours[$i % count($colours)] }}">
                        @img($item['icon']['ID'])
                    </div>
                </div>
                <div class="flex-1 pl-4">
                    @include('elements.text', [
                        'text' => $item['heading'],
                        'type' => 'h5',
                        'size' => 16,
                    ])
                    @include('elements.text', [
                        'text' => $item['location'],
                        'type' => 'p',
                        'size' => 12,
                    ])
                    <div class="extra-info">
                        <div class="py-2">
                            <div>

                                @include('elements.text', [
                                    'text' => $item['telephone'],
                                    'type' => 'p',
                                    'size' => 12,
                                ])
                                @include('elements.text', [
                                    'text' => $item['email'],
                                    'type' => 'p',
                                    'size' => 12,
                                ])
                            </div>
                            @if ($item['website'])
                                <a class="link hover:icon-shift-right text-[13px] md:text-[12px] tracking-[-0.0135em] font-medium inline-block text-blue hover:text-darkest-blue"
                                    href="{{ $item['website'] }}" target="_blank">
                                    {{ __('Visit Website', THEME_TEXTDOMAIN) }}
                                    <span class="animated-icon inline-block ml-2 relative top-[1px]">
                                        @include('icons.arrow-right')
                                    </span>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
