<?php

// Add CSS styles for Actify specific options to the WordPress Dashboard
function actify_admin_css()
{
	?>
	
	<style type="text/css">
	.actify-post-control
	{
		margin: 0 0 18px 0;
	}
	
	.actify-post-control label
	{
		cursor: default;
	}
	
	.actify-post-control p.add_margin
	{
		padding-bottom: 10px;
		border-bottom: 1px dotted #ccc;
	}
	
	.actify-post-control ul
	{
		margin-left: 6px;
	}
	
	.actify-post-control ul.add_margin
	{
		border-bottom: 1px dotted #ccc;
	}
	
	.actify-post-control ul li
	{
		padding-bottom: 0;
	}
	
	.actify-post-control input.full
	{
		width: 99%;
	}

	.actify-post-control input.short
	{
		width: 160px;
	}	
	
	.actify-post-control input.tiny
	{
		width: 50px;
	}	
	
	.actify-post-control textarea.textbox
	{
		display: block;
		width: 99%;
		height: 100px;
	}
	
	.actify-post-control div.title
	{
		margin: 0 0 8px 6px;
		padding: 0;
		font-size: 1.1em;
		font-weight: bold;
	}
	
	.actify-post-control div.description
	{
		margin: 0 0 8px 6px;
		padding: 0;
	}
	
	.actify-post-control .counter
	{
		margin-left: 7px;
		text-align: center;
	}
	</style>
	
	<?php
}
add_action('admin_head', 'actify_admin_css');

function actify_admin_javascript()
{
	?>
	
	<script type="text/javascript">
	function textCounter(inputFieldId, countFieldId, startCount)
	{
		document.getElementById(countFieldId).value = startCount + document.getElementById(inputFieldId).value.length;
	}
	</script>
	
	<?php
}
add_action('admin_head', 'actify_admin_javascript');

// Add Actify specific options to the WordPress Dashboard
if (is_admin())
{
    actify_admin_setup();
}

function actify_admin_setup()
{
	add_action('admin_menu', array('ActifyMetaOptions', 'add_meta_boxes'));
}

class ActifyMetaOptions
{
	function add_meta_boxes()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();

		foreach ($page_options->page_meta_boxes as $meta_name => $meta_box)
		{
			add_meta_box($meta_box['id'], $meta_box['title'], array('ActifyMetaOptions', "output_{$meta_name}_box"), 'page', 'normal', 'high');
		}

		add_action('save_post', array('ActifyMetaOptions', 'save_meta'));
	}
	
	// The existence of these functions is an unbearable inefficiency, but add_meta_box() is severely limited and cannot accommodate a more efficient solution :(
	
	/*function output_seo_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 60;
		$page_options->output_meta_box($page_options->page_meta_boxes['seo'], $tabindex);
	}
	
	function output_form_spinfire_trial_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 90;
		$page_options->output_meta_box($page_options->page_meta_boxes['form_spinfire_trial'], $tabindex);
	}
	
	function output_form_spinfire_reader_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 120;
		$page_options->output_meta_box($page_options->page_meta_boxes['form_spinfire_reader'], $tabindex);
	}
	
	function output_form_white_paper_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 150;
		$page_options->output_meta_box($page_options->page_meta_boxes['form_white_paper'], $tabindex);
	}
	
	function output_form_register_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 180;
		$page_options->output_meta_box($page_options->page_meta_boxes['form_register'], $tabindex);
	}
	
	function output_form_spinfire_trial_no_download_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 210;
		$page_options->output_meta_box($page_options->page_meta_boxes['form_spinfire_trial_no_download'], $tabindex);
	}

	function output_sidebar_box_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 240;
		$page_options->output_meta_box($page_options->page_meta_boxes['sidebar_box'], $tabindex);
	}
	
	function output_sidebar_quote_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 270;
		$page_options->output_meta_box($page_options->page_meta_boxes['sidebar_quote'], $tabindex);
	}
	
	function output_sidebar_image_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 300;
		$page_options->output_meta_box($page_options->page_meta_boxes['sidebar_image'], $tabindex);
	}
	
	function output_floating_ad_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 330;
		$page_options->output_meta_box($page_options->page_meta_boxes['floating_ad'], $tabindex);
	}
	
	function output_press_release_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 360;
		$page_options->output_meta_box($page_options->page_meta_boxes['press_release'], $tabindex);
	}*/
	
	function output_landing_page_box()
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();
		$tabindex = 390;
		$page_options->output_meta_box($page_options->page_meta_boxes['landing_page'], $tabindex);
	}
	
	function output_meta_box($meta_box, $tabindex)
	{
		global $post;
		if ($meta_box)
		{
			foreach ($meta_box['fields'] as $meta_id => $meta_field)
			{
				// Spit out the actual form on the WordPress post page
				$existing_value = get_post_meta($post->ID, $meta_field['name'], true);
				$value = ($existing_value != '') ? $existing_value : $meta_field['default'];
				$margin = $meta_field['margin'] ? ' class="add_margin"' : '';
				
				// If the counter value needs to include the length of a string already
				$counter_start_value = $meta_field['counter_include'] ? strlen($meta_field['counter_include']) : 0;

				echo "<div id=\"$meta_id\" class=\"actify-post-control\">\n";
				$description = $meta_field['description'] ? "<div class=\"description\">{$meta_field['description']}</div>" : '';

				if ($meta_field['title'])
				{
					echo "<div class=\"title\">{$meta_field['title']}</div>\n";
				}

				if ($description)
				{
					echo $description;
				}

				if (is_array($meta_field['type']))
				{
					echo "<ul$margin>\n";
					$type = $meta_field['type']['type'];

					if ($type == 'radio')
					{
						$options = $meta_field['type']['options'];
						$default = $meta_field['default'];

						foreach ($options as $option_value => $label) 
						{
							if ($existing_value)
							{
								$checked = ($existing_value == $option_value) ? ' checked="checked"' : '';
							}
							elseif ($option_value == $default)
							{
								$checked = ' checked="checked"';
							}
							else
							{
								$checked = '';
							}

							if ($option_value == $default)
							{
								$option_value = '';
							}

							echo "\t<li><input type=\"$type\" name=\"{$meta_field['name']}\" value=\"$option_value\"$checked tabindex=\"$tabindex\" id=\"{$meta_field['name']}[$option_name]\" /> <label for=\"{$meta_field['name']}[$option_name]\">$label</label></li>\n";
						}
					}
					elseif ($type == 'checkbox')
					{
						$options = $meta_field['type']['options'];
						foreach ($options as $option_name => $option)
						{
							$checked = ($value[$option_name] || (!isset($value[$option_name]) && $option['default'])) ? ' checked="checked"' : '';
							echo "\t<li><input type=\"hidden\" name=\"{$meta_field['name']}[$option_name]\" value=\"0\" /><input type=\"$type\" name=\"{$meta_field['name']}[$option_name]\" value=\"1\"$checked tabindex=\"$tabindex\" id=\"{$meta_field['name']}[$option_name]\" /> <label for=\"{$meta_field['name']}[$option_name]\">{$option['label']}</label></li>\n";
						}
					}

					echo "</ul>\n";
				}	
				elseif ($meta_field['type'] == 'text')
				{
					$input_value_length = strlen($value) + $counter_start_value;
				
					$width = $meta_field['width'] ? " {$meta_field['width']}" : '';
					$add_class = $meta_field['counter'] ? ' count_field' : '';
					$add_counter = $meta_field['counter'] ? "\t<input type=\"text\" readonly=\"readonly\" class=\"counter\" size=\"2\" maxlength=\"3\" value=\"" . $input_value_length . "\" id=\"{$meta_field['name']}_counter\">\n\t{$meta_field['counter']}\n" : '';
					$add_counter_javascript = $meta_field['counter'] ? "onkeyup=\"textCounter('{$meta_field['name']}', '{$meta_field['name']}_counter', $counter_start_value);\" onchange=\"textCounter('{$meta_field['name']}', '{$meta_field['name']}_counter', $counter_start_value);\"" : '';
					echo "<p$margin>\n\t<input type=\"text\" class=\"text_input$width$add_class\" id=\"{$meta_field['name']}\" name=\"{$meta_field['name']}\" value=\"$value\" tabindex=\"$tabindex\" $add_counter_javascript />\n";
					echo "\t<label for=\"{$meta_field['name']}\">{$meta_field['label']}</label>\n$add_counter</p>\n";
				}
				elseif ($meta_field['type'] == 'textarea')
				{
					$input_value_length = strlen($value) + $counter_start_value;
				
					$add_class = $meta_field['counter'] ? ' class="count_field"' : '';
					$add_counter = $meta_field['counter'] ? "\t<input type=\"text\" readonly=\"readonly\" class=\"counter\" size=\"2\" maxlength=\"3\" value=\"" . $input_value_length . "\" id=\"{$meta_field['name']}_counter\">\n\t{$meta_field['counter']}\n" : '';
					$add_counter_javascript = $meta_field['counter'] ? "onkeyup=\"textCounter('{$meta_field['name']}', '{$meta_field['name']}_counter', $counter_start_value);\" onchange=\"textCounter('{$meta_field['name']}', '{$meta_field['name']}_counter', $counter_start_value);\"" : '';
					echo "<p$margin>\n\t<textarea class=\"textbox\" id=\"{$meta_field['name']}\"$add_class name=\"{$meta_field['name']}\" tabindex=\"$tabindex\" onkeydown=\"textCounter('{$meta_field['name']}', '{$meta_field['name']}_counter', $counter_start_value);\" $add_counter_javascript>$value</textarea>\n";
					echo "\t<label for=\"{$meta_field['name']}\">{$meta_field['label']}</label>\n$add_counter</p>\n";
				}
				elseif ($meta_field['type'] == 'checkbox')
				{
					$checked = $value ? ' checked="checked"' : '';
					echo "<p$margin><input type=\"checkbox\" id=\"{$meta_field['name']}\" name=\"{$meta_field['name']}\" value=\"1\"$checked tabindex=\"$tabindex\" /> <label for=\"{$meta_field['name']}\">{$meta_field['label']}</label></p>\n";
				}

				echo "</div>\n";
				$tabindex++;
			}

			echo "\t<input type=\"hidden\" name=\"{$meta_box['noncename']}_noncename\" id=\"{$meta_box['noncename']}_noncename\" value=\"" . wp_create_nonce(plugin_basename(__FILE__)) . "\" />\n";
		}
	}
	
	function save_meta($post_id)
	{
		$page_options = new ActifyMetaOptions();
		$page_options->page_meta_boxes();

		// We have to make sure all new data came from the proper entry fields
		foreach($page_options->page_meta_boxes as $meta_box)
		{
			if (!wp_verify_nonce($_POST[$meta_box['noncename'] . '_noncename'], plugin_basename(__FILE__)))
			{
				return $post_id;
			}
		}
	
		// Check that the user has permission to edit this post/page
		if ($_POST['post_type'] == 'page')
		{
			if (!current_user_can('edit_page', $post_id))
			{
				return $post_id;
			}
		}
		else
		{
			if (!current_user_can('edit_post', $post_id))
			{
				return $post_id;
			}
		}

		// Save the data
		foreach ($page_options->page_meta_boxes as $meta_box)
		{
			foreach ($meta_box['fields'] as $meta_field)
			{
				// Only deal with the Actify specific options
				if (strpos($meta_field['name'], 'actify_') === 0)
				{
					$current_data = get_post_meta($post_id, $meta_field['name'], true);
					$new_data = $_POST[$meta_field['name']];

					// Multi-checkboxes or radio buttons
					if (isset($meta_field['type']['type']) && $meta_field['type']['type'] == 'checkbox' && is_array($meta_field['type']['options']))
					{
						foreach ($meta_field['type']['options'] as $option_name => $option)
						{
							if ((bool) $new_data[$option_name] != (bool) $option['default'])
							{
								$new_data[$option_name] = (bool) $new_data[$option_name];
							}
							elseif ((bool) $new_data[$option_name] == (bool) $option['default'])
							{
								unset($new_data[$option_name]);
							}
						}

						if ($new_data)
						{
							update_post_meta($post_id, $meta_field['name'], $new_data);
						}
						else
						{
							delete_post_meta($post_id, $meta_field['name']);
						}
					}
					// Single checkboxes
					else if ($meta_field['type'] == 'checkbox')
					{
						if ((bool) $new_data != (bool) $meta_field['default'])
						{
							$new_data = (bool) $new_data;
						}
						elseif ((bool) $new_data == (bool) $meta_field['default'])
						{
							unset($new_data);
						}
						
						if ($new_data)
						{
							update_post_meta($post_id, $meta_field['name'], $new_data);
						}
						else
						{
							delete_post_meta($post_id, $meta_field['name']);
						}
					}
					// Text fields
					else
					{
						if ($current_data != '')
						{
							if ($new_data == '')
							{
								delete_post_meta($post_id, $meta_field['name']);
							}
							elseif ($new_data == $meta_field['default'])
							{
								delete_post_meta($post_id, $meta_field['name']);
							}
							elseif ($new_data != $current_data)
							{
								update_post_meta($post_id, $meta_field['name'], $new_data);
							}
						}
						elseif ($new_data != '')
						{
							add_post_meta($post_id, $meta_field['name'], $new_data, true);
						}
					}
				}
			}
		}
	}
	
	function page_meta_boxes()
	{
		$this->page_meta_boxes = array(
			/*'seo' => array(
				'id' => 'actify_seo_meta',
				'title' => __('SEO Options', 'actify'),
				'noncename' => 'actify_seo',
				'fields' => array(
					'actify_meta_title' => array(
						'name' => 'actify_title',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Custom Title Tag', 'actify'),
						'description' => __('By default, the name of your page is used in the <code>&lt;title&gt;</code> tag. You can override this below.', 'actify'),
						'label' => __('custom <code>&lt;title&gt;</code> tag', 'actify'),
						'counter' => __('Search engines allow a maximum of 70 characters in the title and " - Actify" is <strong>already included</strong>.', 'actify'),
						'counter_include' => ' - Actify',
						'margin' => true
					),
					'actify_meta_header' => array(
						'name' => 'actify_header',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Custom Header Tag', 'actify'),
						'description' => __('By default, the name of your page is used in the <code>&lt;h1&gt;</code> tag. You can override this below.', 'actify'),
						'label' => __('custom <code>&lt;h1&gt;</code> tag', 'actify'),
						'margin' => true
					),
					'actify_meta_description' => array(
						'name' => 'actify_description',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('Meta Description', 'actify'),
						'description' => __('Entering a <code>&lt;meta&gt;</code> description can help with search engine optimization. It should be both informative and concise.', 'actify'),
						'label' => __('<code>&lt;meta&gt;</code> description', 'actify'),
						'counter' => __('Search engines allow a maximum of roughly 150 characters for the description.', 'actify'),
						'margin' => true
					),
					'actify_meta_keywords' => array(
						'name' => 'actify_keywords',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Meta Keywords', 'actify'),
						'description' => __('Entering <code>&lt;meta&gt;</code> keywords can also help with search engine optimization. Enter a <strong>few</strong> keywords that are relevant to the page. Separate keywords with commas.', 'actify'),
						'label' => __('<code>&lt;meta&gt;</code> keywords', 'actify'),
						'margin' => true
					),
					'actify_meta_robots' => array(
						'name' => 'actify_robots',
						'type' => array(
							'type' => 'checkbox',
							'options' => array(
								'noindex' => array('label' => __('<code>noindex</code> this page', 'actify'), 'default' => false),
								'nofollow' => array('label' => __('<code>nofollow</code> this page', 'actify'), 'default' => false),
								'noarchive' => array('label' => __('<code>noarchive</code> this page', 'actify'), 'default' => false)
							)
						),
						'width' => '',
						'default' => false,
						'title' => __('Robots Meta Tags', 'actify'),
						'label' => '',
						'margin' => false
					)
				)
			),
			'form_spinfire_trial' => array(
				'id' => 'actify_form_spinfire_trial_meta',
				'title' => __('SpinFire Trial Form', 'actify'),
				'noncename' => 'actify_form_spinfire_trial',
				'fields' => array(
					'actify_meta_display_form_spinfire_trial' => array(
						'name' => 'actify_display_form_spinfire_trial',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show SpinFire Trial Form', 'actify'),
						'margin' => false
					),
					'actify_meta_campaign_id_form_spinfire_trial' => array(
						'name' => 'actify_campaign_id_form_spinfire_trial',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Campaign ID', 'actify'),
						'description' => '',
						'label' => __('If you want the form to use a specific Salesforce campaign ID, enter it here.', 'actify'),
						'margin' => false
					),
					'actify_meta_position_form_spinfire_trial' => array(
						'name' => 'actify_position_form_spinfire_trial',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'form_spinfire_reader' => array(
				'id' => 'actify_form_spinfire_reader_meta',
				'title' => __('SpinFire Reader Form', 'actify'),
				'noncename' => 'actify_form_spinfire_reader',
				'fields' => array(
					'actify_meta_display_form_spinfire_reader' => array(
						'name' => 'actify_display_form_spinfire_reader',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show SpinFire Reader Form', 'actify'),
						'margin' => false
					),
					'actify_meta_campaign_id_form_spinfire_reader' => array(
						'name' => 'actify_campaign_id_form_spinfire_reader',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Campaign ID', 'actify'),
						'description' => '',
						'label' => __('If you want the form to use a specific Salesforce campaign ID, enter it here.', 'actify'),
						'margin' => false
					),
					'actify_meta_position_form_spinfire_reader' => array(
						'name' => 'actify_position_form_spinfire_reader',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'form_white_paper' => array(
				'id' => 'actify_form_white_paper_meta',
				'title' => __('White Paper Form', 'actify'),
				'noncename' => 'actify_form_white_paper',
				'fields' => array(
					'actify_meta_display_form_white_paper' => array(
						'name' => 'actify_display_form_white_paper',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show White Paper Form', 'actify'),
						'margin' => false
					),
					'actify_meta_campaign_id_form_white_paper' => array(
						'name' => 'actify_campaign_id_form_white_paper',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Campaign ID', 'actify'),
						'description' => '',
						'label' => __('If you want the form to use a specific Salesforce campaign ID, enter it here.', 'actify'),
						'margin' => false
					),
					'actify_meta_subtitle_form_white_paper' => array(
						'name' => 'actify_subtitle_form_white_paper',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Form Subtitle', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_options_form_white_paper' => array(
						'name' => 'actify_options_form_white_paper',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('White Paper Options', 'actify'),
						'description' => '',
						'label' => __('Enter each white paper on a new line.', 'actify'),
						'margin' => false
					),
					'actify_meta_thank_you_page_id_form_white_paper' => array(
						'name' => 'actify_thank_you_page_id_form_white_paper',
						'type' => 'text',
						'width' => 'tiny',
						'default' => '',
						'title' => __('Page ID of Thank-You Page', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_position_form_white_paper' => array(
						'name' => 'actify_position_form_white_paper',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'form_register' => array(
				'id' => 'actify_form_register_meta',
				'title' => __('Register Form', 'actify'),
				'noncename' => 'actify_form_register',
				'fields' => array(
					'actify_meta_display_form_register' => array(
						'name' => 'actify_display_form_register',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Register Form', 'actify'),
						'margin' => false
					),
					'actify_meta_campaign_id_form_register' => array(
						'name' => 'actify_campaign_id_form_register',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Campaign ID', 'actify'),
						'description' => '',
						'label' => __('If you want the form to use a specific Salesforce campaign ID, enter it here.', 'actify'),
						'margin' => false
					),
					'actify_meta_subtitle_form_register' => array(
						'name' => 'actify_subtitle_form_register',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Form Subtitle', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_interest_form_register' => array(
						'name' => 'actify_interest_form_register',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Registering For', 'actify'),
						'description' => '',
						'label' => __('Product Interest value in Salesforce', 'actify'),
						'margin' => false
					),
					'actify_meta_thank_you_page_id_form_register' => array(
						'name' => 'actify_thank_you_page_id_form_register',
						'type' => 'text',
						'width' => 'tiny',
						'default' => '',
						'title' => __('Page ID of Thank-You Page', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_position_form_register' => array(
						'name' => 'actify_position_form_register',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'form_spinfire_trial_no_download' => array(
				'id' => 'actify_form_spinfire_trial_no_download_meta',
				'title' => __('SpinFire Trial No Download Form (ie. for USB sticks)', 'actify'),
				'noncename' => 'actify_form_spinfire_trial_no_download',
				'fields' => array(
					'actify_meta_thank_you_page_id_form_spinfire_trial_no_download' => array(
						'name' => 'actify_thank_you_page_id_form_spinfire_trial_no_download',
						'type' => 'text',
						'width' => 'tiny',
						'default' => '',
						'title' => __('Page ID of Thank-You Page', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					)
				)
			),
			'sidebar_box' => array(
				'id' => 'actify_sidebar_box_meta',
				'title' => __('Sidebar Box', 'actify'),
				'noncename' => 'actify_sidebar_box',
				'fields' => array(
					'actify_meta_display_sidebar_box1' => array(
						'name' => 'actify_display_sidebar_box1',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Sidebar Box', 'actify'),
						'margin' => false
					),
					'actify_meta_title_sidebar_box1' => array(
						'name' => 'actify_title_sidebar_box1',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Sidebar Box Title', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_content_sidebar_box1' => array(
						'name' => 'actify_content_sidebar_box1',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('Sidebar Box Content', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_position_sidebar_box1' => array(
						'name' => 'actify_position_sidebar_box1',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => true
					),
					'actify_meta_display_sidebar_box2' => array(
						'name' => 'actify_display_sidebar_box2',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Second Sidebar Box', 'actify'),
						'margin' => false
					),
					'actify_meta_title_sidebar_box2' => array(
						'name' => 'actify_title_sidebar_box2',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Second Sidebar Box Title', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_content_sidebar_box2' => array(
						'name' => 'actify_content_sidebar_box2',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('Second Sidebar Box Content', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_position_sidebar_box2' => array(
						'name' => 'actify_position_sidebar_box2',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'sidebar_quote' => array(
				'id' => 'actify_sidebar_quote_meta',
				'title' => __('Sidebar Quote', 'actify'),
				'noncename' => 'actify_sidebar_quote',
				'fields' => array(
					'actify_meta_display_sidebar_quote' => array(
						'name' => 'actify_display_sidebar_quote',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Sidebar Quote', 'actify'),
						'margin' => false
					),
					'actify_meta_quote_sidebar_quote' => array(
						'name' => 'actify_quote_sidebar_quote',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('The Quote:', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_said_by_sidebar_quote' => array(
						'name' => 'actify_said_by_sidebar_quote',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Said By:', 'actify'),
						'description' => '',
						'label' => '',
						'margin' => false
					),
					'actify_meta_position_sidebar_quote' => array(
						'name' => 'actify_position_sidebar_quote',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'sidebar_image' => array(
				'id' => 'actify_sidebar_image_meta',
				'title' => __('Sidebar Image', 'actify'),
				'noncename' => 'actify_sidebar_image',
				'fields' => array(
					'actify_meta_display_sidebar_image1' => array(
						'name' => 'actify_display_sidebar_image1',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Sidebar Image', 'actify'),
						'margin' => false
					),
					'actify_meta_url_sidebar_image1' => array(
						'name' => 'actify_url_sidebar_image1',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Image URL', 'actify'),
						'description' => '',
						'label' => __('If getting this for an image attached to the page, make sure File URL instead of Post URL is selected when copying the URL.', 'actify'),
						'margin' => false
					),
					'actify_meta_link_url_sidebar_image1' => array(
						'name' => 'actify_link_url_sidebar_image1',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Page ID or Link URL', 'actify'),
						'description' => '',
						'label' => __('If you would like the image to be a link, Enter the ID of a WordPress page, or an URL here.', 'actify'),
						'margin' => false
					),
					'actify_meta_position_sidebar_image1' => array(
						'name' => 'actify_position_sidebar_image1',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => true
					),
					'actify_meta_display_sidebar_image2' => array(
						'name' => 'actify_display_sidebar_image2',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Second Sidebar Image', 'actify'),
						'margin' => false
					),
					'actify_meta_url_sidebar_image2' => array(
						'name' => 'actify_url_sidebar_image2',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Second Image URL', 'actify'),
						'description' => '',
						'label' => __('If getting this for an image attached to the page, make sure File URL instead of Post URL is selected when copying the URL.', 'actify'),
						'margin' => false
					),
					'actify_meta_link_url_sidebar_image2' => array(
						'name' => 'actify_link_url_sidebar_image2',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Page ID or Link URL', 'actify'),
						'description' => '',
						'label' => __('If you would like the image to be a link, Enter the ID of a WordPress page, or an URL here.', 'actify'),
						'margin' => false
					),
					'actify_meta_position_sidebar_image2' => array(
						'name' => 'actify_position_sidebar_image2',
						'type' => 'text',
						'width' => 'tiny',
						'default' => 1,
						'title' => __('Sidebar Position', 'actify'),
						'description' => '',
						'label' => __('Sidebar items will be displayed in ascending order according to their position values. (If you do not order them, they will appear in random order.)', 'actify'),
						'margin' => false
					)
				)
			),
			'floating_ad' => array(
				'id' => 'actify_floating_ad_meta',
				'title' => __('Floating Ad', 'actify'),
				'noncename' => 'actify_floating_ad',
				'fields' => array(
					'actify_meta_display_floating_ad' => array(
						'name' => 'actify_display_floating_ad',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => '',
						'description' => '',
						'label' => __('Show Floating Ad', 'actify'),
						'margin' => false
					),
					'actify_meta_frequency_floating_ad' => array(
						'name' => 'actify_frequency_floating_ad',
						'type' => 'text',
						'width' => 'tiny',
						'default' => '',
						'title' => __('Frequency', 'actify'),
						'description' => '',
						'label' => __('Number of hours between each ad display. Use 0 to display on each page view.', 'actify'),
						'margin' => false
					),
					'actify_meta_url_floating_ad' => array(
						'name' => 'actify_url_floating_ad',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Image URL', 'actify'),
						'description' => '',
						'label' => __('If getting this for an image attached to the page, make sure File URL instead of Post URL is selected when copying the URL.', 'actify'),
						'margin' => false
					),
					'actify_meta_link_url_floating_ad' => array(
						'name' => 'actify_link_url_floating_ad',
						'type' => 'text',
						'width' => 'full',
						'default' => '',
						'title' => __('Page ID or Link URL', 'actify'),
						'description' => '',
						'label' => __('If you would like the image to be a link, Enter the ID of a WordPress page, or an URL here.', 'actify'),
						'margin' => false
					)
				)
			),
			'press_release' => array(
				'id' => 'actify_press_release_meta',
				'title' => __('Press Release Options', 'actify'),
				'noncename' => 'actify_press_release',
				'fields' => array(
					'actify_meta_press_release_date' => array(
						'name' => 'actify_press_release_date',
						'type' => 'text',
						'width' => 'short',
						'default' => '',
						'title' => __('Press Release Date', 'actify'),
						'description' => '',
						'label' => __('Use the date format most common in your country.',  'actify'),
						'margin' => false
					)
				)
			),*/
			'landing_page' => array(
				'id' => 'actify_landing_page_meta',
				'title' => __('Landing Page Options', 'actify'),
				'noncename' => 'actify_landing_page',
				'fields' => array(
					/*'actify_meta_hide_menus' => array(
						'name' => 'actify_hide_menus',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => __('Hide All Navigation Menus', 'actify'),
						'description' => __('Useful for ad campaign Landing Pages.', 'actify'),
						'label' => __('Hide menus', 'actify'),
						'margin' => true
					),
					'actify_meta_include_conversion_code' => array(
						'name' => 'actify_include_conversion_code',
						'type' => 'checkbox',
						'width' => '',
						'default' => false,
						'title' => __('Include Conversion Code', 'actify'),
						'description' => __('Used on Thank-You pages to track ad campaign conversions.', 'actify'),
						'label' => __('Include conversion code', 'actify'),
						'margin' => false
					)*/
					'actify_meta_conversion_code' => array(
						'name' => 'actify_conversion_code',
						'type' => 'textarea',
						'width' => false,
						'default' => '',
						'title' => __('Conversion Code', 'actify'),
						'description' => __('Include on Thank You pages', 'actify'),
						'label' => '',
						'margin' => false
					),
				)
			)
		);
	}
}

?>