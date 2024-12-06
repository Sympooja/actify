<?php

/**
 * Define WordPress actions for your theme.
 *
 * Based on the WordPress action hooks.
 * https://developer.wordpress.org/reference/hooks/
 *
 */

/**
 * Add classes to images.
 */
add_filter('wp_get_attachment_image_attributes', function ($attr) {
    $attr['class'] = $attr['class'] . ' pointer-events-none';
    return $attr;
});


add_filter('wpcf7_autop_or_not', '__return_false');


/*-----------------------------------------------------------------------------------*/
/* Add featured image to custom post types in gutenburg
/*-----------------------------------------------------------------------------------*/
add_theme_support('post-thumbnails');


/*-----------------------------------------------------------------------------------*/
/* Remove the stupid emoji stuff
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/
function remove_admin_menu_items()
{
    $remove_menu_items = ['Comments', 'Links',];
    global $menu;
    end($menu);
    while (prev($menu)) {
        $item = explode(' ', $menu[key($menu)][0]);
        if (in_array($item[0] != NULL ? $item[0] : "", $remove_menu_items)) {
            unset($menu[key($menu)]);
        }
    }
}

add_action('admin_menu', 'remove_admin_menu_items');


/**
 * Remove the margin-top inline style for the admin bar
 */
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'remove_admin_login_header');


function remove_block_css()
{
    wp_dequeue_style('wp-block-library');
}

add_action('wp_enqueue_scripts', 'remove_block_css', 100);


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('Header'),
        'menu_title' => __('Header'),
        'menu_slug' => 'header',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => __('Footer'),
        'menu_title' => __('Footer'),
        'menu_slug' => 'footer',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => __('Resources'),
        'menu_title' => __('Resources'),
        'menu_slug' => 'resources',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_page(array(
        'page_title' => __('Blog'),
        'menu_title' => __('Blog'),
        'menu_slug' => 'blog',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_action('acf/init', function () {
    acf_update_setting('google_api_key', 'AIzaSyDrWnQi3EMM1Z8oVAsen0r4AJGucVeoVfU');
});

add_filter('acf/settings/save_json', function ($path) {
    $path = get_stylesheet_directory() . '/resources/acf-json';
    return $path;
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/resources/acf-json';
    return $paths;
});


// Mime type edit
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['doc'] = 'application/msword';
    unset($mimes['exe']);
    return $mimes;
});

// Make SVGs show in admin
add_action('admin_head', function () {
    echo '
    <style>
    td.media-icon img[src$=".svg"],
    .acf-image-uploader .image-wrap img[src$=".svg"],
    img[src$=".svg"].attachment-post-thumbnail {
      width: 100% !important;
      height: auto !important;
      object-fit: contain;
    }
    </style>
  ';
});

// Turn posts into more helpful format
add_filter('posts_to_array', function ($posts = []) {
    $arr = [];
    if ($posts) {
        foreach ($posts as $post) {
            $categories = get_the_category($post->ID);
            $first_category_name = $categories ? $categories[0]->name : 'None';
            $thumbnail_id = get_post_thumbnail_id($post);
            if (!$thumbnail_id) {
                $blog_options = get_field('blog', 'options');
                $thumbnail_id = $blog_options['default_featured_image'];
            }
            $arr[] = [
                'url' => get_permalink($post->ID),
                'title' => $post->post_title,
                'featured_image_id' => $thumbnail_id,
                'excerpt' => get_the_excerpt($post),
                'author_name' => get_the_author_meta('display_name', $post->post_author),
                'date' => get_the_date('', $post),
                'category' => $first_category_name
            ];
        }
    }
    return $arr;
});

// Popular posts
function wpb_set_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Disable gutenberg
add_filter("use_block_editor_for_post_type", function () {
    return false;
});

// Get translated post url for language switchers

add_filter('current_permalink_translated', function ($locale) {
    $permalink = "/" . $locale;
    if (is_single() || is_page()) {
        $language_code_with_fallback = $locale ? $locale : 'en';
        $translated_post_id = apply_filters('wpml_object_id', get_the_id(), get_post_type(), false, $language_code_with_fallback);
        if ($translated_post_id && $translated_post_id !== get_the_id()) {
            $permalink = apply_filters('wpml_permalink', get_the_permalink(), $language_code_with_fallback);
        }
    }
    return $permalink;
}, 10, 3);





