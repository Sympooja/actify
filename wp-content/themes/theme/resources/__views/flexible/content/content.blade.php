<?php
$text_alignment = $text_alignment ?: 'center';
$two_column_items = $layout !== '1';
$image_on_top = in_array($layout, ['5']);
if (!isset($flip_columns)) {
    $flip_columns = false;
}
$flip_columns = in_array($layout, ['6', '3']) ? !$flip_columns : $flip_columns;
$items_in_cols = in_array($layout, ['3', '5']);
$has_section_heading = $layout === '5';
$items_have_containers = $layout === '6';
$item_animation_properties = $items_in_cols ? '' : 'data-aos=mixed_appear data-aos-once=true';
$image_size_classes = '';
switch ($layout) {
    case '2':
        $image_size_classes = 'md:w-[40%] lg:w-[26.5%]';
        break;
    case '4':
        $image_size_classes = 'md:w-[40%] lg:w-[58%]';
        break;
    case '7':
        $image_size_classes = 'md:w-[40%] lg:w-[50%]';
        break;
}
$has_space_between_items = in_array($layout, ['1', '2', '4', '7']);

?>

<section data-type="content" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] relative">

    @if (!$items_have_containers)
        <div class="container relative {{ $has_space_between_items ? 'space-y-[40px] lg:space-y-[85px]' : '' }}">
    @endif

    @if ($section_heading && $has_section_heading)
        <div class="text-center mb-12" data-aos=appear data-aos-once=true>
            @include('elements.text', ['text' => $section_heading, 'type' => 'h2', 'size' => 40])
        </div>
    @endif

    @if ($items_in_cols)
        <div class="grid gap-6 gap-y-12 {{ $layout === '3' ? 'lg:grid-cols-2' : 'md:grid-cols-2 lg:grid-cols-3' }}"
            data-aos=child_appear data-aos-once=true>
    @endif

    @foreach ($items as $key => $item)
        <?php
        
        // Pass layout name to content
        $item['content']['layout'] = $layout;
        
        // Alternate columns if not layout 3
        $flip_columns = $layout === '3' ? $flip_columns : !$flip_columns;
        ?>

        @if ($items_have_containers)
            <div class="container-outer bg-grey overflow-hidden text-white relative" {{ $item_animation_properties }}>
                @if ($item['media']['image'])
                    <div
                        class="absolute image-background top-0 bottom-0 left-0 right-0 cover-image-child {{ $flip_columns ? 'img-gradient-grey-left' : 'img-gradient-grey-right' }}">
                        @img($item['media']['image']['ID'], 'large')
                    </div>
                @endif
                <div class="container relative">
        @endif

        @if ($two_column_items)

            <div class="space-y-6 {{ !$image_on_top ? 'md:space-y-0 md:flex items-center' : 'md:space-y-10' }} {{ $flip_columns ? '' : 'flex-row-reverse' }}"
                {{ !$items_have_containers ? $item_animation_properties : '' }}>
                <div class="{{ $image_size_classes ? $image_size_classes : 'flex-1' }}">
                    @if (!$items_have_containers && $item['media']['video_looping'])
                        <video width="100%" height="auto" autoplay loop muted>
                            <source src="{{ $item['media']['video_looping']['url'] }}" type="video/mp4" />
                        </video>
                    @elseif (!$items_have_containers && $item['media']['image'])
                        <div class="image">
                            @if ($item['media']['video_embed'])
                                <a href="{{ $item['media']['video_embed'] }}"
                                    class="glightbox relative block hover:video-button">
                                    @img($item['media']['image']['ID'], 'large')
                                    <div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
                                        @include('icons.play-button-small')
                                    </div>
                                </a>
                            @else
                                @img($item['media']['image']['ID'], 'large')
                            @endif
                        </div>
                    @endif
                </div>
                <div class="flex-1 flex">
                    <div
                        class="{{ $flip_columns && $layout === '6' ? 'ml-auto' : '' }} {{ ($flip_columns && $layout !== '6' ? 'lg:ml-auto' : '' || ($flip_columns && $layout === '5')) ? '' : '' }}">
                        @include('flexible.content.copy', $item['content'])
                    </div>
                </div>
            </div>
        @else
            <div>
                @if ($item['media']['type'] === 'nomedia')
                @else
                    @if ($item['media']['video_looping'])
                        <div class="mb-8 md:mb-12">
                            <video width="100%" height="auto" autoplay loop muted>
                                <source src="{{ $item['media']['video_looping']['url'] }}" type="video/mp4" />
                            </video>
                        </div>
                    @elseif ($item['media']['image'])
                        <div class="mb-8 md:mb-12">
                            <div class="w-full aspect-16-6 relative">
                                @if ($item['media']['video_embed'])
                                    <a href="{{ $item['media']['video_embed'] }}"
                                        class="glightbox relative block hover:video-button w-full h-full object-cover">
                                        @img($item['media']['image']['ID'], 'large w-full h-full object-cover')
                                        <div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
                                            @include('icons.play-button-small')
                                        </div>
                                    </a>
                                @else
                                    @img($item['media']['image']['ID'], 'large w-full h-full object-cover')
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
                <div class="relative lg:py-4 @if ($item['no_max_width']) @else max-w-[750px] @endif @if ($text_alignment === 'left') text-left @else text-center mx-auto @endif @if ($item['item_position'] === 'center') mx-auto @else ml-0 @endif"
                    {{ $item_animation_properties }}>
                    @include('flexible.content.copy', $item['content'])
                </div>
            </div>
        @endif

        @if ($items_have_containers)
            </div>
            </div>
        @endif

    @endforeach

    @if ($items_in_cols)
        </div>
    @endif

    @if (!$items_have_containers)
        </div>
    @endif

</section>
