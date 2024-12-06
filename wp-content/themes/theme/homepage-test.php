<?php /* Template Name: Home page test */
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="home-section-1">
            <div class="home-header-banner">
                <img src="<?php the_field("header_banner"); ?>" alt="" style="width: 100%;">
            </div>


            <div class="container-fluid home-section-1-left">
                <div class="row">
                    <div class="col-md-6 home-section-1-left-content pl-0">
                        <div class="home-section-1-left-banner" style="background-image: url('<?php the_field("section_1_left_image"); ?>');">
                            <img src="<?php the_field("section_1_left_image"); ?>" alt="" style="visibility: hidden; width: 100%;">
                            <div class="home-section-1-left-description">
                                <h2><?php the_field("section_1_left_title"); ?></h2>
                                <?php the_field("section_1_left_content"); ?>
                                <?php
                                $link = get_field('section_1_left_button');
                                if ($link) :
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <div class="home-section-1-button">
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

            <div class="home-section-2">
                <div class="container">
                    <div class="row home-section-2-description">
                        <div class="col-md-6 ml-auto home-section-2-right">
                            <h2 class="home-section-2-title"><?php the_field("section_2_title"); ?></h2>
                            <div class="row home-section-2-content">
                                <div class="col-md-6 col-sm-6 home-section-2-content-left">
                                    <?php the_field("section_2_left_content"); ?>
                                </div>
                                <div class="col-md-6 col-sm-6 home-section-2-content-right">
                                    <?php the_field("section_2_right_content"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="home-section-2-button">
            <?php
            $link = get_field('section_2_button');
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <div class="home-section-2-button-text"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto home-section-2-btn">
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($link_title); ?>
                            </a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>

        <div class="home-section-3">
            <div class="container">
                <div class="row home-section-3-description">
                    <div class="col-md-12 home-section-3-title">
                        <h2 class="heading-title"><?php the_field("section_3_title"); ?></h2>
                    </div>
                </div>

                <div class="row home-section-3-repeater">
                    <?php if (have_rows('section_3_repeater')) : ?>
                        <?php while (have_rows('section_3_repeater')) : the_row(); ?>

                            <div class="col-md-4 home-section-3-card">
                                <div class="home-section-3-image">
                                    <img src="<?php the_sub_field("section_3_repeater_image"); ?>" alt="">
                                </div>
                                <div class="home-section-3-content">
                                    <h3><?php the_sub_field("section_3_repeater_title"); ?></h3>
                                    <?php the_sub_field("section_3_repeater_content"); ?>
                                    <?php
                                    $link = get_sub_field('section_3_repeater_button');
                                    if ($link) :
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                        <div class="home-section-3-button">
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

        <div class="home-section-4">
            <div class="container">
                <div class="row home-section-4-description">
                    <div class="col-md-12 home-section-4-title">
                        <h2 class="heading-title"><?php the_field("section_4_title"); ?></h2>
                    </div>
                </div>
                <div class="row home-section-4-slider">
                    <?php if (have_rows('section_4_repeater')) : ?>
                        <?php while (have_rows('section_4_repeater')) : the_row(); ?>

                            <div class="col-md-2 home-section-4-repeater">
                                <div class="home-section-4-logo">
                                    <img src="<?php the_sub_field("section_4_repeater_logo"); ?>" alt="">
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