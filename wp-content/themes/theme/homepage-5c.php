<?php /* Template Name: Home page 5c */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

homepage 5

        <div class="home-page-5c-section">
            <div class="homepage-5c-section">
                <div class="container">
                    <div class="row homepage-5c-section-description">
                        <div class="col-md-6 homepage-5c-left-section">
                            <h1><?php the_field('section_1_title'); ?></h1>
                            <?php the_field('section_1_content'); ?>
                        </div>
                        <div class="col-md-6 homepage-5c-right-section">
                            <img src="<?php the_field('section_1_image'); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="homepage-5c-section-2">
                <div class="container">
                    <div class="row homepage-5c-section-2-description">
                        <?php if (have_rows('section_2_reapeater')) : ?>
                            <?php while (have_rows('section_2_reapeater')) : the_row(); ?>

                                <div class="col-md-4 homepage-5c-section-2-repeater">
                                    <div class="homepage-5c-section-2-logo">
                                        <img src="<?php the_sub_field("section_2_reapeater_image"); ?>" alt="">
                                    </div>
                                    <h2><?php the_sub_field("section_2_reapeater_title"); ?></h2>
                                    <?php the_sub_field("section_2_reapeater_content"); ?>
                                </div>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>



            <div class="homepage-5c-section-3">
                <div class="container">
                    <div class="row homepage-5c-section-3-description">
                        <div class="col-md-6 homepage-5c-section-3-left">
                            <h2><?php the_field('section_3_title'); ?></h2>
                            <?php the_field('section_3_content'); ?>
                            <div class="row homepage-5c-section-3-repeater">
                                <?php if (have_rows('section_3_repeater')) : ?>
                                    <?php while (have_rows('section_3_repeater')) : the_row(); ?>
                                        <div class="col-md-6 homepage-5c-section-3-repeater-content">
                                            <h3><?php the_sub_field('section_3_repeater_title'); ?></h3>
                                            <?php the_sub_field('section_3_repeater_content'); ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 homepage-5c-section-3-right">
                            <img src="<?php the_field('section_3_image'); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="homepage-5c-section-4">
                <div class="container">
                    <div class="row homepage-5c-section-3-description">
                        <div class="col-md-6 homepage-5c-section-4-right">
                            <img src="<?php the_field('section_4_left_image'); ?>" alt="">
                        </div>

                        <div class="col-md-6 homepage-5c-section-4-left">
                            <h2><?php the_field('section_4_title'); ?></h2>
                            <?php the_field('section_4_content'); ?>
                            <div class="row homepage-5c-section-4-repeater">
                                <?php if (have_rows('section_4_repeater')) : ?>
                                    <?php while (have_rows('section_4_repeater')) : the_row(); ?>
                                        <div class="col-md-12 homepage-5c-section-4-repeater-content">
                                            <h3><?php the_sub_field('section_4_repeater_title'); ?></h3>
                                            <?php the_sub_field('section_4_repeater_content'); ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-section-4">
            <div class="container">
                <div class="row home-section-4-description">
                    <div class="col-md-12 home-section-4-title">
                        <h2 class="heading-title"><?php the_field("logo_repeater_section_title"); ?></h2>
                    </div>
                </div>
                <div class="row home-section-4-slider">
                    <?php if (have_rows('logo_repeater_section_repeater')) : ?>
                        <?php while (have_rows('logo_repeater_section_repeater')) : the_row(); ?>

                            <div class="col-md-2 home-section-4-repeater">
                                <div class="home-section-4-logo">
                                    <img src="<?php the_sub_field("logo_image"); ?>" alt="">
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="home-section-5-bg">
            <div class="container">
                <div class="row home-section-5-description">
                    <div class="col-md-12 home-section-5-title">
                        <h2 class="heading-title"><?php the_field("section_5_title"); ?></h2>
                    </div>
                </div>
            </div>
            <div class="home-section-5">
                <div class="container-fluid">
                    <div class="row home-section-5-testimonial">
                        <?php if (have_rows('section_5_repeater')) : ?>
                            <?php while (have_rows('section_5_repeater')) : the_row(); ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-5 home-section-5-image">
                                            <img src="<?php the_sub_field("section_5_repeater_image"); ?>" alt="">
                                        </div>

                                        <div class="col-sm-7 home-section-5-content">
                                            <?php the_sub_field("section_5_repeater_content"); ?>
                                            <div class="home-section-5-name">
                                                <?php the_sub_field("section_5_repeater_name"); ?>
                                            </div>
                                            <div class="home-section-5-position">
                                                <?php the_sub_field("section_5_repeater_position"); ?>
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

        <div class="home-section-6 home-section-7" style="background-image: url('<?php the_field("section_6_background_image"); ?>');">
            <div class="home-section-6-description">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 home-section-6-content">
                            <h2 class="heading-title"><?php the_field("section_6_title"); ?></h2>
                            <?php the_field("section_6_content"); ?>

                            <?php
                            $link = get_field('section_6_button');
                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                                <div class="home-section-6-button home-section-2-button">
                                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                        <?php echo esc_html($link_title); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <img src="<?php the_field("section_6_background_image"); ?>" alt="" style="visibility: hidden; width: 100%;">
        </div>



        <div class="home-section-7" style="background-image: url('<?php the_field("section_7_background_image"); ?>');">
            <img src="<?php the_field("section_7_background_image"); ?>" alt="" style="visibility: hidden; width: 100%;">
            <div class="home-section-7-description">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 home-section-7-content">
                            <h2 class="heading-title-1"><?php the_field("section_7_title"); ?></h2>
                            <?php the_field("section_7_content"); ?>

                            <?php
                            $link = get_field('section_7_button');
                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                                <div class="home-section-7-button">
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


        <div class="home-section-8">
            <div class="container">
                <div class="row home-section-8-repeater">
                    <div class="col-md-12 home-section-8-title">
                        <h2 class="heading-title"><?php the_field("section_8_title"); ?></h2>
                    </div>

                    <?php if (have_rows('section_8_repeater')) : ?>
                        <?php while (have_rows('section_8_repeater')) : the_row(); ?>

                            <div class="col-md-4 home-section-8-card">
                                <div class="home-section-8-content">
                                    <img src="<?php the_sub_field("section_8_repeater_image"); ?>" alt="">
                                    <h3><?php the_sub_field("section_8_repeater_title"); ?></h3>
                                    <?php
                                    $link = get_sub_field('section_8_repeater_button');
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

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>


<?php endwhile;
endif; ?>
<?php get_footer(); ?>