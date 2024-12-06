@include('components.category.category-tag')


@php
    $page = intval(get_query_var('paged'));
    if ($page === 0) {
        $page = 1;
    }
    
    $cat_ID = 36;
    $query = new WP_Query([
        'paged' => $page,
        'post_type' => 'post',
        'cat' => $cat_ID,
    ]);
    
    $children = get_terms([
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => $cat_ID, // or
    ]);
    
    $articles = apply_filters('posts_to_array', $query->posts);
    $num_pages = $query->max_num_pages;
    
    $blog_options = get_field('blog_options', 'options');
    $featured_articles = apply_filters('posts_to_array', $blog_options['featured_articles']);
    $first_article = $featured_articles[0];
@endphp

@extends('layouts.default')

@section('content')
    <section class="popular bg-white pt-16 md:pt-20 pb-8 md:pb-12">
        <div class="container">
            <div class="border-b pb-12">
                @include('elements.text', [
                    'text' => $options['blog_options']['featured_title'] ?: 'Most Popular',
                    'type' => 'h1',
                    'size' => 48,
                    'weight' => 400,
                ])
            </div>

            @include('components.popular-articles')

        </div>
    </section>

    <section class="filters bg-lighter-grey pt-24">
        <div class="container md:flex md:items-center justify-between pb-12">
            <div class="w-full md:w-1/4 lg:w-1/3 text-left mb-8 md:mb-0">
                <span class="relative inline-block w-full">
                    <select id="categories" name="categories" aria-placeholder="Categories"
                        class="link-select w-full bg-[#F7F8FB] appearance-none cursor-pointer block w-full h-10 bg-none border grey-border rounded-[2em] px-[8px] pt-[8px] pb-[8px] pr-[10px] pl-[20px] leading-[1.25em] text-[16px] text-grey">


                        <option value="{{ translateLink('/blog/') }}">
                            {{ $options['blog_options']['categories_title'] ?: 'Categories' }}</option>


                        @foreach ($children as $item)
                            <option value="{{ get_term_link($item) }}">{{ get_term($item)->name }}</option>
                        @endforeach

                    </select>
                    <span class="pointer-events-none w-[13px] absolute top-[16px] right-[16px]">
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.19644 0.914157L4.09766 4.01294L0.998874 0.914157" stroke="#233741"
                                stroke-width="0.720721" />
                        </svg>
                    </span>
                </span>
            </div>
            <div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12">
                <form action="{{ '/' . getLocale() }}" class="relative">
                    <input name="s" type="text" class="search-form w-full"
                        placeholder="{{ $options['blog_options']['search_title'] ?: 'Search' }}">
                    <svg class="absolute right-4 top-[8px]" width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="6.59295" cy="6.59295" r="5.69391" stroke="#233741" stroke-width="1.79808" />
                        <line x1="10.8237" y1="10.7522" x2="15.0192" y2="14.9477" stroke="#233741"
                            stroke-width="1.79808" />
                    </svg>

                </form>
            </div>
        </div>
    </section>



    <section class="pb-16 pt-6 md:pb-20 md:pt-8 bg-lighter-grey">
        <div class="container grid md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
            <div class="gap-6 w-full grid grid-cols-12 mb-auto">
                @foreach ($articles as $article)
                    @include('components.blog-preview', [
                        'article' => $article,
                        'layout' => '3',
                        'cols' => 'lg:col-span-4 sm:col-span-6',
                    ])
                @endforeach
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
                        {{ $options['blog_options']['previous_title'] ?: 'Previous' }}
                    </a>
                @endif
            </div>
            <div class="w-full md:w-1/3 text-center order-3 md:order-2 mt-4 md:mt-0">
                <ul class="flex justify-evenly space-x-2">
                    @foreach (range(1, $num_pages) as $index)
                        <li><a href="{{ !empty(getLocale()) ? '/' . getLocale() : '' }}/blog/page/{{ $index }}/"
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
                        class="hover:text-blue flex items-center">{{ $options['blog_options']['next_title'] ?: 'Next' }}
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
    <section class="pb-16 pt-6 md:pb-32 md:pt-8 bg-lighter-grey">
        <div class="container">
            @include('components.blog-cta', [
                'layout' => '1',
                'heading_size' => '36',
                'content_size' => '19',
            ])
        </div>
    </section>
@endsection
