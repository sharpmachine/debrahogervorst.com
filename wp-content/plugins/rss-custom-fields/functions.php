<?php
if(!function_exists('rssCustomFieldsActlinks'))
{
	function rssCustomFieldsActlinks($links)
	{ 
		// Add a link to this plugins settings page
		$settings_link = '<a href="options-general.php?page=rss-custom-fields">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
}

if(!function_exists('rssCustomFieldsAdmin'))
{
	/**
	 * RSS Custom Fields Admin Page
	 * @access public
	 * @author Rich Gubby
	 * @since 1.0
	 * @return void
	 */
	function rssCustomFieldsAdmin()
	{
		echo '<div class="wrap">';
		echo '<div class="half1">';
		echo '<form method="post" action="options.php">';
		
		echo '<h2>RSS Custom Fields Settings</h2>';
		echo '<p><small>By: Rich Gubby</small></p>';
		echo '<table class="form-table" cellspacing="2" cellpadding="5">';
		
		settings_fields('rssCustomFieldsOptions');
		$options = get_option('rss_custom_fields');
		
		echo '<label>Show Hidden Custom Fields</label><br />';
		echo '<select name="rss_custom_fields[show_hidden_fields]">';
		foreach(array(0 => 'No', 1 => 'Yes') as $key => $val)
		{
			echo '<option value="'.$key.'" '.selected('1', $options['show_hidden_fields']).'>'.$val.'</option>';
		}
		echo '</select><br />';
		
		echo '<span class="description">Show all hidden custom fields in your RSS feed - you will get the latest update time, etc</span>';
		
		echo '</table><br /><p class="submit"><input class="button-primary" type="submit" value="'.__('Save Changes').'" /></p>';
		echo '</form><p>&nbsp;</p></div>
		
		<div class="half2">
			<h3>Donate</h3>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=rgubby%40googlemail%2ecom&lc=GB&item_name=Richard%20Gubby%20%2d%20WordPress%20plugins&currency_code=GBP&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted"><img class="floatright" src="'.WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/donate.png" /></a>
			<p>If you like this plugin, keep it Ad free and in a constant state of development by <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=rgubby%40googlemail%2ecom&lc=GB&item_name=Richard%20Gubby%20%2d%20WordPress%20plugins&currency_code=GBP&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted">donating</a> to the cause!</p> 
			<h3>Follow me</h3>
			<p>
			<a href="http://twitter.com/zqxwzq"><img class="floatleft" src="'.WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/follow.png" /></a>
			<p>I\'m on Twitter - make sure you <a href="http://twitter.com/zqxwzq">follow me</a>!</p>
			
			<h3>Other plugins you might like...</h3>
			<h4>Wapple Architect Mobile Plugin</h4>
			<a href="plugin-install.php?tab=search&type=term&s=wapple"><img class="floatright" src="'.WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/WAMP.png" alt="Wapple Architect Mobile Plugin" title="Wapple Architect Mobile Plugin" /></a>
			<p>The Wapple Architect Mobile Plugin for WordPress mobilizes your blog so your visitors can read your posts whilst they are on their mobile phone!</p>
			<p>Head over to <a href="http://wordpress.org/extend/plugins/wapple-architect/">http://wordpress.org/extend/plugins/wapple-architect/</a> and install it now
			or jump straight to the <a href="plugin-install.php?tab=search&type=term&s=wapple">Plugin Install Page</a></p>
			
			<h4>WordPress Mobile Admin</h4>
			<a href="plugin-install.php?tab=search&type=term&s=wordpress+mobile+admin+wapple"><img class="title floatleft" src="'.WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/WMA.png" alt="WordPress Mobile Admin" title="WordPress Mobile Admin" /></a>
			<p>WordPress Mobile Admin allows you to create posts from your 
			mobile, upload photots, moderate comments and perform basic post/page management.</p>
			<p>Download it from <a href="http://wordpress.org/extend/plugins/wordpress-mobile-admin/">http://wordpress.org/extend/plugins/wordpress-mobile-admin/</a> or
			jump straight to the <a href="plugin-install.php?tab=search&type=term&s=wordpress+mobile+admin+wapple">Plugin Install Page</a>
		</div>
		</div>';
	}
}

if(!function_exists('rssCustomFieldsAddAdminPage'))
{
	/**
	 * Setup the Admin Page
	 * @access public
	 * @author Rich Gubby
	 * @since 1.0
	 * @return void
	 */
	function rssCustomFieldsAddAdminPage()
	{
		add_options_page('RSS Custom Fields Options', 'RSS Custom Fields', 'administrator', 'rss-custom-fields', 'rssCustomFieldsAdmin');
	}
}

if(!function_exists('rssCustomFieldsAdminInit'))
{
	/**
	 * Initialize any settings
	 * @access public
	 * @author Rich Gubby
	 * @since 1.0
	 * @return void
	 */
	function rssCustomFieldsAdminInit()
	{
		register_setting('rssCustomFieldsOptions', 'rss_custom_fields');
	}
}

if(!function_exists('rssCustomFieldsRegisterHead'))
{
	/**
	 * Setup admin CSS
	 * @access public
	 * @author Rich Gubby
	 * @since 1.0
	 * @return void
	 */
	function rssCustomFieldsRegisterHead()
	{
		$url = WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/rss-custom-fields.css';
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$url."\" />\n";	
	}
}