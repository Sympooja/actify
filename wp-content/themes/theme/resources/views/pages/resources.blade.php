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
<section class="resources pt-16 md:pt-20 pb-8 md:pb-12">
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
                <input name="s" type="text" class="search-form w-full" placeholder="{{ $options['blog']['search_title'] ?: 'Search' }}">
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row features-top-blog">
            <div class="col-md-6 features-top-blog-left">
                <a href="{{ $first_article['url'] }}">
                    @img(
                    $first_article['featured_image_id'],
                    'w-full rounded-tr-lg rounded-tl-lg rounded-bl-md rounded-br-md
                    object-cover'
                    )
                </a>
            </div>
            <div class="col-md-6 features-top-blog-right">
                <a href="{{ $first_article['url'] }}">
                    <div>

                        @include('elements.text', [
                        'text' => $first_article['title'],
                        'type' => 'h1',
                        'size' => 32,
                        ])

                        @include('elements.text', [
                        'text' => $first_article['content'],
                        'type' => 'wysiwyg',
                        'size' => 15,
                        ])

                        @include('elements.text', [
                        'text' => $first_article['editor'],
                        'type' => 'wysiwyg',
                        'size' => 15,
                        ])

                        {{ $first_article['editor'] }}

                        {{ $posts['content'] ?? 'Default content if content is not available' }}

                        @include('elements.text', [
                        'text' => $text,
                        'type' => 'p',
                        'size' => 18,
                        ])

                        <?php the_field('content'); ?>

                        <div class="blog-feature-button">
                            Read More >
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<section class="pt-6 md-20 md:pt-8">
    <div class="container mb-6 md:mb-10">
        @include('elements.text', [
        'text' => $options['blog']['latest_title'] ?: 'Latest',
        'type' => 'h2',
        'size' => 40,
        'weight' => 400,
        ])
    </div>
    <div class="container grid md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
        <div class="row">
            @foreach ($articles as $article)
            @include('components.blog-preview', [
            'article' => $article,
            'layout' => '1',
            'cols' => 'sm:col-span-6',
            ])
            @endforeach
        </div>
    </div>
</section>

@php
$prev_link = translateLink(get_previous_posts_page_link());
$next_link = translateLink(get_next_posts_page_link());
@endphp

<section class="pagination py-16">
    <div class="container flex flex-wrap order-1">
        <div class="w-1/2 md:w-1/3 text-left">
            @if ($page != 1)
            <a href="{{ $prev_link }}" class="hover:text-blue flex items-center">
                <span class="mr-2">
                    <svg width="61" height="15" viewBox="0 0 61 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M60.4102 8.25H0.410156V6.75H60.4102V8.25ZM0.940487 6.96967L7.44049 13.4697L6.37983 14.5303L-0.120174 8.03033L0.940487 6.96967ZM-0.120174 6.96967L6.37983 0.46967L7.44049 1.53033L0.940487 8.03033L-0.120174 6.96967Z" fill="#186FE0" />
                    </svg>
                </span>
                {{ $options['blog']['previous_title'] ?: 'Previous' }}
            </a>
            @endif
        </div>
        <div class="w-full md:w-1/3 text-center order-3 md:order-2 mt-4 md:mt-0">
            <ul class="flex justify-evenly space-x-2">
                @foreach (range(1, $num_pages) as $index)
                <li><a href="{{ !empty(getLocale()) ? '/' . getLocale() : '' }}/resources/page/{{ $index }}/" class="w-8 py-1 block @if ($index == $page) bg-light-green text-white @else hover:bg-green hover:text-white @endif">{{ $index }}</a>
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
            <a href="{{ $next_link }}" class="hover:text-blue flex items-center">{{ $options['blog']['next_title'] ?: 'Next' }}
                <span class="ml-2">
                    <svg width="61" height="15" viewBox="0 0 61 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 8.25H60V6.75H0V8.25ZM59.4697 6.96967L52.9697 13.4697L54.0303 14.5303L60.5303 8.03033L59.4697 6.96967ZM60.5303 6.96967L54.0303 0.46967L52.9697 1.53033L59.4697 8.03033L60.5303 6.96967Z" fill="#186FE0" />
                    </svg>
                </span>
            </a>
            @endif
        </div>
    </div>
</section>


<section>
    <?php $option = $options['features_option_button']; ?>
    @if ($option == 'Show')
  <div class="features-setion-1" style="background-image: url('<?php the_field("features_section_background_image", "option"); ?>')">
            <img src="<?php the_field("features_section_background_image", "option"); ?>" alt="" style="visibility: hidden; width: 100%;" class="features-section-1-img">
            <div class="features-setion-1-description">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div>
                                    @include('elements.text', [
                                    'text' => $options['blog']['community_title'],
                                    'type' => 'h4',
                                    'size' => $heading_size,
                                    'weight' => 400,
                                    ])
                                    @include('elements.text', [
                                    'text' => $options['blog']['community_description'],
                                    'type' => 'p',
                                    'size' => $content_size,
                                    'weight' => 400,
                                    ])
                                </div>
                                <div class="mt-2 @if ($layout === '1') md:w-1/2 lg:w-2/5 @endif">
                                    <form class="resources-form @if ($layout === '1') text-center md:text-left md:flex space-y-4 md:space-y-0 @elseif($layout === '2') text-center space-y-4 md:space-y-3 @endif">
                                        <iframe src="{{ $options['blog']['newsletter_form'] }}" width="100%" height="160" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($option == 'Hide')
    @endif
</section>

   <section>
                        <?php $fea = get_field("actify_help_option_button", "option");
                        if ($fea == "Show") { ?>
                             <div class="home-section-8">
            <div class="container">
                <div class="row home-section-8-repeater">
                    <div class="col-md-12 home-section-8-title">
                        <h2 class="heading-title"><?php the_field("actify_help_title", "option"); ?></h2>
                    </div>
                    <?php if (have_rows('actify_help_repeater', "option")) : ?>
                        <?php while (have_rows('actify_help_repeater', "option")) : the_row(); ?>

                            <?php $fea = get_sub_field("color_choose", "option");
                            if ($fea == "Blue") { ?>

                                <div class="col-lg-3 col-md-4 home-section-8-card home-section-8-blue-card">
                                    <div class="home-section-8-content">
                                        <img src="<?php the_sub_field("actify_help_repeater_image", "option"); ?>" alt="">
                                        <h3><?php the_sub_field("actify_help_repeater_title", "option"); ?></h3>
                                        <?php
                                        $link = get_sub_field('actify_help_repeater_button', "option");
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="home-section-8-button home-section-2-button">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php }
                            if ($fea == "White") { ?>

                                <div class="col-lg-3 col-md-4 home-section-8-card home-section-8-white-card">
                                    <div class="home-section-8-content">
                                        <img src="<?php the_sub_field("actify_help_repeater_image", "option"); ?>" alt="">
                                        <h3><?php the_sub_field("actify_help_repeater_title", "option"); ?></h3>
                                        <?php
                                        $link = get_sub_field('actify_help_repeater_button', "option");
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="home-section-8-button home-section-2-button">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php } ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
                        <?php }
                        if ($fea == "Hide") { ?>
                        <?php } ?>
                    </section>

@endsection