<?php
/*
Plugin Name: RSS Custom Fields
Plugin URI: http://redyellow.co.uk/plugins/rss-custom-fields/
Description: Allow your RSS feed to display custom fields - <a href="options-general.php?page=rss-custom-fields.php">Settings</a>
Author: Rich Gubby
Version: 1.2.1
Author URI: http://redyellow.co.uk/
*/

require_once('functions.php');

if(!is_admin())
{
	
	// Activate the plugin
	add_action('rss_item', 'rssCustomFieldsContent');
	add_action('atom_entry', 'rssCustomFieldsContent');
	add_action('rss2_item', 'rssCustomFieldsContent');
} else
{
	// Add Settings link to plugin page
	add_filter("plugin_action_links_".plugin_basename(__FILE__), 'rssCustomFieldsActlinks' );
	// Any settings to initialize
	add_action('admin_init', 'rssCustomFieldsAdminInit');
	// Load menu page
	add_action('admin_menu', 'rssCustomFieldsAddAdminPage');
	// Load admin CSS style sheet
	add_action('admin_head', 'rssCustomFieldsRegisterHead');
}

if(!function_exists('rssCustomFieldsContent'))
{
	function rssCustomFieldsContent()
	{
		if(is_feed())
		{
			// Get my custom fields
			$custom = get_post_custom(get_the_ID());
			
			$options = get_option('rss_custom_fields');
			
			// Clean up custom fields
			$customFields = array();
			foreach($custom as $key => $val)
			{
				if(!isset($options['show_hidden_fields']) OR $options['show_hidden_fields'] == 0)
				{
					if(strpos($key,'_') === 0) continue;
				}
				$customFields[$key] = $val;
			}

			// Only display when we have custom fields
			if(!empty($customFields))
			{
				echo '<custom_fields>';
				foreach($customFields as $key => $val)
				{
					echo '<'.$key.'>'.trim($val[0]).'</'.$key.'>';
				}
				echo '</custom_fields>';
			}
		}
	}
}