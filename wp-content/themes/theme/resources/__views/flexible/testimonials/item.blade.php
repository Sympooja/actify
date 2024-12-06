<?php
if ($heading_size === false) {
    $heading_size = 26;
}
$body_size = '14-tight';
$weight = 300;
$name_on_separate_line = $layout !== '1';
$restricted_width_name = in_array($layout, ['4', '5', '6', '7']);
$box_classes = '';
$heading_classes = '';
switch ($layout) {
    case '3':
        $heading_classes = 'max-w-[760px] mx-auto';
        break;
    case '4':
        $heading_size = 18;
        $weight = 400;
        break;
    case '5':
        $box_classes = 'px-[20px] pb-[20px] lg:px-[38px] lg:pb-[40px] shadow-default';
        $heading_size = 16;
        $weight = 400;
        break;
    case '6':
        $box_classes = 'px-[20px] pb-[60px] lg:px-[38px] lg:pb-[90px] shadow-default';
        $heading_size = 18;
        $body_size = 16;
        $weight = 400;
        $heading_classes = 'max-w-[630px] mx-auto';
        break;
    case '7':
        $box_classes = 'px-[20px] pb-[20px] lg:px-[38px] lg:pb-[40px] shadow-default';
        $heading_size = 16;
        $body_size = 16;
        $weight = 400;
        break;
}
?>
<div class="{{ $box_classes }} space-y-6">
    @if ($layout === '2')
        <div class="inline-block-child">
            @include('icons.quote-with-circle')
        </div>
    @elseif (in_array($layout, ['3', '4']))
        <div class="inline-block-child">
            @include('icons.quote')
        </div>
    @elseif (in_array($layout, ['5', '6', '7']))
        <div
            class="inline-block-child relative top-[-31px] mb-[-50px] md:top-[-31px] md:mb-[-31px] scale-[0.6] md:scale-[1]">
            @include('icons.quote-with-circle-alt')
        </div>
    @endif
    <div class="{{ $heading_classes }}">
        @include('elements.text', [
            'text' => $quote,
            'type' => 'h3',
            'size' => $heading_size,
            'weight' => $weight,
        ])
    </div>
    <div class="{{ $restricted_width_name ? 'max-w-[250px] mx-auto' : '' }}">
        @include('elements.text', [
            'text' =>
                "<strong class='" .
                ($name_on_separate_line ? 'block' : '') .
                "'>" .
                $name .
                ($subtitle ? ', ' : '') .
                '</strong>' .
                $subtitle,
            'type' => 'wysiwyg',
            'size' => $body_size,
            'weight' => 400,
        ])
    </div>
</div>
