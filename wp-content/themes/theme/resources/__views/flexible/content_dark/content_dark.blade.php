<?php
$layout = 'content_dark';
$has_space_between_items = true;
$two_column_items = true;
$text_alignment = $text_alignment ?: 'center';
if (!isset($flip_columns)) {
    $flip_columns = false;
}
$item_animation_properties = 'data-aos=mixed_appear data-aos-once=true';
$image_size_classes = 'md:w-[40%] lg:w-[48%]';

?>

<section data-type="content" data-layout="{{ $layout }}"
    class="py-[60px] mb-[-30px] md:mb-[-60px] relative bg-[#232841] text-white">
    <div class="container relative {{ $has_space_between_items ? 'space-y-[40px] lg:space-y-[85px]' : '' }}">
        @foreach ($items as $key => $item)
            <div class="space-y-6 md:space-y-0 md:flex items-center {{ !$flip_columns ? '' : 'flex-row-reverse' }}"
                {{ $item_animation_properties }}>
                <div class="{{ $image_size_classes ? $image_size_classes : 'flex-1' }}">
                    @if ($item['media']['image'])
                        <div class="image">
                            @img($item['media']['image']['ID'], 'large')
                        </div>
                    @endif
                </div>
                <div class="flex-1 flex">
                    <div>
                        @if ($item['content']['show_logos'] && $item['content']['main_logo'])
                            <div class="image">
                                @img($item['content']['main_logo']['ID'], 'large')
                            </div>
                        @endif
                        @include('flexible.content.copy', $item['content'])
                        @if ($item['content']['logos'])
                            <div class="font-medium md:flex items-center gap-8 mt-5">
                                {{ $item['content']['logo_heading'] }}
                                <div class="flex gap-8">
                                    @foreach ($item['content']['logos'] as $item)
                                        <?php
                                        if ($item['link']) {
                                            $tag = 'a';
                                            $url = $item['link']['url'];
                                        } else {
                                            $tag = 'span';
                                            $url = '#';
                                        }
                                        ?>
                                        <{{ $tag }} href="{{ $url }}" class="block text-center">
                                            <span class="inline-block h-[45px] max-w-[100px] flex"
                                                style="max-width: 100px;">
                                                @img($item['logo']['ID'], 'large max-w-[100%] max-h-[100%] mx-auto my-auto object-contain')
                                            </span>
                                            </{{ $tag }}>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
