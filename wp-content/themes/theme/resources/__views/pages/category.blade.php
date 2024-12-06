@include('components.category.category-tag')
<?php
global $posts;
$articles = apply_filters('posts_to_array', $posts);
$query = get_search_query();
?>

@extends('layouts.default')
@section('content')
    @include('components.blog-nav', [
        'dropdown' => false,
    ])

    <div>
        <section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px] pb-0 bg-lighter-grey">
            <div class="container">
                <div class="pb-[30px] lg:pb-[50px]">
                    @include('elements.text', [
                        'text' => single_cat_title('', false),
                        'type' => 'h1',
                        'size' => 48,
                    ])
                </div>
                <div class="swiper blog-masthead-swiper">
                    <div class="swiper-wrapper">
                        @foreach (array_slice($articles, 0, 2) as $article)
                            <div class="swiper-slide grid grid-cols-12 ">
                                <div class="col-span-12 md:col-span-6 h-full">
                                    @img($article['featured_image_id'], 'large w-full h-full object-cover')
                                </div>
                                <a href="{{ $article['url'] }}"
                                    class="block space-y-4 px-6 sm:px-12 md:pl-16 lg:pl-20 xl:pl-28 md:pr-10 lg:pr-20 py-8 sm:py-12 md:py-16 lg:py-20 col-span-12 md:col-span-6 bg-white relative">
                                    <span class="bg-blue text-white px-2 py-0.5 text-[14px]">
                                        {{ $options['blog']['featured_title'] ?: 'Featured' }}
                                    </span>
                                    @include('elements.text', [
                                        'text' => $article['title'],
                                        'type' => 'h2',
                                        'size' => 32,
                                    ])
                                    @include('elements.text', [
                                        'text' => $article['excerpt'],
                                        'type' => 'wysiwyg',
                                        'size' => 16,
                                    ])
                                    <ul class="sm:flex md:block lg:flex sm:space-x-1 md:space-x-0 lg:space-x-3">
                                        @include('elements.text', [
                                            'text' => single_cat_title('', false),
                                            'type' => 'li',
                                            'size' => 16,
                                            'weight' => 500,
                                        ])
                                        <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
                                        @include('elements.text', [
                                            'text' => $article['date'],
                                            'type' => 'li',
                                            'size' => 16,
                                            'weight' => 500,
                                        ])
                                    </ul>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="absolute right-0 bottom-0 flex z-10">
                        <span class="swiper-button-prev bg-blue bg-opacity-40 w-12 h-12 flex justify-center items-center">
                            <svg width="12" height="20" viewBox="0 0 12 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9844 18.9688L2 9.98438L10.9844 1" stroke="white" stroke-width="2" />
                            </svg>
                        </span>
                        <span class="swiper-button-next bg-blue w-12 h-12 flex justify-center items-center">
                            <svg width="12" height="20" viewBox="0 0 12 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.984375 1L9.96875 9.98437L0.984375 18.9687" stroke="white" stroke-width="2" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="py-16 md:py-20 mb-16 md:mb-20 bg-lighter-grey">
        <div class="container mb-6 md:mb-10">
            @include('elements.text', [
                'text' => $options['blog']['latest_title'] ?: 'Latest',
                'type' => 'h2',
                'size' => 40,
                'weight' => 400,
            ])
        </div>
        <div class="container grid md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
            <div class="gap-4 w-full md:w-2/3 grid grid-cols-12 mb-auto">
                @foreach ($articles as $article)
                    @include('components.blog-preview', [
                        'layout' => '1',
                        'cols' => 'sm:col-span-6',
                        'article' => $article,
                    ])
                @endforeach
            </div>
            <div class="w-full md:w-1/3 md:col-start-9">
                <aside class="sticky top-6 space-y-3 md:space-y-5">
                    @include('components.blog-cta', [
                        'layout' => '2',
                        'heading_size' => '26',
                        'content_size' => '16',
                    ])

                    @include('components.other-articles', [
                        'background' => 'bg-white',
                    ])
                </aside>
            </div>
        </div>
    </section>
@endsection
