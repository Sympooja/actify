<?php
$max_width = '';
$padding = '';
$heading_size = 32;
$body_size = 14;
switch ($layout) {
    case '1':
        $heading_size = 40;
        $body_size = 16;
        break;
    case '2':
        $max_width = 'max-w-[840px]';
        $padding = 'md:py-[35px] md:px-[45px]';
        break;
    case '3':
        $heading_size = 22;
        $padding = 'md:py-[15px] md:pl-[30px]';
        break;
    case '4':
        $max_width = 'max-w-[465px]';
        $padding = 'md:py-[60px] md:px-[35px]';
        break;
    case '5':
        $heading_size = 22;
        break;
    case '6':
        $max_width = 'max-w-[390px]';
        $padding = 'py-[40px] md:py-[140px] lg:py-[225px]';
        break;
    case '7':
        $max_width = 'max-w-[580px]';
        $padding = 'md:py-[60px] md:px-[35px]';
        $heading_size = 48;
        $body_size = 16;
        break;
    case 'content_dark':
        $max_width = 'max-w-[552px]';
        $padding = 'md:py-[20px]';
        break;
}
$element_spacing = $layout === '5' ? 'space-y-2' : 'space-y-4';
?>
<div class="{{ $padding }} {{ $element_spacing }} {{ $max_width }}">
    @if ($subtitle)
    <div class="mb-[-6px] text-blue">
        @include('elements.text', ['text' => $subtitle, 'type' => 'h6', 'size' => 14, 'weight' => 500])
    </div>
    @endif
    @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => $heading_size])
    @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => $body_size])
    @if ($layout === '7')
    @include('flexible.content.extra', ['subheading' => $subheading, 'subtext' => $subtext])
    @endif
    @if ($link)
    <div class="link-container pt-1">
        @include('elements.link', ['link' => $link, 'show_arrow' => true])
    </div>
    @endif
</div>