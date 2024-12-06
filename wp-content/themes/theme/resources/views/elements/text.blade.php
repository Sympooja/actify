<?php

if (!$text) {
    return;
}

// Add helper classes to elements
if (!isset($type)) {
    $type = 'div';
}
$is_wysiwyg = false;
$is_heading = false;
if ($type === 'wysiwyg') {
    $is_wysiwyg = true;
    $type = 'div';
    $classes[] = 'wysiwyg prose';
} else {
    $is_heading = true;
    $classes[] = 'heading';
}

// Defaults
if (!isset($classes)) {
    $classes = [''];
}
if (!isset($size)) {
    $size = $is_wysiwyg ? 14 : 32;
}
if (!isset($weight)) {
    $weight = $is_wysiwyg ? 300 : 400;
}
if (!isset($color)) {
    $color = false;
}

// Size
switch ($size) {
    case 64:
        $classes[] = 'text-[48px] md:text-[56px] lg:text-[64px] leading-[1.06em] tracking-[-0.038em]';
        break;
    case 61:
        $classes[] = 'text-[39px] md:text-[54px] lg:text-[61px] leading-[1.06em] tracking-[-0.038em] w-full break-words';
        break;
    case 48:
        $classes[] = 'text-[32px] md:text-[40px] lg:text-[48px] leading-[1.15em] tracking-[-0.038em]';
        break;
    case 40:
        $classes[] = 'text-[32px] md:text-[40px] leading-[1.15em] tracking-[-0.038em]';
        break;
    case 36:
        $classes[] = 'text-[24px] md:text-[36px] leading-[1.3em] tracking-[-0.038em]';
        break;
    case 32:
        $classes[] = 'text-[24px] md:text-[32px] leading-[1.3em] tracking-[-0.015em]';
        break;
    case 26:
        $classes[] = 'text-[20px] md:text-[26px] leading-[1.55em] tracking-[-0.03em]';
        break;
    case 22:
        $classes[] = 'text-[18px] md:text-[22px] leading-[1.36em] tracking-[-0.02em]';
        break;
    case 20:
        $classes[] = 'text-[20px] leading-[1.36em] tracking-[-0.02em]';
    case 18:
        $classes[] = 'text-[14px] md:text-[18px] leading-[1.5em] tracking-[-0.01325em]';
        break;
    case 16:
        $classes[] = 'text-[14px] md:text-[16px] leading-[1.625em] tracking-[-0.01325em]';
        break;
    case '14':
        $classes[] = 'text-[13px] md:text-[14px] leading-[1.725em] tracking-[-0.032em]';
        break;
    case '14-tight':
        $classes[] = 'text-[13px] md:text-[14px] leading-[1.45em] tracking-[-0.032em]';
        break;
    case '12':
        $classes[] = 'text-[12px] md:text-[12px] leading-[1.5em] tracking-[-0.032em]';
        break;
    case '10':
        $classes[] = 'text-[14px] md:text-[16px] leading-[1.625em] tracking-[-0.63px]';
        break;
}

// Weight
switch ($weight) {
    case 300:
        $classes[] = 'font-light';
        break;
    case 400:
        $classes[] = 'font-normal';
        break;
    case 500:
        $classes[] = 'font-medium';
        break;
    case 600:
        $classes[] = 'font-semibold';
        break;
}

// Color
if ($color) {
    $classes[] = 'text-' . $color;
}

?>
<{{ $type }} class="{{ implode(' ', $classes) }}">{!! $text !!}</{{ $type }}>
