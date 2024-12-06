@include('components.category.category-tag')

@php
    $page = intval(get_query_var('paged'));
    if ($page === 0) {
        $page = 1;
    }
    
    $cat_ID = 36;
    
    $children = get_terms([
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => $cat_ID, // or
    ]);
    
    $exclude = [$cat_ID];
    
    foreach ($children as $child) {
        array_push($exclude, $child->term_id);
    }
    
    $query = new WP_Query([
        'paged' => $page,
        'post_type' => 'post',
        'category__not_in' => $exclude,
    ]);
    
    $articles = apply_filters('posts_to_array', $query->posts);
    
    $num_pages = $query->max_num_pages;
    
    $blog_options = get_field('blog', 'options');
    $featured_articles = apply_filters('posts_to_array', $blog_options['featured_articles']);
    $first_article = $featured_articles[0];
@endphp

@extends('layouts.default')
@section('content')

    @include('components.blog-nav', [
        'dropdown' => true,
    ])

    @if ($page === 1)
        <section class="resources pt-16 md:pt-20 pb-8 md:pb-12 bg-lighter-grey">
            <div class="container md:flex md:items-end justify-between mb-6 md:mb-12">
                <div class="w-full md:w-3/4 lg:w-2/3">
                    @include('elements.text', [
                        'text' => $options['blog']['featured_title'] ?: 'Featured',
                        'type' => 'h1',
                        'size' => 48,
                        'weight' => 400,
                    ])
                </div>
                <div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12">
                    <form action="{{ '/' . getLocale() }}">
                        <input name="s" type="text" class="search-form w-full"
                            placeholder="{{ $options['blog']['search_title'] ?: 'Search' }}">
                    </form>
                </div>
            </div>
            <div class="container md:flex space-y-6 md:space-y-0 md:space-x-6">
                <a href="{{ $first_article['url'] }}"
                    class="block lg:min-h-[450px] w-full md:w-1/2 lg:w-7/12 relative text-white px-10 py-12">
                    <div class="relative z-10 w-3/4 md:w-full lg:w-3/4 space-y-4 md:space-y-6">
                        <span class="bg-blue text-white uppercase px-2 py-0.5 text-[14px]">
                            {{ $first_article['category'] }}
                        </span>
                        @include('elements.text', [
                            'text' => $first_article['title'],
                            'type' => 'h1',
                            'size' => 32,
                        ])
                        <ul class="sm:flex md:block lg:flex sm:space-x-1 md:space-x-0 lg:space-x-3">
                            @include('elements.text', [
                                'text' => $first_article['date'],
                                'type' => 'li',
                                'size' => 16,
                                'weight' => 500,
                            ])
                            <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
                            @include('elements.text', [
                                'text' => $first_article['author_name'],
                                'type' => 'li',
                                'size' => 16,
                                'weight' => 500,
                            ])
                        </ul>
                    </div>
                    @img(
                        $first_article['featured_image_id'],
                        'large w-full h-full absolute top-0 right-0 bottom-0
                                                                                                                        object-cover'
                    )
                    <span class="absolute inset-0 blog-overlay"></span>
                </a>
                <div class="w-full md:w-1/2 lg:w-7/12 grid grid-cols-12 gap-4 md:gap-6">
                    @foreach (array_slice($featured_articles, 1, 3) as $article)
                        @include('components.blog-preview-masthead', [
                            'article' => $article,
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="pb-16 pt-6 md:pb-20 md:pt-8 bg-lighter-grey">
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
                        'article' => $article,
                        'layout' => '1',
                        'cols' => 'sm:col-span-6',
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

    @php
        $prev_link = translateLink(get_previous_posts_page_link());
        $next_link = translateLink(get_next_posts_page_link());
    @endphp

    <section class="pagination bg-lighter-grey py-16">
        <div class="container flex flex-wrap order-1">
            <div class="w-1/2 md:w-1/3 text-left">
                @if ($page != 1)
                    <a href="{{ $prev_link }}" class="hover:text-blue flex items-center">
                        <span class="mr-2">
                            <svg width="61" height="15" viewBox="0 0 61 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M60.4102 8.25H0.410156V6.75H60.4102V8.25ZM0.940487 6.96967L7.44049 13.4697L6.37983 14.5303L-0.120174 8.03033L0.940487 6.96967ZM-0.120174 6.96967L6.37983 0.46967L7.44049 1.53033L0.940487 8.03033L-0.120174 6.96967Z"
                                    fill="#186FE0" />
                            </svg>
                        </span>
                        {{ $options['blog']['previous_title'] ?: 'Previous' }}
                    </a>
                @endif
            </div>
            <div class="w-full md:w-1/3 text-center order-3 md:order-2 mt-4 md:mt-0">
                <ul class="flex justify-evenly space-x-2">
                    @foreach (range(1, $num_pages) as $index)
                        <li><a href="{{ !empty(getLocale()) ? '/' . getLocale() : '' }}/resources/page/{{ $index }}/"
                                class="w-8 py-1 block @if ($index == $page) bg-light-green text-white @else hover:bg-green hover:text-white @endif">{{ $index }}</a>
                        </li>
                    @endforeach
                </ul>
                {{-- <div class="o-layout u-margin-bottom-large">
                  <div class="c-pagination u-margin-top-large u-margin-bottom-small">
                    {!! paginate_links([
                      'prev_text' => '<span>Previous</span>',
                      'next_text' => '<span>Next</span>'
                    ]) !!}
                  </div>
                </div> --}}
            </div>
            <div class="w-1/2 md:w-1/3 text-right flex justify-end order-2 md:order-3">
                @if ($page != $num_pages)
                    <a href="{{ $next_link }}"
                        class="hover:text-blue flex items-center">{{ $options['blog']['next_title'] ?: 'Next' }}
                        <span class="ml-2">
                            <svg width="61" height="15" viewBox="0 0 61 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 8.25H60V6.75H0V8.25ZM59.4697 6.96967L52.9697 13.4697L54.0303 14.5303L60.5303 8.03033L59.4697 6.96967ZM60.5303 6.96967L54.0303 0.46967L52.9697 1.53033L59.4697 8.03033L60.5303 6.96967Z"
                                    fill="#186FE0" />
                            </svg>
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </section>

@endsection
