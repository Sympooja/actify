<div class="container">
    @if ($layout === 'cards')
        <section data-type="logos" class="py-[12px] md:py-[30px] relative overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach ($items_cards as $key => $item)
                    <span class="flex flex-col w-full md:max-w-[200px] gap-4 bg-[#F2F2F2] py-8 px-6">
                        @img($item['icon']['ID'], 'large max-w-[100%] max-h-[100%] my-auto object-contain')
                        <p class="text-[22px]">{{ $item['heading'] }}</p>
                        <p class="text-[14px] text-[#233741]">{{ $item['text'] }}</p>
                    </span>
                @endforeach
            </div>
        </section>
    @else
        <section data-type="logos"
            class="py-[12px] md:py-[30px] relative border-b border-t border-light-gray overflow-hidden">
            <div class="swiper swiper-logos">
                <div class="swiper-wrapper flex-wrap lg:flex-nowrap justify-between">
                    @foreach ($items as $key => $item)
                        <span class="flex items-center max-w-[200px] gap-4">
                            @img($item['icon']['ID'], 'large max-w-[100%] max-h-[100%] mx-auto my-auto object-contain')
                            <p class="text-[22px]">{{ $item['text'] }}</p>
                        </span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
