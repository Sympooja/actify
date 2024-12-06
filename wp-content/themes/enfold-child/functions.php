<?php

// Functions in this file must be updated if a new language is added
require_once(get_stylesheet_directory() . '/functions/language_specific.php');

// Functions in this file handle what extra options are displayed on the Page writing screen
require_once(get_stylesheet_directory() . '/functions/meta_options.php');

// Functions in this file handle the Gravity Forms submissions and look
require_once(get_stylesheet_directory() . '/functions/forms.php');

// Set Avia Layout Builder mode to debug
/*add_action('avia_builder_mode', "builder_set_debug");
function builder_set_debug()
{
	return "debug";
}*/

// Add a new hook close to after the opening <body> tag
// (It would be right after, but it breaks the layout)
function actify_after_body()
{
	do_action('actify_after_body');
}

// Remove Enfold backlink from footer
function actify_remove_avia_backlink()
{
	return '';
}
add_filter('kriesi_backlink', 'actify_remove_avia_backlink');

// Remove the Enfold language flags
function actify_avia_remove_main_menu_flags()
{
	remove_filter('wp_nav_menu_items', 'avia_append_lang_flags', 20, 2);
	remove_filter('avf_fallback_menu_items', 'avia_append_lang_flags', 20, 2);
	remove_action('avia_meta_header', 'avia_wpml_language_switch', 10);
}
add_action('after_setup_theme','actify_avia_remove_main_menu_flags');

// Remove "Private:" and "Protected:" from private/protected post titles
function actify_private_protected_title_format($content)
{
	// Tell it to just use the title without appending anything
	return '%s';
}
add_filter('private_title_format', 'actify_private_protected_title_format');
add_filter('protected_title_format', 'actify_private_protected_title_format');

// Add the CSS and JS files to the header
function actify_scripts()
{
	wp_enqueue_style('fancybox-css', get_stylesheet_directory_uri() . '/js/fancybox/jquery.fancybox.css');
	
	wp_enqueue_script('actify', get_stylesheet_directory_uri() . '/js/actify.js', array('jquery'));
	wp_enqueue_script('fitvids', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js', array('jquery'));
	wp_enqueue_script('mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel-3.0.6.pack.js', array('jquery'));
	wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/js/fancybox/jquery.fancybox.js', array('jquery'));
	wp_enqueue_script('fancybox-media', get_stylesheet_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-media.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'actify_scripts');

// Add the Google Analytics code to the header
function actify_display_analytics()
{
	echo "\n\n" . actify_get_analytics_code() . "\n\n";
}
add_action('wp_head', 'actify_display_analytics');

// Add the conversion code before the closing </body> tag
function actify_output_adwords_conversion_code()
{
	global $post;

	// Show the conversion code if provided
	$conversion_code = get_post_meta($post->ID, 'actify_conversion_code', true);
	if ($conversion_code !== '')
	{
		echo $conversion_code;
	}
}
add_action('wp_footer', 'actify_output_adwords_conversion_code', 1);

// Add the conversion code before the closing </body> tag
function actify_output_postcard_mania_remarketing_code()
{
	?>
	
	<!-- Google Code for www.actify.com -->
	<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 960795260;
	var google_conversion_label = "LA4ACKPTwVkQ_KSSygM";
	var google_custom_params = window.google_tag_params;
	var google_remarketing_only = true;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/960795260/?value=1.00&amp;currency_code=USD&amp;label=LA4ACKPTwVkQ_KSSygM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	
	<?php
}
add_action('wp_footer', 'actify_output_postcard_mania_remarketing_code', 2);

// Add the hidden trial form to the bottom of every page
function actify_output_hidden_trial_form()
{
	?>
	
	<!-- FancyBox for Download Trial now popup -->
	<div class="fancybox-hidden" style="display: none;">
	<div id="fancyboxID-0">
	<?php gravity_form(1, $display_title=true, $display_description=false, $display_inactive=false, $field_values=null, $ajax=true, $tabindex); ?>
	</div></div>
	
	<?php
}
add_action('wp_footer', 'actify_output_hidden_trial_form');

function actify_get_arm_xml_namespace($type)
{
	if ($type == 'plugins')
	{
		$type = 'addins';
	}

	return "http://www.actify.com/namespaces/$type";
}

function actify_get_latest_sf11_importer_arm_xml_data($post_id)
{
	libxml_use_internal_errors(true); // Suppress xml errors
	try
	{
		$xml_string = @file_get_contents('http://arm.actify.com/importers/released/spinfire11'); // Suppress warning
		return new SimpleXMLElement($xml_string, 0, FALSE, actify_get_arm_xml_namespace('importers'), false);
	}
	catch (Exception $e)
	{
		// Send email to administrator so they can fix the problem
		wp_mail(get_option('admin_email'), 'Error Displaying CAD Importers', get_permalink($post_id));
		
		return null;
	}
}

function actify_get_latest_importer_arm_xml_data($post_id)
{
	libxml_use_internal_errors(true); // Suppress xml errors
	try
	{
		$xml_string = @file_get_contents('http://arm.actify.com/importers/released/spinfire10'); // Suppress warning
		return new SimpleXMLElement($xml_string, 0, FALSE, actify_get_arm_xml_namespace('importers'), false);
	}
	catch (Exception $e)
	{
		// Send email to administrator so they can fix the problem
		wp_mail(get_option('admin_email'), 'Error Displaying CAD Importers', get_permalink($post_id));
		
		return null;
	}
}

// Get rid of the slashes added to request variables
function actify_remove_wp_magic_quotes()
{
	$_GET    = stripslashes_deep($_GET);
	$_POST   = stripslashes_deep($_POST);
	$_COOKIE = stripslashes_deep($_COOKIE);
	$_REQUEST = stripslashes_deep($_REQUEST);
}

// Holds functions for adding menus to the Tools admin menu
class actify_admin_tools
{
	// Create the Clear Trial Emails admin screen
	function clear_trial_emails_menu()
	{
		add_management_page('Clear Trial Emails', 'Clear Trial Emails', 'publish_posts', 'clear-trial-emails', array('actify_admin_tools', 'clear_trial_emails_menu_page'));
	}

	// Output HTML for Clear Trial Emails admin screen
	function clear_trial_emails_menu_page()
	{
		if ( !current_user_can('administrator') )
		{
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		?>
		
		<style>
			#actify-clear-trial-emails-spinner, #actify-clear-trial-emails-result
			{
				display: none;
				height: 25px;
				margin-top: 8px;
			}
			
			#actify-clear-trial-emails-spinner
			{
				display: none;
				height: 25px;
				margin-top: 8px;
				padding-left: 30px;
				background: url('/wp-admin/images/spinner-2x.gif') no-repeat;
				background-size: 25px 25px;
			}
		</style>
		
		<script type="text/javascript">
			function actify_clear_trial_emails()
			{
				if (confirm("Are you sure?") == false)
				{
					return;
				}
				
				jQuery('#actify-clear-trial-emails-button').prop('disabled', true);
				jQuery('#actify-clear-trial-emails-spinner').show();
				jQuery('#actify-clear-trial-emails-result').hide();
				
				var data = {
					'action': 'actify_clear_trial_emails'
				};

				jQuery.post(ajaxurl, data, function(response)
				{
					if (response == 1)
					{
						jQuery('#actify-clear-trial-emails-result').html('<strong>Completed</strong>');
					}
					else
					{
						jQuery('#actify-clear-trial-emails-result').html('Failed');
					}
				
					jQuery('#actify-clear-trial-emails-spinner').hide();
					jQuery('#actify-clear-trial-emails-result').show();
					jQuery('#actify-clear-trial-emails-button').prop('disabled', false);
				});
			}
		</script>
		
		<h3>Clear Trial Emails</h3>
		<p>Reset the trial emails database so users can download a new SpinFire Professional trial.</p>
		<form method="post" action="">
			<input type="button" id="actify-clear-trial-emails-button" onClick="javascript:actify_clear_trial_emails();" class="button" value="Clear" />
			<div id="actify-clear-trial-emails-spinner">Processing...</div>
			<div id="actify-clear-trial-emails-result"></div>
		</form>
		<?php
	}

	// Ajax callback for Regenerate button on Clear Trial Emails admin screen
	function clear_trial_emails_callback()
	{
		ob_clean();

		echo self::clear_trial_emails();

		die(); // this is required to terminate immediately and return a proper response
	}

	function clear_trial_emails()
	{
		global $wpdb;
		
		$wpdb->query('DELETE FROM actify_trial_users');
		
		return 1; // Ajax success code
	}	
}
add_action('admin_menu', array('actify_admin_tools', 'clear_trial_emails_menu'));
add_action('wp_ajax_actify_clear_trial_emails', array('actify_admin_tools', 'clear_trial_emails_callback'));

// This code is almost verbatim from a plugin called Fancy Excerpt (http://wordpress.org/extend/plugins/sem-fancy-excerpt/)
// It is modified because there was nowhere to set the 'Read more' text
class actify_fancy_excerpt
{
	/**
	 * trim_excerpt()
	 *
	 * @param string $text
	 * @return string $text
	 **/
	function trim_excerpt($text)
	{
		$text = trim($text);

		if ( $text || !in_the_loop() )
			return wp_trim_excerpt($text);

		$more = __('Continue Reading...', 'actify');

		$text = get_the_content($more);
		$text = str_replace(array("\r\n", "\r"), "\n", $text);
		#dump(esc_html($text));

		if ( !preg_match("|" . preg_quote($more, '|') . "</a>$|", $text)
			&& count(preg_split("~\s+~", trim(strip_tags($text)))) > 30
		)
		{
			global $escape_fancy_excerpt;
			$escape_fancy_excerpt = array();
			
			$text = actify_fancy_excerpt::escape($text);
			
			$bits = preg_split("/(<(?:h[1-6]|p|ul|ol|li|dl|dd|table|tr|pre|blockquote)\b[^>]*>|\n{2,})/i", $text, null, PREG_SPLIT_DELIM_CAPTURE);
			$text = '';
			$length = 0;

			foreach ( $bits as $bit ) {
				$text .= $bit;
				$bit_count = trim(strip_tags($bit));
				if ( $bit_count === '' )
					continue;
				$count += count(preg_split("~\s+~", $bit_count));
				
				if ( $count > 30 )
					break;
			}
			
			$text = actify_fancy_excerpt::unescape($text);
			
			$text = force_balance_tags($text);
			
			$text .= "\n\n"
				. '<p>'
				. apply_filters('the_content_more_link',
					'<a href="'. esc_url(apply_filters('the_permalink', get_permalink())) . '" class="more-link">'
					. $more
					. '</a>')
				. '</p>' . "\n";
		}

		$text = apply_filters('the_content', $text);

		return apply_filters('wp_trim_excerpt', $text, '');
	}
	
	/**
	 * escape()
	 *
	 * @param string $text
	 * @return string $text
	 **/
	function escape($text)
	{
		global $escape_fancy_excerpt;
		
		if ( !isset($escape_fancy_excerpt) )
			$escape_fancy_excerpt = array();
		
		foreach ( array(
			'blocks' => "/
				<\s*(script|style|object|textarea)(?:\s.*?)?>
				.*?
				<\s*\/\s*\\1\s*>
				/isx",
			) as $regex ) {
			$text = preg_replace_callback($regex, array('actify_fancy_excerpt', 'escape_callback'), $text);
		}
		
		return $text;
	}
	
	/**
	 * escape_callback()
	 *
	 * @param array $match
	 * @return string $text
	 **/
	function escape_callback($match)
	{
		global $escape_fancy_excerpt;
		
		$tag_id = "----escape_fancy_excerpt:" . md5($match[0]) . "----";
		$escape_fancy_excerpt[$tag_id] = $match[0];
		
		return $tag_id;
	}
	
	/**
	 * unescape()
	 *
	 * @param string $text
	 * @return string $text
	 **/
	function unescape($text)
	{
		global $escape_fancy_excerpt;
		
		if ( !$escape_fancy_excerpt )
			return $text;
		
		$unescape = array_reverse($escape_fancy_excerpt);
		
		return str_replace(array_keys($unescape), array_values($unescape), $text);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', array('actify_fancy_excerpt', 'trim_excerpt'), 0);



function actify_output_hidden_ultimate_trial_form()
{
        ?>  
    
	<!-- FancyBox for Download Ultimate Trial now popup -->
        <div class="fancybox-hidden" style="display: none;">
        <div id="fancyboxID-1">
        <?php gravity_form(21, $display_title=true, $display_description=false, $display_inactive=false, $field_values=null, $ajax=true, $tabindex); ?>
        </div></div>
    
        <?php
}
add_action('wp_footer', 'actify_output_hidden_ultimate_trial_form');


function actify_output_hidden_data_discovery_assessment_form()
{
	?>
	
	<!-- FancyBox for Data Discovery Assessment popup -->
	<div class="fancybox-hidden" style="display: none;">
	<div id="fancyboxID-22">
	<?php gravity_form(22, $display_title=true, $display_description=false, $display_inactive=false, $field_values=null, $ajax=true, $tabindex); ?>
	</div></div>
	
	<?php
}
add_action('wp_footer', 'actify_output_hidden_data_discovery_assessment_form');

function actify_output_hidden_actify_insight_assessment_form()
{
	?>
	
	<!-- FancyBox for Actify Insight Assessment popup -->
	<div class="fancybox-hidden" style="display: none;">
	<div id="fancyboxID-23">
	<?php gravity_form(23, $display_title=true, $display_description=false, $display_inactive=false, $field_values=null, $ajax=true, $tabindex); ?>
	</div></div>
	
	<?php
}
add_action('wp_footer', 'actify_output_hidden_actify_insight_assessment_form');

?>
