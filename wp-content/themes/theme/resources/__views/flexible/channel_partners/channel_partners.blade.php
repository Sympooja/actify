@php $colours = array("bg-[#FB9555]","bg-[#F56D65]","bg-[#186FE0]","bg-[#6B18E0]") @endphp

<section data-type="partners-map">
    <div class="container">
        <div class="map-tabs hidden md:flex justify-between gap-4 relative z-[1]">
            <div class="tab rounded w-[25%] text-center py-3 cursor-pointer hover:bg-blue hover:text-white duration-300 transition-all active"
                style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.12);" id="el1" data-tab="el1">
                @include('elements.text', [
                    'text' => 'All Regions',
                    'type' => 'h3',
                    'size' => 18,
                    'weight' => 400,
                ])
            </div>
            @foreach ($regions as $region)
                <div class="tab rounded w-[25%] text-center py-3 cursor-pointer hover:bg-blue hover:text-white duration-300 transition-all"
                    style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.12);"
                    id="el-{{ str_replace(' ', '', $region['heading']) }}"
                    data-tab="el-{{ str_replace(' ', '', $region['heading']) }}">
                    @include('elements.text', [
                        'text' => $region['heading'],
                        'type' => 'h3',
                        'size' => 18,
                        'weight' => 400,
                    ])
                </div>
            @endforeach
        </div>
        <div class="map-container hidden md:block relative content z-[0] el1 active">
            @if ($map)
                @img($map['ID'])
            @endif
            @foreach ($regions as $region)
                @foreach ($region['items'] as $i => $item)
                    @if ($item['map_position_x'] && $item['map_position_y'])
                        @include('flexible.channel_partners.channel_partners_card', $item)
                    @endif
                @endforeach
            @endforeach
        </div>
        @foreach ($regions as $region)
            <div class="map-container hidden md:block relative max-h-[463px] lg:max-h-[790px] z-[0] content el-{{ str_replace(' ', '', $region['heading']) }}"
                style="overflow:hidden;">

                @if ($region['map'])
                    <img src="{{ $region['map']['url'] }}"
                        class="h-[463px] lg:h-[790px] w-full object-cover object-bottom" />
                @endif
                @foreach ($region['items'] as $i => $item)
                    @if ($item['region_map_position']['map_position_x'] && $item['region_map_position']['map_position_y'])
                        @include('flexible.channel_partners.channel_partners_card', [
                            'item' => $item,
                            'show_region_map' => true,
                        ])
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

</section>
<section data-type="partners" class="bg-[#F7F8FB] md:mb-[-105px]">
    <div class="container-narrow mx-auto py-8 md:py-12">
        @if ($heading)
            <div class="max-w-[750px] mx-auto text-center space-y-4 mb-[30px] lg:mb-[50px]">
                <div class="w-full">
                    @include('elements.text', [
                        'text' => $heading,
                        'type' => 'h2',
                        'size' => 40,
                        'weight' => 400,
                    ])
                </div>
                @if ($content)
                    <div class="w-full">
                        @include('elements.text', ['text' => $content, 'type' => 'wysiwyg', 'size' => 16])
                    </div>
                @endif
            </div>
        @endif

        @foreach ($regions as $region)
            <div class="my-[30px] pt-[30px] lg:my-[50px] lg:pt-[50px] border-t border-light-gray" data-aos=appear
                data-aos-once=true>

                <ul class="select-none" data-aos=child_appear data-aos-once=true accordion>
                    <li accordion-item>
                        <div class="flex hover:text-blue transition" accordion-toggle>
                            <div class="flex-1 pr-4">
                                @include('elements.text', [
                                    'text' => $region['heading'],
                                    'type' => 'h3',
                                    'size' => 32,
                                    'weight' => 400,
                                ])
                            </div>
                            <div class="inline-block-child text-right w-[27px] relative md:top-[2px]">
                                @include('icons.chevron-right')
                            </div>
                        </div>
                        <div accordion-content class="mt-12">

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($region['items'] as $i => $item)
                                    <div class="bg-white p-9 rounded-xl h-full"
                                        style="box-shadow: 0px 4px 11px rgba(35, 55, 65, 0.08);">
                                        <div
                                            class="flex items-center justify-center w-20 h-20 rounded-full {{ $colours[$i % count($colours)] }}">
                                            @img($item['icon']['ID'])
                                        </div>
                                        <div class="space-y-3 mt-6">
                                            @include('elements.text', [
                                                'text' => $item['heading'],
                                                'type' => 'h5',
                                                'size' => 22,
                                            ])
                                            <div>
                                                @include('elements.text', [
                                                    'text' => $item['location'],
                                                    'type' => 'p',
                                                    'size' => 14,
                                                ])
                                                @include('elements.text', [
                                                    'text' => $item['telephone'],
                                                    'type' => 'p',
                                                    'size' => 14,
                                                ])
                                                @include('elements.text', [
                                                    'text' => $item['email'],
                                                    'type' => 'p',
                                                    'size' => 14,
                                                ])
                                            </div>
                                            @if ($item['website'])
                                                <a class="link hover:icon-shift-right text-[13px] md:text-[14px] tracking-[-0.0135em] font-medium inline-block text-blue hover:text-darkest-blue"
                                                    href="{{ $item['website'] }}" target="_blank">
                                                    {{ __('Visit Website', THEME_TEXTDOMAIN) }}
                                                    <span class="animated-icon inline-block ml-2 relative top-[1px]">
                                                        @include('icons.arrow-right')
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
</section>

<script>
    console.log("loads")
    var el = document.querySelectorAll('.hover-card-button');

    console.log(el)

    el.forEach((userItem) => {
        userItem.onclick = function() {
            console.log("click")
            userItem.classList.toggle('show-information');
        }
    })
</script>



<style>
    .tab.active {
        color: #fff;
        background-color: #186FE0;
    }

    .map-container.content {
        display: none
    }

    .map-container.content.active {
        display: block
    }

    @media screen and (max-width:767px) {
        .map-container.content.active {
            display: none;
        }
    }

    .hover-card::after {
        content: '';
        position: absolute;
        bottom: -20px;
        width: 40%;
        left: 30%;
        height: 20px;
    }

    .extra-info {
        max-height: 0px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .hover-card-button.show-information .extra-info {
        max-height: 300px;
        transition: all 0.3s ease-in-out;
    }
</style>
