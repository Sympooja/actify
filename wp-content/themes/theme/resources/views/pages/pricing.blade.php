@extends('layouts.default')
@include('components.category.category-tag')
@section('content')
<section>
    <div class="pricing-section-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <select id="country-select" class="country-select">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                    </select>
                </div>
                <div class="col-md-12 pricing-section-1-title">
                    <h1><?php the_field("section_1_title"); ?></h1>
                </div>
            </div>

            <div class="d-lg-block d-none">
                <div class="row pricing-section1-repeater">
                    <?php if (have_rows('pricing_card_repeater')) : ?>
                        <?php while (have_rows('pricing_card_repeater')) : the_row(); ?>
                            <div class="col-md-3 pricing-section1-card">
                                <?php
                                if (get_sub_field('recommended_title')) : ?>
                                    <div class="pricing-section1-recommended">
                                        <?php the_sub_field('recommended_title'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if (have_rows('pricing_card_repeater')) : $i = 0 ?>
                        <?php while (have_rows('pricing_card_repeater')) : the_row(); ?>
                            <div class="col-md-3 pricing-section1-card">
                                <div class="pricing-section1-card-description">
                                    <?php if (get_sub_field('subscription_option')) : ?>
                                        <div class="pricing-section1-subscription">
                                            <?php the_sub_field('subscription_option'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (have_rows('plan')) : $s = 0 ?>
                                        <?php while (have_rows('plan')) : the_row(); ?>
                                            <div class="pricing-section1-amount content" id="<?php the_sub_field("currency"); ?>">
                                                <?php the_sub_field('price'); ?>
                                            </div>
                                        <?php $s++;
                                        endwhile; ?>
                                    <?php endif; ?>

                                    <div>
                                        <?php if (get_sub_field('price')) : ?>
                                            <div class="plan">
                                                <div class="pricing-section1-amount">
                                                    <p class="price" data-usd="<?php the_sub_field('price'); ?>"><?php the_sub_field('price'); ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('year')) : ?>
                                            <div class="pricing-section1-year">
                                                <?php the_sub_field('year'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pricing-section-1-button">
                                        <?php
                                        $link = get_sub_field('buy_now_button');
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="pricing-section1-buy-btn">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (have_rows('plan')) : $s = 0 ?>
                                            <?php while (have_rows('plan')) : the_row(); ?>
                                                <?php
                                                $link = get_sub_field('buy_now_button');
                                                if ($link) :
                                                    $link_url = $link['url'];
                                                    $link_title = $link['title'];
                                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                                    <div class="pricing-section1-buy-btn content" id="<?php the_sub_field("currency"); ?>">
                                                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                            <?php echo esc_html($link_title); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php $s++;
                                            endwhile; ?>
                                        <?php endif; ?>

                                        <?php
                                        $link = get_sub_field('try_free_button');
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="pricing-section1-try-btn">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (get_sub_field('content')) : ?>
                                        <div class="pricing-section1-content">
                                            <?php the_sub_field('content'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php $i++;
                        endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-lg-none d-block">
                <div class="row">
                    <?php if (have_rows('pricing_card_repeater')) : $s = 0  ?>
                        <?php while (have_rows('pricing_card_repeater')) : the_row(); ?>
                            <div class="col-md-6 pricing-section1-card">
                                <?php if (get_sub_field('recommended_title')) : ?>
                                    <div class="pricing-section1-recommended">
                                        <?php the_sub_field('recommended_title'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="pricing-section1-card-description">
                                    <?php if (get_sub_field('subscription_option')) : ?>
                                        <div class="pricing-section1-subscription">
                                            <?php the_sub_field('subscription_option'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (have_rows('plan')) : $s = 0 ?>
                                        <?php while (have_rows('plan')) : the_row(); ?>
                                            <div class="pricing-section1-amount content" id="<?php the_sub_field("currency"); ?>">
                                                <?php the_sub_field('price'); ?>
                                            </div>
                                        <?php $s++;
                                        endwhile; ?>
                                    <?php endif; ?>

                                    <div>
                                        <?php if (get_sub_field('price')) : ?>
                                            <div class="plan">
                                                <div class="pricing-section1-amount">
                                                    <p class="price" data-usd="<?php the_sub_field('price'); ?>"><?php the_sub_field('price'); ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_sub_field('year')) : ?>
                                            <div class="pricing-section1-year">
                                                <?php the_sub_field('year'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pricing-section-1-button">
                                        <?php
                                        $link = get_sub_field('buy_now_button');
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="pricing-section1-buy-btn">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (have_rows('plan')) : $s = 0 ?>
                                            <?php while (have_rows('plan')) : the_row(); ?>
                                                <?php
                                                $link = get_sub_field('buy_now_button');
                                                if ($link) :
                                                    $link_url = $link['url'];
                                                    $link_title = $link['title'];
                                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                                    <div class="pricing-section1-buy-btn content" id="<?php the_sub_field("currency"); ?>">
                                                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                            <?php echo esc_html($link_title); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php $s++;
                                            endwhile; ?>
                                        <?php endif; ?>

                                        <?php
                                        $link = get_sub_field('try_free_button');
                                        if ($link) :
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <div class="pricing-section1-try-btn">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (get_sub_field('content')) : ?>
                                        <div class="pricing-section1-content">
                                            <?php the_sub_field('content'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php $s++;
                        endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>


        <div class="pricing-section-2">
            <!-- <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php // the_field("section_2_title"); 
                            ?></h2>
                    </div>
                </div>
            </div> -->

            <div class="dropdown-option"></div>


            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (have_rows('section_2_repeater')) : ?>
                            <?php while (have_rows('section_2_repeater')) : the_row(); ?>
                                <div class="careers-repeater content" id="<?php the_sub_field("table_title"); ?>">
                                    <?php if (get_sub_field('section_2_title')) : ?>
                                        <div class="pricing-section-2-title">
                                            <h2><?php the_sub_field("section_2_title"); ?></h2>
                                        </div>
                                    <?php endif; ?>
                                    <div swipe-helper-area class="overflow-auto relative">
                                        <table class="format-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" rowspan="2">Name</th>
                                                    <th class="text-left" rowspan="2">Versions</th>
                                                    <th class="text-left" rowspan="2">File Types</th>
                                                    <th colspan="3">Format Attributes</th>
                                                    <th rowspan="2">Basic</th>
                                                    <th rowspan="2">Classic</th>
                                                    <th rowspan="2">Premium</th>
                                                </tr>
                                                <tr>
                                                    <th>Tessellation</th>
                                                    <th>B-Rep</th>
                                                    <th>PMI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (have_rows('table')) : ?>
                                                    <?php while (have_rows('table')) : the_row(); ?>
                                                        <tr>
                                                            <td><?php the_sub_field("table_name"); ?></td>
                                                            <td><?php the_sub_field("table_version"); ?></td>
                                                            <td><?php the_sub_field("table_file_type"); ?></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("table_tessellation"); ?>"></span></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("b-rep"); ?>"></span></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("pmi"); ?>"></span></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("basic"); ?>"></span></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("classic"); ?>"></span></td>
                                                            <td class="text-center"><span class="bool val-<?php the_sub_field("premium"); ?>"></span></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div swipe-helper class="absolute top-0 left-0 right-0 bottom-0 xl:hidden" style="background: rgba(255,255,255,0.75)">
                                            <div class="absolute top-[50%] left-[50%] mt-[-50px] ml-[-100px]">
                                                @include('icons.swiper-hand')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pricing-background-image" style="background-image: url('<?php the_field("section_3_background_image"); ?>');">
        <div class="pricing-section-3-description">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 pricing-section-3-desc">
                        <h2><?php the_field("section_3_title"); ?></h2>
                        <?php the_field("section_3_content"); ?>
                        <?php
                        $link = get_field('section_3_button');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                            <div class="pricing-button">
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionsDropdown = document.getElementById('country-select');

        optionsDropdown.addEventListener('change', function() {
            const selectedCurrency = this.value;

            document.querySelectorAll('.pricing-section1-amount').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.pricing-section1-buy-btn').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.content#' + selectedCurrency).forEach(function(element) {
                element.style.display = 'block';
            });

            document.getElementById('buy-' + selectedCurrency).style.display = 'block';
        });

        optionsDropdown.dispatchEvent(new Event('change'));
    });
</script>


<!-- <script>
    document.getElementById('options').addEventListener('change', function() {
        var contents = document.querySelectorAll('.content');
        contents.forEach(function(content) {
            content.style.display = 'none';
        });

        var selectedValue = this.value;
        if (selectedValue !== 'none') {
            document.getElementById(selectedValue).style.display = 'block';
        }
    });
</script> -->


@endsection