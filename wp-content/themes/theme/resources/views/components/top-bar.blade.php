<?php $fea = get_field("header_top_logo_option_button", "option");
if ($fea == "Show") { ?>
    <div class="header-top-section-logo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-top-logo-section">
                        <a target="_blank" href="<?php the_field('header_top_logo_url', "option"); ?>">
                            <img src="<?php the_field('header_top_logo', "option"); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
if ($fea == "Hide") { ?>
<?php } ?>


<div class="text-right bg-light-grey text-[10px] ">
    <div class="header-top-section">
        <div class="container-fluid flex header-top-bar-section" style="justify-content: space-between; align-items: center;">
            <?php $fea = get_field("header_top_slider_option_button", "option");
            if ($fea == "Show") { ?>
                <div class="header-left-popup">
                    <div class="header-top-left-slider">
                        <?php if (have_rows('header_top_slider', "option")) : ?>
                            <?php while (have_rows('header_top_slider', "option")) : the_row(); ?>
                                <div class="header-top-left-slider-test">
                                    <a href="<?php the_sub_field('header_top_slider_url'); ?>">
                                        <?php the_sub_field('header_top_slider_text'); ?>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php }
            if ($fea == "Hide") { ?>
            <?php } ?>
            <div class="ml-auto flex items-center space-x-2 py-[8px]">
                <span>{{ $options['select_language_text'] }}</span>
                <span class="relative inline-block">
                    <select onchange="location = this.value;" id="language" name="language" class="w-[90px] appearance-none block w-full bg-none bg-white border border-gray-300 rounded-[2em] px-[8px] pt-[4px] pb-[4px] pr-[10px] pl-[14px] leading-[1.25em] text-[10px]">
                        @foreach ($options['languages'] as $language)
                        <option @if (getLocale()===$language['locale_code']) selected @endif value="{{ apply_filters('current_permalink_translated', $language['locale_code']) }}">
                            {{ $language['name'] }}
                        </option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none w-[13px] absolute top-[8px] right-[4px]">
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.19644 0.914157L4.09766 4.01294L0.998874 0.914157" stroke="#8A8A8A" stroke-width="0.720721" />
                        </svg>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>