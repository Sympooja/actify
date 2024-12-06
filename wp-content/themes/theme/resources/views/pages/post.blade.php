<?php

$article = apply_filters('posts_to_array', [get_post()])[0];

$header = $acf['header'];
$sidebar_form = $acf['sidebar_form'];
$flexible_content = $acf['flexible_content'];
$additional_content = $acf['additional_content'];
$event_content = $acf['event_content'];
$recordings = $acf['recordings'];
$speakers = $acf['speakers'];

// Clean this up
$cat = $article['category'];
$date = $article['date'];
$author = $article['author_name'];
$time = $article['time'];
$role = $article['author_title'];
$author_image = $article['author_title'];
?>
@extends('layouts.default')
@section('content')

    @include('components.blog-masthead', [
        'layout' => $header['layout'],
        'heading' => $article['title'],
        'text' => $header['summary'],
        'buttons' => $header['buttons'],
        'cat' => $cat,
        'date' => $date,
        'event_date' => $header['date'],
        'author' => $author,
        'time' => $header['time'],
        'image' => $header['image'],
        'video_embed' => $header['video_embed'],
        'form_heading' => $header['form_heading'],
        'form_embed' => $header['form_embed'],
        'logo_strip' => $header['logo_strip'],
        'no_image' => $header['no_image'],
        'reduce_image_size' => $header['reduce_image_size'],
    ])

    @if ($additional_content)
        @foreach ($additional_content as $add_content)
            @if ($add_content['acf_fc_layout'] === 'content')
                @include('flexible.index', ['flexible_content' => $additional_content])
            @endif
        @endforeach
    @endif

    @if ($event_content)
        @foreach ($event_content as $event)
            @if ($event['acf_fc_layout'] === 'recordings')
                <section class="my-16 md:my-20 py-12 md:py-16 bg-lighter-grey">
                    <div class="container grid grid-cols-12">
                        <div
                            class="col-span-12 md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4 text-center mb-12 md:mb-16">
                            @include('elements.text', [
                                'text' => $event['recordings']['heading'],
                                'type' => 'h2',
                                'size' => 40,
                                'weight' => 400,
                            ])
                        </div>
                    </div>
                    <div class="container grid grid-cols-12 gap-6 md:gap-10 lg:gap-12">
                        <div class="hidden lg:block cols-span-12 md:col-span-4">
                            <div class="sticky top-6 space-y-4">
                                @foreach ($event['recordings']['days'] as $day)
                                    @include('components.blog-recording-sidenav', [
                                        'day' => $day['day'],
                                        'date' => $day['date'],
                                        'anchor' => $loop->index,
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-8">
                            @foreach ($event['recordings']['days'] as $day)
                                <div id="day-{{ $loop->index }}"
                                    class="sidebar-item flex justify-between items-center px-4 md:px-6 py-3 md:py-4 bg-blue text-white">
                                    <div class="flex items-center justify-between w-full">
                                        @include('elements.text', [
                                            'text' => $day['day'],
                                            'type' => 'wysiwyg',
                                            'size' => 22,
                                            'weight' => 500,
                                        ])
                                        @include('elements.text', [
                                            'text' => $day['date'],
                                            'type' => 'wysiwyg',
                                            'size' => 16,
                                        ])
                                    </div>
                                </div>
                                <div class="mt-3 mb-6">
                                    @if ($day['list'])
                                        @foreach ($day['list'] as $listitem)
                                            <div class="my-2 md:my-4">
                                                <div
                                                    class="bg-white p-6 md:p-8 lg:p-10 flex flex-col-reverse lg:flex-row justify-between">
                                                    <div class="lg:w-4/12 h-64 relative overflow-hidden">
                                                        <div class="recording-video w-full h-full">
                                                            <div class="my-0 h-full">
                                                                <div class="h-full cursor-pointer">
                                                                    <div class="image h-full">
                                                                        @if ($listitem['is_video'])
                                                                            <a href="{{ $listitem['video_embed'] }}"
                                                                                class="glightbox h-full relative block hover:video-button">
                                                                                @img($listitem['image']['ID'], 'large w-full h-full object-cover')
                                                                                <div
                                                                                    class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
                                                                                    @include('icons.play-button-small')
                                                                                </div>
                                                                            </a>
                                                                        @else
                                                                            @img($listitem['image']['ID'], 'large w-full h-full object-cover')
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="lg:w-7/12 relative flex flex-col justify-between items-start">
                                                        @include('elements.text', [
                                                            'text' => $listitem['heading'],
                                                            'type' => 'wysiwyg',
                                                            'size' => 22,
                                                            'weight' => 400,
                                                        ])
                                                        <div class="w-full mb-4 lg:mb-0">
                                                            @foreach ($listitem['speakers'] as $speaker)
                                                                <div
                                                                    class="mb-4 lg:mb-2 mt-6 lg:mt-0 flex flex-wrap -ml-2 ">
                                                                    <div class="flex items-center pl-2 mt-2 md:mt-0">
                                                                        <div
                                                                            class="relative w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden mr-2">
                                                                            @img($speaker['profile_picture']['id'], ' absolute top-0 left-0 w-full h-full object-cover')
                                                                        </div>
                                                                        <div class="flex-auto pl-2 md:pr-6">
                                                                            @include('elements.text', [
                                                                                'text' => $speaker['name'],
                                                                                'type' => 'wysiwyg',
                                                                                'size' => 16,
                                                                                'weight' => 500,
                                                                            ])
                                                                            @include('elements.text', [
                                                                                'text' => $speaker['job_title'],
                                                                                'type' => 'wysiwyg',
                                                                                'size' => 14,
                                                                            ])
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                            <div
                                class="sidebar-item flex justify-center items-center px-4 md:px-6 py-3 md:py-4 bg-grey text-white text-center">
                                <div class="flex items-center justify-center w-full">
                                    @include('elements.text', [
                                        'text' => 'CLOSING',
                                        'type' => 'wysiwyg',
                                        'size' => 18,
                                        'weight' => 600,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @elseif($event['acf_fc_layout'] === 'speakers')
                <section class="my-16 md:my-20 bg-white">
                    <div class="container grid grid-cols-12">
                        <div
                            class="col-span-12 md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4 text-center mb-12 md:mb-16">
                            @include('elements.text', [
                                'text' => $event['speaker']['heading'],
                                'type' => 'h2',
                                'size' => 40,
                                'weight' => 400,
                            ])
                        </div>
                    </div>
                    <div class="container grid grid-cols-12 gap-6 md:gap-10 lg:gap-12">
                        @foreach ($event['speaker']['list'] as $speaker)
                            @include('components.blog-speaker', [
                                'name' => $speaker['name'],
                                'job_title' => $speaker['job_title'],
                                'description' => $speaker['description'],
                                'picture' => $speaker['profile_picture'],
                            ])
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <section class="my-16 md:my-20">
        <div class="container grid grid-cols-12">
            <article class="content space-y-3 md:space-y-8 col-span-12 md:col-span-7">
                @foreach ($flexible_content as $item)
                    @if ($item['acf_fc_layout'] === 'wysiwyg')
                        @include('elements.text', [
                            'text' => $item['content'],
                            'type' => 'wysiwyg',
                            'size' => 18,
                        ])
                    @elseif($item['acf_fc_layout'] === 'image')
                        <div class="w-full py-2 md:py-6">
                            @img($item['image']['ID'], 'large w-full h-auto')
                        </div>
                    @elseif($item['acf_fc_layout'] === 'list')
                        <ol class="space-y-3 md:space-y-4">
                            @foreach ($item['list'] as $item)
                                @include('elements.text', [
                                    'text' => $item['text'],
                                    'type' => 'li',
                                    'size' => 18,
                                    'weight' => 400,
                                ])
                            @endforeach
                        </ol>
                    @elseif($item['acf_fc_layout'] === 'quote')
                        @include('components.pull-quote', $item)
                    @elseif($item['acf_fc_layout'] === 'form_embed')
                        <iframe src="{{ $item['form_embed'] }}" width="100%" height="800" type="text/html"
                            frameborder="0" allowTransparency="true" style="border: 0"></iframe>
                    @endif
                @endforeach
                @if ($sidebar_form['form_embed'])
                    <iframe class="block md:hidden" src="{{ $sidebar_form['form_embed'] }}" width="100%" height="800"
                        type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
                @endif
                {{-- <div class="border-t pt-8 md:pt-14 pb-8 md:pb-0">
        <div class="flex items-center">
          <div class="w-16 h-16 rounded-full overflow-hidden mr-8">
            @img('265', 'small object-cover w-full h-full')
          </div>
          <div>
            @include('elements.text', ['text' => $author, 'type' => 'h5', 'size' => 22, 'weight' => 600])
            @include('elements.text', ['text' => $role, 'type' => 'p', 'size' => 16, 'weight' => 300])
          </div>
        </div>
      </div> --}}
            </article>
            <div class="col-span-12 md:col-span-4 md:col-start-9 mt-8 md:mt-0">
                <aside class="sticky top-6 space-y-3 md:space-y-5">
                    @if ($sidebar_form['form_embed'])
                        <iframe class="hidden md:block" src="{{ $sidebar_form['form_embed'] }}" width="100%"
                            height="1100" type="text/html" frameborder="0" allowTransparency="true"
                            style="border: 0"></iframe>
                    @else
                        @include('components.blog-cta', [
                            'layout' => '2',
                            'heading_size' => '26',
                            'content_size' => '16',
                        ])

                        @include('components.other-articles', [
                            'background' => 'bg-lighter-grey',
                        ])
                    @endif
                </aside>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            @include('components.blog-cta', [
                'layout' => '1',
                'heading_size' => '36',
                'content_size' => '18',
            ])
        </div>
    </section>

@endsection
