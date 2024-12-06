<?php
/*
 * Themosis Theme.
 *
 * @author  Julien Lambé <julien@themosis.com>
 * @link 	http://www.themosis.com/
 */


function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*----------------------------------------------------*/
// The directory separator.
/*----------------------------------------------------*/
defined('DS') ? DS : define('DS', DIRECTORY_SEPARATOR);

if (!function_exists('themosis_theme_assets')) {
    /**
     * Return the application theme public assets directory URL.
     * Public assets are stored into the `dist` directory.
     * 
     * @return string
     */
    function themosis_theme_assets()
    {
        if (is_multisite() && SUBDOMAIN_INSTALL) {
            $segments = explode('themes', get_template_directory_uri());
            $theme = (strpos($segments[1], DS) !== false) ? substr($segments[1], 1) : $segments[1];

            return get_home_url() . '/' . CONTENT_DIR . '/themes/' . $theme . '/dist';
        }
 
        return get_template_directory_uri() . '/dist';
    }
}

/*
 * Check if the framework is available.
 */
if (!isset($GLOBALS['themosis'])) {
    /*
     * Those strings are not translated.
     * We want to load only one textdomain for the theme with the domain
     * defined inside the theme.config.php file.
     */
    $text = 'The theme is only compatible with the Themosis framework. Please install the Themosis framework.';
    $title = 'WordPress - Missing framework';

    /*
     * Add a notice in the wp-admin.
     */
    add_action('admin_notices', function () use ($text) {
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $text);
    });

    /*
     * Add a notice in the front-end.
     */
    wp_die($text, $title);
}

/*
 * Retrieve the service container.
 */
$theme = container();

/*
 * Setup the theme paths.
 */
$paths['theme'] = __DIR__ . DS;
$paths['theme.resources'] = __DIR__ . DS . 'resources' . DS;
$paths['theme.admin'] = __DIR__ . DS . 'resources' . DS . 'admin' . DS;

themosis_set_paths($paths);

/*
 * Register all paths into the service container.
 */
$theme->registerAllPaths(themosis_path());

/*
 * Load theme configuration files.
 */
$theme['config.finder']->addPaths([
    themosis_path('theme.resources') . 'config' . DS,
]);

/*
 * Autoloading.
 */
$loader = new \Composer\Autoload\ClassLoader();
$classes = \Themosis\Facades\Config::get('loading');
foreach ($classes as $prefix => $path) {
    $loader->addPsr4($prefix, $path);
}
$loader->register();

/*
 * Register theme views folder path.
 */
$theme['view.finder']->addLocation(themosis_path('theme.resources') . 'views'); 

/*
 * Register theme public assets folder [dist directory].
 */
$theme['asset.finder']->addPaths([
    themosis_theme_assets() => themosis_path('theme') . 'dist',
]);

/*
 * Theme constants.
 */
$constants = new Themosis\Config\Constant($theme['config.factory']->get('constants'));
$constants->make();

/*
 * Register theme textdomain.
 */
defined('THEME_TEXTDOMAIN') ? THEME_TEXTDOMAIN : define('THEME_TEXTDOMAIN', $theme['config.factory']->get('theme.textdomain'));

$theme['action']->add('after_setup_theme', function () {
    load_theme_textdomain(THEME_TEXTDOMAIN, get_template_directory() . '/languages');
});

/*
 * Theme aliases.
 */
$aliases = $theme['config.factory']->get('theme.aliases');

if (!empty($aliases) && is_array($aliases)) {
    foreach ($aliases as $alias => $fullname) {
        class_alias($fullname, $alias);
    }
}

/**
 * Register theme providers.
 */
$providers = $theme['config.factory']->get('providers');

foreach ($providers as $provider) {
    $theme->register($provider);
}

/*
 * Theme cleanup.
 */
if ($theme['config.factory']->get('theme.cleanup')) {
    $theme['action']->add('init', 'themosis_theme_cleanup');
}

/*
 * Theme restriction.
 */
$access = $theme['config.factory']->get('theme.access');

if (!empty($access) && is_array($access)) {
    $theme['action']->add('init', 'themosis_theme_restrict');
}

/*
 * Theme templates.
 */
$templates = new Themosis\Config\Template($theme['config.factory']->get('templates'), $theme['filter']);
$templates->make();

/*
 * Theme image sizes.
 */
$images = new Themosis\Config\Images($theme['config.factory']->get('images'), $theme['filter']);
$images->make();

/*
 * Theme menus.
 */
$menus = new Themosis\Config\Menu($theme['config.factory']->get('menus'));
$menus->make();

/*
 * Theme sidebars.
 */
$sidebars = new Themosis\Config\Sidebar($theme['config.factory']->get('sidebars'));
$sidebars->make();

/*
 * Theme supports.
 */
$supports = new Themosis\Config\Support($theme['config.factory']->get('supports'));
$supports->make();

/*
 * Theme admin files.
 * Autoload files in alphabetical order.
 */
$loader = $theme['loader']->add([
    themosis_path('theme.admin'),
]);

$loader->load();

/*
 * Theme widgets.
 */
$widgetLoader = $theme['loader.widget']->add([
    themosis_path('theme.resources') . 'widgets' . DS,
]);

$widgetLoader->load();

/*
 * Theme global JS object.
 */
$theme['action']->add('wp_head', 'themosis_theme_global_object');

/**
 * Stop editing. Happy development.
 */
function themosis_theme_cleanup()
{
    global $wp_widget_factory;

    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    if (array_key_exists('WP_Widget_Recent_Comments', $wp_widget_factory->widgets)) {
        remove_action('wp_head', [$wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style']);
    }

    add_filter('use_default_gallery_style', '__return_null');
}

/**
 * Callback used to restrict wp-admin access to
 * logged-in users only. Non authenticated users will
 * be redirected to the home page.
 */
function themosis_theme_restrict()
{
    $access = Themosis\Facades\Config::get('theme.access');

    if (is_admin()) {
        $user = wp_get_current_user();
        $role = $user->roles;
        $valid_role = (bool) array_intersect($access, $role);

        if (!$valid_role && !(defined('DOING_AJAX') && DOING_AJAX)  && !(defined('WP_CLI') && WP_CLI)) {
            wp_redirect(home_url());
            exit;
        }
    }
}

/**
 * Callback used to implement a JS global object
 * for your scripts. Complement the asset localize API.
 */
function themosis_theme_global_object()
{
    $namespace = Themosis\Facades\Config::get('theme.namespace');
    $url = admin_url() . Themosis\Facades\Config::get('theme.ajaxurl') . '.php';

    $datas = apply_filters('themosisGlobalObject', []);

    $output = "<script type=\"text/javascript\">\n\r";
    $output .= "//<![CDATA[\n\r";
    $output .= 'var ' . $namespace . " = {\n\r";
    $output .= "ajaxurl: '" . $url . "',\n\r";

    if (!empty($datas)) {
        foreach ($datas as $key => $value) {
            $output .= $key . ': ' . json_encode($value) . ",\n\r";
        }
    }

    $output .= "};\n\r";
    $output .= "//]]>\n\r";
    $output .= '</script>';

    // Output the datas.
    echo $output;
}


function html5blank_conditional_scripts()
{
    if (get_page_template_slug(get_the_ID()) == "homepage-test") {

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.4.1', true); // Conditional script(s)
        wp_enqueue_script('bootstrap');
    }
}

function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('popper');

        wp_register_script('slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.0.0', true); // Conditional script(s)
        wp_enqueue_script('slick');

        wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.10.0', true); // Conditional script(s)
        wp_enqueue_script('scripts');

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.4.1', true); // Conditional script(s)
        wp_enqueue_script('bootstrap');
    }
}


function html5blank_styles()
{
    wp_register_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array()); 
    wp_enqueue_style('slick-theme');

    wp_register_style('slick', get_template_directory_uri() . '/css/slick.css', array());
    wp_enqueue_style('slick');

    if (get_page_template_slug(get_the_ID()) == "homepage-test") {

        wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array());
        wp_enqueue_style('bootstrap-css');

        wp_register_style('stylesheet', get_template_directory_uri() . '/css/style.css', array(), '1.11');
        wp_enqueue_style('stylesheet');
    }

    wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array());
    wp_enqueue_style('bootstrap-css');

    wp_register_style('stylesheet', get_template_directory_uri() . '/css/style.css', array(), '1.21');
    wp_enqueue_style('stylesheet');
} 


add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'html5blank_styles');


add_action('wp_head', 'show_template');
function show_template()
{
    global $template;
    echo basename($template);
}


// NEW CODES
// REGISTER NEW POST TYPE AND FIELDS
// Register custom post type
function custom_register_post_type()
{
	$labels = array(
		'name'               => _x('SpinFire Trials', 'post type general name', 'your-text-domain'),
		'singular_name'      => _x('SpinFire Trial', 'post type singular name', 'your-text-domain'),
		'menu_name'          => _x('SpinFire Trials', 'admin menu', 'your-text-domain'),
		'name_admin_bar'     => _x('SpinFire Trial', 'add new on admin bar', 'your-text-domain'),
		'add_new'            => _x('Add New', 'SpinFire Trial', 'your-text-domain'),
		'add_new_item'       => __('Add New SpinFire Trial', 'your-text-domain'),
		'new_item'           => __('New SpinFire Trial', 'your-text-domain'),
		'edit_item'          => __('Edit SpinFire Trial', 'your-text-domain'),
		'view_item'          => __('View SpinFire Trial', 'your-text-domain'),
		'all_items'          => __('All SpinFire Trials', 'your-text-domain'),
		'search_items'       => __('Search SpinFire Trials', 'your-text-domain'),
		'parent_item_colon'  => __('Parent SpinFire Trials:', 'your-text-domain'),
		'not_found'          => __('No SpinFire Trials found.', 'your-text-domain'),
		'not_found_in_trash' => __('No SpinFire Trials found in Trash.', 'your-text-domain')
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __('Description.', 'your-text-domain'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'spinfire-trails'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'custom-fields')
	);

	register_post_type('spinfire_trials', $args);
}
add_action('init', 'custom_register_post_type');

// Register meta keys properly
function custom_register_meta()
{
	$args = array(
		'type'              => 'string',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'sanitize_text_field',
		// 'auth_callback'     => function () {
		// 	return current_user_can('edit_posts');
		// }
	);

	register_meta('spinfire_trials', 'prospect_email', $args);
	register_meta('spinfire_trials', 'prospect_first_name', $args);
	register_meta('spinfire_trials', 'prospect_last_name', $args);
	register_meta('spinfire_trials', 'prospect_company_name', $args);
	register_meta('spinfire_trials', 'prospect_phone', $args);
	register_meta('spinfire_trials', 'prospect_country', $args);
	register_meta('spinfire_trials', 'prospect_expiration_date', $args);
	register_meta('spinfire_trials', 'prospect_seat_id', $args);
	register_meta('spinfire_trials', 'prospect_product_interest', $args);

	// // For boolean value, set 'type' to 'boolean'
	// $args_boolean = array(
	// 	'type'              => 'boolean',
	// 	'single'            => true,
	// 	'show_in_rest'      => true,
	// 	'sanitize_callback' => 'rest_sanitize_boolean',
	// 	'auth_callback'     => function () {
	// 		return current_user_can('edit_posts');
	// 	}
	// );

	register_meta('spinfire_trials', 'prospect_opt_in', $args);
	register_meta('spinfire_trials', 'prospect_list_id', $args);
	register_meta('spinfire_trials', 'prospect_prospect_id', $args);
	register_meta('spinfire_trials', 'prospect_list_res_id', $args);
}
add_action('init', 'custom_register_meta');

// Add custom fields to custom post type
function custom_add_custom_fields()
{
	add_meta_box(
		'custom_fields_meta_box',
		__('SpinFire Trial Fields', 'your-text-domain'),
		'custom_display_custom_fields',
		'spinfire_trials',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'custom_add_custom_fields');

function custom_display_custom_fields($post)
{
	// Retrieve current values of custom fields
	$prospect_email = get_post_meta($post->ID, 'prospect_email', true);
	$prospect_first_name = get_post_meta($post->ID, 'prospect_first_name', true);
	$prospect_last_name = get_post_meta($post->ID, 'prospect_last_name', true);
	$prospect_company_name = get_post_meta($post->ID, 'prospect_company_name', true);
	$prospect_phone = get_post_meta($post->ID, 'prospect_phone', true);
	$prospect_country = get_post_meta($post->ID, 'prospect_country', true);
	$prospect_expiration_date = get_post_meta($post->ID, 'prospect_expiration_date', true);
	$prospect_seat_id = get_post_meta($post->ID, 'prospect_seat_id', true);
	$prospect_product_interest = get_post_meta($post->ID, 'prospect_product_interest', true);
	$prospect_opt_in = get_post_meta($post->ID, 'prospect_opt_in', true);
	$prospect_list_id = get_post_meta($post->ID, 'prospect_list_id', true);
	$prospect_prospect_id = get_post_meta($post->ID, 'prospect_prospect_id', true);
	$prospect_list_res_id = get_post_meta($post->ID, 'prospect_list_res_id', true);

	// Display fields
?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="prospect_email"><?php _e('Email:', 'your-text-domain'); ?></label></th>
				<td><input type="email" style="width: 100%;" id="prospect_email" name="prospect_email" value="<?php echo esc_attr($prospect_email); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_first_name"><?php _e('First Name:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_first_name" name="prospect_first_name" value="<?php echo esc_attr($prospect_first_name); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_last_name"><?php _e('Last Name:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_last_name" name="prospect_last_name" value="<?php echo esc_attr($prospect_last_name); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_company_name"><?php _e('Company Name:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_company_name" name="prospect_company_name" value="<?php echo esc_attr($prospect_company_name); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_phone"><?php _e('Phone:', 'your-text-domain'); ?></label></th>
				<td><input type="tel" style="width: 100%;" id="prospect_phone" name="prospect_phone" value="<?php echo esc_attr($prospect_phone); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_country"><?php _e('Country:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_country" name="prospect_country" value="<?php echo esc_attr($prospect_country); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_expiration_date"><?php _e('Expiration Date:', 'your-text-domain'); ?></label></th>
				<td><input type="date" style="width: 100%;" id="prospect_expiration_date" name="prospect_expiration_date" value="<?php echo esc_attr($prospect_expiration_date); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_seat_id"><?php _e('Seat ID:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_seat_id" name="prospect_seat_id" value="<?php echo esc_attr($prospect_seat_id); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_product_interest"><?php _e('Product Interest:', 'your-text-domain'); ?></label></th>
				<td><input type="text" style="width: 100%;" id="prospect_product_interest" name="prospect_product_interest" value="<?php echo esc_attr($prospect_product_interest); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_opt_in"><?php _e('Opt In:', 'your-text-domain'); ?></label></th>
				<td>
					<select id="prospect_opt_in" style="width: 100%;" name="prospect_opt_in">
						<option value="true" <?php selected($prospect_opt_in, 'true'); ?>><?php _e('True', 'your-text-domain'); ?></option>
						<option value="false" <?php selected($prospect_opt_in, 'false'); ?>><?php _e('False', 'your-text-domain'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_prospect_id"><?php _e('Prospect ID:', 'your-text-domain'); ?></label></th>
				<td><input type="number" style="width: 100%;" id="prospect_prospect_id" name="prospect_prospect_id" value="<?php echo esc_attr($prospect_prospect_id); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_list_id"><?php _e('List ID:', 'your-text-domain'); ?></label></th>
				<td><input type="number" style="width: 100%;" id="prospect_list_id" name="prospect_list_id" value="<?php echo esc_attr($prospect_list_id); ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="prospect_list_res_id"><?php _e('List Response ID:', 'your-text-domain'); ?></label></th>
				<td><input type="number" style="width: 100%;" id="prospect_list_res_id" name="prospect_list_res_id" value="<?php echo esc_attr($prospect_list_res_id); ?>"></td>
			</tr>
		</tbody>
	</table>
<?php
}


// Save custom fields data
function custom_save_custom_fields($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save custom fields
	$fields = array(
		'prospect_email',
		'prospect_first_name',
		'prospect_last_name',
		'prospect_company_name',
		'prospect_phone',
		'prospect_country',
		'prospect_expiration_date',
		'prospect_seat_id',
		'prospect_product_interest',
		'prospect_opt_in',
		'prospect_list_id',
		'prospect_prospect_id',
		'prospect_list_res_id'
	);

	foreach ($fields as $field) {
		if (isset($_POST[$field])) {
			update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
		}
	}
}
add_action('save_post', 'custom_save_custom_fields');

// GLOBAL VERIABLES

define('SALESFORCE_CLIENT_ID', '3MVG9WtWSKUDG.x6Rk3z1wNU1Ty6NWKXTcsAaQVbMA20ETrf20e0PNgvL_GK9odD3moIjigQlOoO789gFumj1');
define('SALESFORCE_CLIENT_SECRET', '7CA1644185130CF85687015601F6E7EAD4C3D7A55E71FAD968DAE3EC4BBBFEB4');
define('REFRESH_TOKEN', '5Aep861JmND5bFIsad6Zo1kh79DYyG0_zyHs8ZRg_xqcJIbzgWrGBf8_zswtNKaoinAxT7NtKCSMxsNzjMium.I');
define('PARDOT_BUSINESS_UNIT_ID', '0Uv2p000000KypTCAS');
define('X_AUTHORIZATION_KEY', 'AD0E06A4-EB7F-4254-9BAC-C4444238756F'); // LIVE
// define('X_AUTHORIZATION_KEY', '1648B5D5-1299-4CED-AD1B-5B6D55CAFCBD'); // DEMO
define('LIST_ID', 77640); // SpinFire Trial - ALL 2024
// define('LIST_ID', 77829); // SpinFireTrial Test - Dashrath
define('ENGLISH_LIST_ID', 82443); // ENGLISH workflow trials
define('GERMAN_LIST_ID', 82446); // GERMAN workflow trials
// define('ENGLISH_LIST_ID', 82617); // ENGLISH workflow trials TEST
// define('GERMAN_LIST_ID', 82614); // GERMAN workflow trials TEST

// check_salesforce_access_token();

function check_salesforce_access_token()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'sales_force_credentials';
	$table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");

	if (!$table_exists) {
		create_token_tables();
	} else {
		refresh_sales_force_token();
	}
}

function refresh_sales_force_token()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'sales_force_credentials';

	$api_url = 'https://pi.pardot.com/api/v5/objects/lists/' . ENGLISH_LIST_ID . '?fields=id,name';

	// Retrieve Access Token from the database
	$access_token_row = $wpdb->get_row("SELECT * FROM $table_name WHERE `key` = 'access_token'ORDER BY created_at DESC LIMIT 1");


	if ($access_token_row) {
		$access_token = $access_token_row->value;
		// Perform the API request using wp_remote_get()
		$response = wp_remote_get($api_url, array(
			'headers' => array(
				'Content-Type' => 'application/json', // Set content type as JSON
				'Authorization' => 'Bearer ' . $access_token,
				'Pardot-Business-Unit-Id' => PARDOT_BUSINESS_UNIT_ID,
			),
		));
		if (is_wp_error($response)) {
			error_log('Error accessing API: ' . $response->get_error_message());
			return;
		}
		$response_code = wp_remote_retrieve_response_code($response);
		if ($response_code !== 200) {
			generate_access_token();
		}
	} else {
		generate_access_token();
	}
	// Check response status and log it
}

function generate_access_token()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'sales_force_credentials';

	$api_url = 'https://login.salesforce.com/services/oauth2/token';

	$data = array(
		'refresh_token' => REFRESH_TOKEN,
		'client_id' => SALESFORCE_CLIENT_ID,
		'client_secret' => SALESFORCE_CLIENT_SECRET,
		'grant_type' => 'refresh_token' // Ensure this is set to
	);

	// Build the form-urlencoded body
	$body = http_build_query($data);

	$response = wp_remote_post($api_url, array(
		'method' => 'POST',
		'headers' => array(
			'Content-Type' => 'application/x-www-form-urlencoded', // Set content type as x-www-form-urlencoded
		),
		'body' => $body, // Set the request body
	));

	if (is_wp_error($response)) {
		error_log('Error accessing token endpoint: ' . $response->get_error_message());
		return;
	}

	$response_code = wp_remote_retrieve_response_code($response);
	$response_body = wp_remote_retrieve_body($response);

	if ($response_code == 200) {
		$response_data = json_decode($response_body);
		$new_access_token = $response_data->access_token;

		// Use $wpdb->replace() to insert or update the access token
		$wpdb->replace(
			$table_name,
			array(
				'key' => 'access_token',
				'value' => $new_access_token
			),
			array('%s', '%s') // Data types of the values
		);
	} else {
		error_log('Failed Refresh Token ' . $response_code);
		error_log('Body: ' . $response_body);
	}
}

function create_token_tables()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'sales_force_credentials';

	// SQL query to create the table
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        `key` VARCHAR(199),
        value TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

	// Include upgrade.php for dbDelta function
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	// Create or update the table
	dbDelta($sql);
}


// Add custom cron schedule for every two hours
add_filter('cron_schedules', function ($schedules) {
	$schedules['every-2-hours'] = array(
		'interval' => 7200, // 2 hours in seconds
		'display'  => __('Every 2 hours')
	);
	return $schedules;
});

// Schedule the event every two hours
if (!wp_next_scheduled('check_salesforce_access_token_event')) {
	wp_schedule_event(time(), 'every-2-hours', 'check_salesforce_access_token_event');
}

// Hook into the scheduled event
add_action('check_salesforce_access_token_event', 'check_salesforce_access_token');


// CREATE TRIAL
// add_action("wpcf7_mail_sent", "create_trail_cf7_api_sender");
add_action("wpcf7_before_send_mail", "create_trail_cf7_api_sender", 10, 3);

// GET API KEYS
function get_special_key()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'sales_force_credentials';
	$access_token = "";

	// Retrieve the latest access token from the database ordered by created_at in descending order
	$access_token_row = $wpdb->get_row("SELECT * FROM $table_name WHERE `key` = 'access_token' ORDER BY created_at DESC LIMIT 1");

	if ($access_token_row) {
		$access_token = $access_token_row->value;

		// Return the access token along with other keys if needed
		return array(
			'X-Authorization-Key' => X_AUTHORIZATION_KEY,
			'AccessToken' => $access_token,
			'Pardot-Business-Unit-Id' => PARDOT_BUSINESS_UNIT_ID,
		);
	}

	return array(
		'X-Authorization-Key' => X_AUTHORIZATION_KEY,
		'AccessToken' => $access_token,
		'Pardot-Business-Unit-Id' => PARDOT_BUSINESS_UNIT_ID,
	);
}


function create_trail_cf7_api_sender($contact_form, &$abort)
{
	// Start the session if not already started
    if (!session_id()) {
        session_start();
    }
	
	$submission = WPCF7_Submission::get_instance();
	$posted_data = $submission->get_posted_data();
	if ($submission && (isset($posted_data["form_type"]) && $posted_data["form_type"] == "spinfire_trial")) {

		$fname = isset($posted_data["FirstName"]) ? sanitize_text_field($posted_data["FirstName"]) : null;
		$lname = isset($posted_data["LastName"]) ? sanitize_text_field($posted_data["LastName"]) : null;
		$cname = isset($posted_data["CompanyName"]) ? sanitize_text_field($posted_data["CompanyName"]) : null;
		$email = isset($posted_data["Email"]) ? sanitize_email($posted_data["Email"]) : null;
		$phone = isset($posted_data["Phone"]) ? sanitize_text_field($posted_data["Phone"]) : null;
		$country = isset($posted_data["Country"]) && !empty($posted_data["Country"]) ? sanitize_text_field($posted_data["Country"][0]) : null;
		$optin = isset($posted_data["opt_in"]) && !empty($posted_data["opt_in"]) ? true : false;

		// Validate required fields
		if (empty($fname) || empty($lname) || empty($email) || empty($cname) || empty($phone) || empty($country)) {
			$required_fields = array();
			if (empty($fname)) $required_fields[] = "First Name";
			if (empty($lname)) $required_fields[] = "Last Name";
			if (empty($email)) $required_fields[] = "Email";
			if (empty($cname)) $required_fields[] = "Company Name";
			if (empty($phone)) $required_fields[] = "Phone";
			if (empty($country)) $required_fields[] = "Country";

			$error_message = 'The following fields are required: ' . implode(', ', $required_fields);

			// Set status and response message
			$submission->set_status('validation_failed');
			$submission->set_response($contact_form->filter_message($error_message));

			// Abort the submission
			$abort = true;
			return;
		}

		$is_duplicate = check_duplicate_record($email);
		// error_log($is_duplicate);return;

		if ($is_duplicate!==false) {
			// Set an error message
			$submission->set_status('duplicate_email');
			$submission->set_response($contact_form->filter_message('Failed!'));

			// Abort the submission
			$abort = true;
			return;
		}
		// return;

		// Create an array of data to send to the API
		$data = array(
			'FirstName' => $fname,
			'LastName' => $lname,
			'CompanyName' => $cname,
			'Email' => $email,
			'Phone' => $phone,
		);

		// POST DATA
		$postData = array(
			"email" => $email,
			"firstName" => $fname,
			"lastName" => $lname,
			"company" => $cname,
			"phone" => $phone,
			"country" => $country,
			"Marketing_Opt_in__c" => $optin,
		);

		// error_log(json_encode($postData));return false;

		// CREATE A POST AND GET ID
		$post_id = create_or_update_spin_fire_post($postData);

		// URL of the API endpoint
		$api_url = 'https://ordersystem.spinfire.com/TrialLicense/Create'; // Replace with your actual API endpoint

		// Send data to the API
		$response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'headers' => array(
				'Content-Type' => 'application/json', // Set content type as JSON
				'X-Authorization-Key' => X_AUTHORIZATION_KEY
			),
			'body' => json_encode($data), // Encode data as JSON
		));

		// Check if the request was successful
		if (!is_wp_error($response)) {
			// API request was successful, you can handle the response if needed
			$response_code = wp_remote_retrieve_response_code($response); // Get response code
			$response_body = wp_remote_retrieve_body($response); // Get response body

			if ($response_code == 200) {
				$data = json_decode($response_body);

				$prospectData = array(
					"email" => $email,
					"firstName" => $fname,
					"lastName" => $lname,
					"company" => $cname,
					"phone" => $phone,
					"country" => $country,
					"Trial_EOM_Date__c" => $data->ExpirationDate,
					"Seat_ID__c" => $data->SeatId,
					"Product_Interest__c" => "SpinFire Trial", // Unknown Field
					"Marketing_Opt_in__c" => json_encode($optin)
				);

				// Store the Seat ID in the session
				setcookie('seat_id', $data->SeatId, time() + 86400, "/");
                $_SESSION['seat_id'] = $data->SeatId;
				
				// UPDATE DATA INTO POST
				$postUpData = array("Trial_EOM_Date__c" => $data->ExpirationDate, "Seat_ID__c" => $data->SeatId, "Product_Interest__c" => "SpinFire Trial");
				create_or_update_spin_fire_post($postUpData, $post_id);

				// CREATE PROSPECT
				create_prospect($prospectData, $post_id);
				// error_log(' Prospect Data: ' . json_encode($prospectData));
				
				// Set an error message
				$submission->set_status('spinfire_trial_success');
				$submission->set_response($contact_form->filter_message('Success!'));

				// Abort the submission
				$abort = true;
				return;
			}
		} else {
			// API request failed, handle the error
			error_log('API Request Error: ' . $response->get_error_message());
		}
	}
}

// CHECK FOR DUPLICATE EMAIL
function check_duplicate_record($email)
{
	global $wpdb;

	$result = $wpdb->get_row($wpdb->prepare("SELECT *
		FROM $wpdb->posts
		INNER JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
		WHERE $wpdb->postmeta.meta_key = 'prospect_email'
		AND $wpdb->postmeta.meta_value = %s
		AND $wpdb->posts.post_type = 'spinfire_trials'
		LIMIT 1", $email));

	if ($result) {
		// Duplicate record found
		// return true;
		return $result->ID;
	} else {
		// No duplicate record found
		return false;
	}
}




function create_prospect($prospectData, $post_id)
{
	// URL of the API endpoint
	// $api_url = 'https://pi.pardot.com/api/v5/objects/prospects'; // Replace with your actual API endpoint
	$api_url = 'https://pi.pardot.com/api/v5/objects/prospects/do/upsertLatestByEmail'; // Replace with your actual API endpoint

	$theData = array(
		'matchEmail'=>$prospectData['email'],
		'prospect'=>$prospectData,
		'fields'=>array('id'),
		'secondaryDeletedSearch'=> false
	);

	$response = wp_remote_post($api_url, array(
		'method' => 'POST',
		'headers' => array(
			'Content-Type' => 'application/json', // Set content type as JSON
			'Authorization' => 'Bearer ' . get_special_key()["AccessToken"],
			'Pardot-Business-Unit-Id' => get_special_key()["Pardot-Business-Unit-Id"]
		),
		'body' => json_encode($theData), // Encode data as JSON
	));

	// Check if the request was successful
	if (!is_wp_error($response, $post_id)) {
		// API request was successful, you can handle the response if needed
		if (!is_wp_error($response)) {
			// API request was successful, you can handle the response if needed
			$response_code = wp_remote_retrieve_response_code($response); // Get response code
			$response_body = wp_remote_retrieve_body($response); // Get response body

			// error_log('Prospect Code: ' . $response_code);
			// error_log('Prospect Body: ' . $response_body);

			if ($response_code == 200) {
				$data = json_decode($response_body);
				$prospect_id = $data->id;
				create_or_update_spin_fire_post(array("prospectId" => $prospect_id), $post_id);
				add_prospect_in_list($prospect_id, $post_id, $prospectData);
			} else if ($response_code == 401) {
				check_salesforce_access_token();
				create_prospect($prospectData, $post_id);
			}
		} else {
			// API request failed, handle the error
			error_log('API Request Error: ' . $response->get_error_message());
		}
	}
}

function get_list_id($data)
{
	$german_countries = array('Germany', 'Austria', 'Switzerland');
	error_log(json_encode($data));
	// Check if prospect country is in the excluded list
	if (in_array($data['country'], $german_countries)) {
		error_log(json_encode(GERMAN_LIST_ID));
		return GERMAN_LIST_ID; // Use the actual ID for the German list
	} else {
		error_log(json_encode(ENGLISH_LIST_ID));
		return ENGLISH_LIST_ID; // Use the actual ID for the English test list
	}
}


function add_prospect_in_list($id, $post_id, $prospectData)
{
	$list_id = get_list_id($prospectData);
	// URL of the API endpoint
	$api_url = 'https://pi.pardot.com/api/v5/objects/list-memberships'; // Replace with your actual API endpoint

	$data = array(
		"listId" => $list_id, // list id of agmentation
		"prospectId" => $id
	);

	$response = wp_remote_post($api_url, array(
		'method' => 'POST',
		'headers' => array(
			'Content-Type' => 'application/json', // Set content type as JSON
			'Authorization' => 'Bearer ' . get_special_key()["AccessToken"],
			'Pardot-Business-Unit-Id' => get_special_key()["Pardot-Business-Unit-Id"]
		),
		'body' => json_encode($data), // Encode data as JSON
	));

	// Check if the request was successful
	if (!is_wp_error($response)) {
		// API request was successful, you can handle the response if needed
		$response_code = wp_remote_retrieve_response_code($response); // Get response code
		$response_body = wp_remote_retrieve_body($response); // Get response body
		$response_body = json_decode($response_body); // Get response body
		if($response_code == 400 && (isset($response_body->code) && $response_body->code==58)){
			// error_log('58: ' . $response_code);
			create_or_update_spin_fire_post(array("listId" => $list_id, "list_res_id" => $response_body->code), $post_id);
		}else{
			create_or_update_spin_fire_post(array("listId" => $list_id, "list_res_id" => $response_body->id), $post_id);
		}

		// error_log('List Membership Code: ' . $response_code);
		// error_log('List Membership Body: ' . json_encode($response_body));
	} else {
		// API request failed, handle the error
		error_log('API Request Error: ' . $response->get_error_message());
	}
}

// CREATE Or UPDATE SPIN FIRE POST IF POST ID NOT NULL
function create_or_update_spin_fire_post($data, $post_id = null)
{
	$data = convert_data_before_store($data);
	
	// Initialize title to empty string
	$post_title = '';
	
	// Only set title when creating a new post
	if (!$post_id) {
		$post_id = check_duplicate_record($data['prospect_email']);
		$post_title .= isset($data['prospect_first_name']) ? $data['prospect_first_name'] : '';
		$post_title .= isset($data['prospect_last_name']) ? ' ' . $data['prospect_last_name'] : '';
		$post_title .= ' - SpinFire Trial';
		if(!$post_id){
			
			$post_data = array(
				'post_title'    => $post_title, // Title of the post
				'post_type'     => 'spinfire_trials', // Custom post type
				'post_status'   => "private", // Post status
			);
			
			$post_id = wp_insert_post($post_data); // Insert new post
		}else{
			$post_data = array(
				'ID' => $post_id, // Title of the post
				'post_title' => $post_title, // Title of the post
			);
			
			$post_id = wp_update_post($post_data); // Insert new post
		}
	}

	// Fetch the post by ID
	$post = get_post($post_id);

	// Check if post is successfully fetched
	if ($post) {
		// Save custom fields data
		$custom_fields = array(
			'prospect_email',
			'prospect_first_name',
			'prospect_last_name',
			'prospect_company_name',
			'prospect_phone',
			'prospect_country',
			'prospect_expiration_date',
			'prospect_seat_id',
			'prospect_product_interest',
			'prospect_opt_in',
			'prospect_list_id',
			'prospect_prospect_id',
			'prospect_list_res_id'
		);

		foreach ($custom_fields as $field) {
			if (isset($data[$field]) && !empty($data[$field])) {
				update_post_meta($post_id, $field, sanitize_text_field($data[$field]));
			}
		}

		return $post_id; // Return the ID of the newly created or updated post
	} else {
		return new WP_Error('post_id_invalid', 'Post ID is invalid'); // Return error if post ID is invalid
	}
}



function convert_data_before_store($data)
{
	$converted_data = array(
		'prospect_email' => isset($data['email']) ? $data['email'] : '',
		'prospect_first_name' => isset($data['firstName']) ? $data['firstName'] : '',
		'prospect_last_name' => isset($data['lastName']) ? $data['lastName'] : '',
		'prospect_company_name' => isset($data['company']) ? $data['company'] : '',
		'prospect_phone' => isset($data['phone']) ? $data['phone'] : '',
		'prospect_country' => isset($data['country']) ? $data['country'] : '',
		'prospect_expiration_date' => isset($data['Trial_EOM_Date__c']) ? $data['Trial_EOM_Date__c'] : '',
		'prospect_seat_id' => isset($data['Seat_ID__c']) ? $data['Seat_ID__c'] : '',
		'prospect_product_interest' => isset($data['Product_Interest__c']) ? $data['Product_Interest__c'] : '',
		'prospect_opt_in' => isset($data['Marketing_Opt_in__c']) ? json_encode($data['Marketing_Opt_in__c']) : '',
		'prospect_list_id' => isset($data['listId']) ? $data['listId'] : '',
		'prospect_prospect_id' => isset($data['prospectId']) ? $data['prospectId'] : '',
		'prospect_list_res_id' => isset($data['list_res_id']) ? $data['list_res_id'] : '',
	);

	return $converted_data;
}

// REDIRECT AFTER FORM SUBMISSION

add_action('wp_footer', 'custom_cf7_form_redirect');

function custom_cf7_form_redirect()
{
    $base_url = home_url(); // Get the base URL of the WordPress site
    
    ?>
    <script type="text/javascript">
        document.addEventListener('wpcf7submit', function(event) {
            var inputs = event.detail.inputs;
            var formType = inputs.find(input => input.name === 'form_type');
            
            if (formType && formType.value === 'spinfire_trial') {
				var countryInput = inputs.find(input => input.name === 'Country');
				var country = countryInput ? countryInput.value.trim().toLowerCase() : '';

                console.log('wpcf7submit');
                console.log(event);
                console.log(country);
                var response = event.detail.apiResponse;
                var status = response.status;
                
				var url = '';
                if (status === "duplicate_email") {
					console.log(status);
					if(country === 'germany' || country === 'austria' || country === 'switzerland'){
						url = '<?php echo $base_url ?>/de/spinfire-trial-error-page-de/';
					}else{
						url = '<?php echo $base_url ?>/spinfire-trial-error';
					}
                } else if (status === "spinfire_trial_success") {
					console.log(status);
					if(country === 'germany' || country === 'austria' || country === 'switzerland'){
						url = '<?php echo $base_url ?>/de/spinfire-trial-successful-de/';
					}else {
						url = '<?php echo $base_url ?>/spinfire-trial-thankyou';
					}
				}
				// console.log(url); return false;
				window.location.href = url;
				event.stopImmediatePropagation();
				return false;
            }
        }, false); // Use false to attach the event listener during the bubbling phase

		function getCookie(name) {
            let cookieArr = document.cookie.split(";");
			var seat_id = '';
            for (let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");
                if (name === cookiePair[0].trim()) {
                    seat_id = decodeURIComponent(cookiePair[1]);
                }else{
					seat_id = '=\\=';
				}
            }
            document.getElementsByClassName('seat_id')[0].innerHTML = seat_id;
        }
		if(document.getElementsByClassName('seat_id').length>0){
			getCookie('seat_id');
		}
    </script>
    <?php
}