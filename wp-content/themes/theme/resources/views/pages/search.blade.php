@include('components.category.category-tag')

<?php
global $posts;
$articles = apply_filters('posts_to_array', $posts);
$query = get_search_query();
?>

@extends('layouts.default')
@section('content')

    @include('components.blog-nav', [
        'dropdown' => true,
    ])

    <section class="bg-lighter-grey py-16 md:py-20 mb-16 md:mb-20">
        <div class="container md:flex md:items-end justify-between">
            <div class="w-full md:w-3/4 lg:w-2/3">
                @include('elements.text', [
                    'text' => 'Showing results for:',
                    'type' => 'p',
                    'size' => 16,
                    'weight' => 400,
                ])
                @include('elements.text', [
                    'text' => $query ? $query : '...',
                    'type' => 'h1',
                    'size' => 48,
                    'weight' => 400,
                ])
            </div>
            <div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12">
                <form action="/">
                    <input name="s" type="text" class="search-form w-full" placeholder="Search"
                        value="{{ $query ? $query : '' }}">
                </form>
            </div>
        </div>
    </section>

    <section class="my-16 md:my-20 bg-white">
        <div class="container md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
            @if ($articles)
                <div class="row w-full md:w-2/3">
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
                            'heading' => 'Join our community',
                            'content' => 'Sign up to receive our latest news',
                        ])
                    </aside>
                </div>
            @else
                <div class="text-[24px] pb-20 border-b border-light-gray w-full">Sorry. We didn't find any results found for
                    your search.</div>
            @endif
        </div>
    </section>

@endsection
