<section>
    <?php $fea = get_field("features_option_button");
    if ($fea == "Show") { ?>
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
    <?php }
    if ($fea == "Hide") { ?>
    <?php } ?>
</section>


<section>
    <?php $fea = get_field("actify_help_option_button");
    if ($fea == "Show") { ?>
        <div class="home-section-8">
            <div class="container">
                <div class="row home-section-8-repeater">
                    <div class="col-md-12 home-section-8-title">
                        <h2 class="heading-title"><?php the_field("actify_help_title"); ?></h2>
                    </div>
                    <?php if (have_rows('actify_help_repeater')) : ?>
                        <?php while (have_rows('actify_help_repeater')) : the_row(); ?>

                            <?php $feas = get_sub_field("color_choose");
                            if ($feas == "Blue") { ?>

                                <div class="col-lg-3 col-md-4 home-section-8-card home-section-8-blue-card">
                                    <div class="home-section-8-content">
                                        <img src="<?php the_sub_field("actify_help_repeater_image"); ?>" alt="">
                                        <h3><?php the_sub_field("actify_help_repeater_title"); ?></h3>
                                        <?php
                                        $link = get_sub_field('actify_help_repeater_button');
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
                            if ($feas == "White") { ?>

                                <div class="col-lg-3 col-md-4 home-section-8-card home-section-8-white-card">
                                    <div class="home-section-8-content">
                                        <img src="<?php the_sub_field("actify_help_repeater_image"); ?>" alt="">
                                        <h3><?php the_sub_field("actify_help_repeater_title"); ?></h3>
                                        <?php
                                        $link = get_sub_field('actify_help_repeater_button');
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

<footer class="container pb-20">
    {{-- Menus --}}
    <div class="xl:flex pt-10 pb-10 md: pt-20 md:pb-20 border-t border-light-gray">
        <div class="lg:flex-1 xl:pt-[33px] grid grid-cols-2 md:grid-cols-4 gap-2 gap-y-6 md:gap-6">
            @foreach ($options['menus'] as $menu)
            <div>
                <h3 class="text-[16px] font-medium">
                    {{ $menu['heading'] }}
                </h3>
                <ul role="list" class="text-[14px] mt-3 space-y-3">
                    @foreach ($menu['links'] as $item)
                    @if ($item['link'])
                    <li>
                        <a class="opacity-70 hover:text-blue hover:opacity-100" href="{{ $item['link']['url'] }}" target="{{ $item['link']['target'] }}">
                            {!! $item['link']['title'] !!}
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
        {{-- Contact CTA --}}
        <div class="mt-12 xl:mt-0 max-w-[450px] xl:w-[35%]">
            <div class="bg-light-grey py-[20px] px-[30px] md:py-[30px] md:px-[20px]">
                <h3 class="text-[16px] font-medium">
                    {{ $options['contact_title'] }}
                </h3>
                <ul role="list" class="mt-4 space-y-1">
                    @foreach ($options['contact_links'] as $item)
                    @if ($item['link'])
                    <li>
                        <a href="{{ $item['link']['url'] }}" target="{{ $item['link']['target'] }}" class="text-[12px] sm:flex items-center">
                            @if ($item['icon'])
                            <span class="hidden sm:block w-[25px] inline-block">
                                @img($item['icon']['ID'])
                            </span>
                            @endif
                            <span class="flex-1">{!! $item['title'] !!}</span>
                            <span class="block ml-auto text-blue font-medium hover:text-black">{!! $item['link']['title'] !!}</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- Languages --}}
    <div class="border-t border-light-gray pt-6 md:flex md:items-center md:justify-between">
        <div>
            <ul class="flex space-x-4">
                @foreach ($options['languages'] as $item)
                <li>
                    <a class="flex items-center space-x-2 rounded-[2em] px-5 py-[10px] text-[12px] border @if (getLocale() === $item['locale_code']) border-gray-400 @else border-light-gray @endif hover:border-gray-400 transition" href="{{ apply_filters('current_permalink_translated', $item['locale_code']) }}">
                        <span>
                            {{ $item['name'] }}
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        {{-- LOGOS --}}
        <div class="justify-center mt-6 md:mt-0 text-[14px] font-light flex flex-wrap gap-2 items-center">
            <span class="pr-2 w-full md:w-auto">
                {{ $options['logos']['content'] }}
            </span>
            <div class="flex flex-wrap items-center gap-2 md:gap-4 w-full md:w-auto">
                @foreach ($options['logos']['logos'] as $logo)
                <div class="relative">
                    <a href="{{ $logo['link']['url'] }}" target="_blank">
                        <img src="{{ $logo['logo']['url'] }}" src="{{ $logo['logo']['alt'] }}" width="{{ $logo['width'] }}" width="{{ $logo['height'] }}" class="object-contain" />
                    </a>
                </div>
                @endforeach
            </div>
        </div>


        {{-- Share Icons --}}
        <div class="mt-6 md:mt-0 flex text-[14px]">
            <span class="hidden md:block">{{ $options['connect_title'] }}</span>
            <ul class="flex items-center space-x-[25px] md:ml-6">
                @foreach ($options['connect_links'] as $item)
                <li>
                    <a class="inline-block hover:opacity-[0.5]" href="{{ $item['link']['url'] }}" title="{{ $item['link']['title'] }}" target="{{ $item['link']['target'] }}">
                        @if ($item['icon'])
                        @img($item['icon']['ID'])
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- Legal Menu --}}
    <div class="mt-6 border-t border-light-gray pt-8 md:flex md:items-center md:justify-between text-[14px]">
        <div class="sm:flex sm:space-x-6 lg:space-x-14 md:order-2">
            @foreach ($options['legal_menu'] as $item)
            <a class="block text-blue hover:text-black" href="{{ $item['link']['url'] }}" target="{{ $item['link']['target'] }}">{!! $item['link']['title'] !!}</a>
            @endforeach
        </div>
        {{-- Copyright --}}
        <p class="mt-8 md:mt-0 md:order-1">
            {!! $options['copyright'] !!}
        </p>
    </div>
</footer> 

{{-- Checkout Popup --}}
@include('components.checkout-popup')