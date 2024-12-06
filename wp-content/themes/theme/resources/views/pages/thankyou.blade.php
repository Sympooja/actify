@extends('layouts.default')

@include('components.category.category-tag')

@section('content')
<?php
    if (!session_id()) {
        session_start();
    }
?>
<div class="container flex justify-center">
    <article class="content" style="max-width: 750px;">
        <div class="wysiwyg prose text-[14px] md:text-[18px] leading-[1.5em] tracking-[-0.01325em] font-light">
            {!! the_content() !!}
            <p style="text-align: center;">
                <strong>
                    {!! get_field('seat_id_label') ? esc_html(get_field('seat_id_label')) : 'Your unique Seat ID is:' !!}
                </strong>
                <span class="seat_id"></span>
            </p>
            <p style="text-align: center; margin-bottom:20px;">
                <strong>
                    {!! get_field('download_link_label') ? esc_html(get_field('download_link_label')) : 'Download SpinFire:' !!}
                </strong>
                @if (get_field('spinfire_download_link') && get_field('spinfire_download_link_text'))
                    <a href="{{ esc_url(get_field('spinfire_download_link')) }}">{{ esc_html(get_field('spinfire_download_link_text')) }}</a>
                @endif
            </p>
        </div>
    </article>
</div>
@endsection
