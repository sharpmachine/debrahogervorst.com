<?php

add_action( 'admin_menu', 'tribe_menu_settings' );
add_action( 'admin_init', 'tribe_build_theme_options' );
add_action( 'admin_notices', 'tribe_update_petition' );

/**
 * Return a boolean expression for whether we need a theme update or not
 */
function is_tribe_update()
{
	$state = get_option( 'external_theme_updates-tribe' );
	return ( !empty( $state ) && isset ( $state->update ) && !empty( $state->update ) );
}

/**
 * In UX chronological order, this function does 3 things.
 * First, if there is an update avilalbe, it shows a banner to the
 * user that tells them so.
 * Second, if the user is in the act of updating their theme, it sets a
 * cookie, which triggers #3 on a new page load.
 * Third, if this cookie is set, then we update the Tribe Theme server
 * with this new information
 */
function tribe_update_petition()
{
	// Very important to know how many people are on the latest version
	// If they have updated the theme to a newer version, then
	// update the API with this data.
	if ( get_option( 'tribe_recently_updated' ) !== false )
	{
		$curl = tribe_api_url() . '?updated&url=' . get_site_url();
		tribe_curl( $curl );
		// unset the cookie
		delete_option( 'tribe_recently_updated' );
		/**
		 * BEGIN UPGRADING FROM LEGACY, CLOSE TO METAL
		 *
		 */

		// If they updated to 1.1.1...
		if ( TRIBE_VERSION == "1.1.1" )
		{
			nc_tribe_update_option( 'header-background-color', '#fff' );
			nc_tribe_update_option( 'header-text-color', '#000' );
		}
	}

	$state = get_option( 'external_theme_updates-tribe' );
	//Is there an update to insert?
	if ( tribe_license() && is_super_admin() && is_tribe_update() )
	{
		// if they are in the very act of updating their theme
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'upgrade-theme' && isset( $_GET['theme'] ) && $_GET['theme'] == 'tribe' )
		{
			update_option( 'tribe_recently_updated', 'This works!' );
		}
		else
		{
			add_thickbox();
			$state = $state->update;
			echo '<div class="updated"><p><strong>There is a new version of Tribe available. <a href="' . $state->details_url . '?TB_iframe=true&amp;" class="thickbox" title="Tribe Theme">View version ' . $state->version . ' details</a> or <a class="update-url" href="' . wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=tribe', 'upgrade-theme_tribe' ) . '">update now</a>.</strong></p></div>';
		}
	}
}


function tribe_build_theme_options()
{

	$tribe_settings = tribe_get_options();
	$tribe_settings_defaults = tribe_get_default_options();

	/**
	 * Unfortnately, WordPress themes do not have the
	 * `register_activation_hook()` function that it offers to
	 * plugins. So instead, we check to make sure our theme options are
	 * actually in existence with every page load of the WP dashboard.
	 * Epic fail.
	 */

	if ( $tribe_settings === false || empty( $tribe_settings ) )
	{
		add_option('tribe-settings', $tribe_settings_defaults);
	}

	register_setting(
			'tribe-settings',
			'tribe-settings',
			'tribe_validate'
	);

	add_settings_section(
		'tribe-settings-typography', // DOM id
		'<span class="typography image"></span><span class="text">Typography</span>', // h3
		'tribe_show_typography_settings', // this function call returns nothing
		'tribe-settings'
	);

	add_settings_section(
		'tribe-settings-color',
		'<span class="colors image"></span><span class="text">Colors</span>',
		'tribe_show_color_settings',
		'tribe-settings'
	);

	add_settings_section(
		'tribe-settings-appearance',
		'<span class="appearance image"></span><span class="text">Appearance & Content</span>',
		'tribe_show_appearance_settings',
		'tribe-settings'
	);

	add_settings_section(
		'tribe-settings-mailing',
		'<span class="appearance image"></span><span class="text">Mailing Lists</span>',
		'tribe_show_mailing_settings',
		'tribe-settings'
	);

	add_settings_section(
		'tribe-settings-scripts',
		'<span class="scripts image"></span><span class="text">Scripts</span>',
		'tribe_show_script_settings',
		'tribe-settings'
	);


	add_settings_field(
		'headline-font-family', // used for `id` in DOM
		'<label for="headline-font-family">Headline Font</label>',  // the <label> element
		'tribe_headline_font_family_control', // the function called in controls.php
		'tribe-settings', // the page it appears on
		'tribe-settings-typography' // The section is appears in
	);

	add_settings_field(
		'body-font-family', // used for `id` in DOM
		'<label for="body-font-family">Body Font</label>',  // the <label> element
		'tribe_body_font_family_control', // the function called in controls.php
		'tribe-settings', // the page it appears on
		'tribe-settings-typography' // The section is appears in
	);

	add_settings_field(
		'body-color',
		'<label for="body-color">Font Color</label>',
		'tribe_body_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);

	add_settings_field(
		'link-color',
		'<label for="link-color">Link Color</label>',
		'tribe_link_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);
	add_settings_field(
		'header-background-color',
		'<label for="header-background-color">Header Background Color</label>',
		'tribe_header_background_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);
	add_settings_field(
		'header-text-color',
		'<label for="header-text-color">Header Text Color</label>',
		'tribe_header_text_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);
	add_settings_field(
		'button-color',
		'<label for="button-color">Button Color</label>',
		'tribe_button_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);
	add_settings_field(
		'special-background-color',
		'<label for="button-color">Special Box Background</label>',
		'tribe_special_background_color_control',
		'tribe-settings',
		'tribe-settings-color'
	);
	add_settings_field(
		'sticky-bar-background',
		'<label for="sticky-bar-background">Sticky Bar Background</label>',
		'tribe_sticky_bar_background_control',
		'tribe-settings',
		'tribe-settings-color'
	);

	add_settings_field(
		'sticky-bar-font-color',
		'<label for="sticky-bar-background">Sticky Bar Font Color</label>',
		'tribe_sticky_bar_font_color',
		'tribe-settings',
		'tribe-settings-color'
	);

	add_settings_field(
		'layout',
		'<label for="header-is">Layout</label>',
		'tribe_layout_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);


	add_settings_field(
		'header-contains',
		'<label for="header-is">Header Is...</label>',
		'tribe_header_contains_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'logo',
		'<label for="custom-logo">Custom Logo</label>',
		'tribe_logo_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'default-layout',
		'<label for="default-layout">Sidebars</label>',
		'tribe_default_layout_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'archive_pages_show',
		'<label for="archive_pages_show">Archive Pages Show...</label>',
		'tribe_archive_pages_show_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'featured_image',
		'<label for="featured_image_appears">Featured Image</label>',
		'tribe_featured_image_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'first_paragraph_larger',
		'<label for="make_first_paragraph_larger">Make First Paragraph Larger</label>',
		'tribe_first_paragraph_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'show_previous_next',
		'<label for="show-previous-next">Show Previous / Next links</label>',
		'show_previous_next_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'show_author_box',
		'<label for="show-author-box">Show Author Box</label>',
		'show_author_box_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'404-page',
		'<label for="four-o-four-page">404 Page</label>',
		'tribe_404_page_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'favicon',
		'<label for="custom-favicon">Custom Favicon</label>',
		'tribe_favicon_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'sticky-bar',
		'<label for="post-meta-data">Sticky Bar</label>',
		'tribe_sticky_bar_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'post-meta-data',
		'<label for="post-meta-data">Post Meta Data</label>',
		'tribe_post_meta_data_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'header-scripts',
		'<label for="header-scripts">Header Scripts</label>',
		'tribe_header_scripts_control',
		'tribe-settings',
		'tribe-settings-scripts'
	);

	add_settings_field(
		'footer-scripts',
		'<label for="footer-scripts">Footer Scripts</label>',
		'tribe_footer_scripts_control',
		'tribe-settings',
		'tribe-settings-scripts'
	);

	add_settings_field(
		'footer-text',
		'<label for="footer-text">Footer Text</label>',
		'tribe_footer_text_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'twitter-handle',
		'<label for="twitter-handle">Twitter Handle</label>',
		'tribe_twitter_handle_control',
		'tribe-settings',
		'tribe-settings-appearance'
	);

	add_settings_field(
		'external-service',
		'<label for="external-service">Use External Service</label>',
		'tribe_external_service_control',
		'tribe-settings',
		'tribe-settings-mailing'
	);

	add_settings_field(
		'mailchimp-api-key',
		'<label for="mailchimp-api-key">Mailchimp API Key</label>',
		'tribe_mailchimp_api_control',
		'tribe-settings',
		'tribe-settings-mailing'
	);

	if ( nc_tribe_get_option( 'license-type' ) == 'single' )
	{

		add_settings_section(
		'tribe-settings-manage',
		'<span class="manage image"></span><span class="text">Manage License</span>',
		'tribe_show_manage_settings',
		'tribe-settings'
		);
	}
}


function tribe_menu_settings( $hook )
{
	// Array storing pages that need our CSS and Javascript resources
	$pages = array();

	$pages['theme-settings'] = add_menu_page( 'Tribe Settings', 'Tribe', 'manage_options', 'tribe-settings', 'tribe_settings_page', '', 58);
	add_submenu_page( 'tribe-settings', 'Theme Settings', 'Theme Settings', 'manage_options', 'tribe-settings', 'tribe_settings_page' );

		//$pages['email-marketing'] = add_submenu_page( 'tribe-settings', 'Signup Forms', 'Signup Forms', 'manage_options', 'tribe-email-settings', 'tribe_email_page' );

	$pages['custom-css'] = add_submenu_page( 'tribe-settings', 'Custom CSS', 'Custom CSS', 'manage_options', 'tribe-custom-css', 'tribe_custom_css_page' );

	$pages['custom-functions'] = add_submenu_page( 'tribe-settings', 'Custom Functions', 'Custom Functions', 'manage_options', 'tribe-custom-functions', 'tribe_custom_functions_page' );


	$pages['export-import'] = add_submenu_page( 'tribe-settings', 'Export & Import', 'Export & Import', 'manage_options', 'tribe-export-import', 'tribe_export_import_page' );

	foreach ( $pages as $page )
	{
		add_action( 'load-' . $page, 'tribe_add_resources' );
	}
	wp_enqueue_script('jquery');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'tribe-admin-universal.css', get_template_directory_uri() . '/admin/css/tribe-admin-universal.css');
	wp_enqueue_script( 'tribe-admin-universal.js', get_template_directory_uri() . '/admin/js/tribe-admin-universal.js');//, array('jquery'), 1.0, true);

}

function tribe_show_typography_settings( $args ) { }
function tribe_show_color_settings( $args ) { }
function tribe_show_appearance_settings( $args ) { }
function tribe_show_mailing_settings( $args ) { }
function tribe_show_script_settings( $args ) {
	echo '<p class="main">This is where you can insert Javascript such as Google Analytics. All code must be surrounded in &lt;/script&gt; tags.</p>'; }

/*
 *  Don't delete this empty function. You'll find we need it
 * below
 */
function tribe_show_manage_settings( $args ) { }

/**
 * This function has 3 collections of data: the old data, the new
 * user-entered data, and the validated version of that data
 */
function tribe_validate( $data )
{
	// Annoying that this function is firing when they
	// initially enter their license. Return the data
	// immediately, and TODO1 make this function not fire
	// at all
	if ( isset( $_POST['tribe-settings']['license'] ) )
	{
		return $data;
	}
	else if ( isset( $data['reset'] ) && $data['reset'] == 'true' )
	{
		foreach( tribe_dont_change() as $key )
		{
			$tribe_settings_defaults[ $key ] = nc_tribe_get_option( $key );
		}
		if ( isset( $data['reset'] ) && $data['reset'] == 'true' )
		{
			return $tribe_settings_defaults;
		}
	}
	$tribe_settings = tribe_get_options();
	$tribe_settings_defaults = tribe_get_default_options();
	/**
	 * Handles the favicon uploading process
	 */
	if ( isset( $data['favicon'] ) && $data['favicon'] != nc_tribe_get_option('favicon') )
	{
		if ( substr($data['favicon'], -4 ) == 'jpeg' || substr($data['favicon'], -3 ) == 'jpg' || substr($data['favicon'], -3 ) == 'png' || substr($data['favicon'], -3 ) == 'gif' )
		{
			$wp_upload_dir = wp_upload_dir();
			$wp_upload_path = $wp_upload_dir['path'];
			$wp_upload_url = $wp_upload_dir['url'];

			$dir = wp_upload_dir();
			$source = $dir['path'] . "/" . basename( $data['favicon'] );

			/**
			 * We're giving each new favicon a unique name in case people accidentally
			 * upload a favicon they didn't mean to. We need the old one to be recoverable.
			 */
			$image_name = 'favicon_' . substr( md5(rand() ), 0, 10 ) . '.ico';
			$destination = $wp_upload_path . '/' . $image_name;

			$sizes = array(
				array( 16, 16 ),
				array( 24, 24 ),
				array( 32, 32 ),
				array( 48, 48 ),
			);

			$ico_lib = new PHP_ICO( $source, $sizes );
			$ico_lib->save_ico( $destination );

			$data['favicon'] = $wp_upload_url . '/' . $image_name;
		}
		else if ( substr($data['favicon'], -3 ) == 'ico' )
		{
			/**
			 * They've uploaded a legitimate file (hopefully) and there's actually nothing
			 * for us to do. Good to have this placeholder later though, in case we need it.
			 */
		}
	}


	$valid = array();
	// Basic data validation
	foreach ( $data as $key => &$item )
	{
		$item = trim( $item );
	}
	// Handle custom font family stuff
	if ( isset( $data['custom-headline-font-family'] ) )
	{
		$data['headline-font-family'] = $data['custom-headline-font-family'];
	}
	if ( isset( $data['custom-body-font-family'] ) )
	{
		$data['body-font-family'] = $data['custom-body-font-family'];
		// echo $data['custom-body-font-family'];
		// exit;
	}

	if ( ! isset( $data['logo'] ) || empty ( $data['logo'] ) )
	{
		unset( $data['logo'] );
		add_settings_error(
			'logo',
			'universal_error',
			'Logo field must not be empty',
			'error'
		);
	}
	if ( ! isset( $data['favicon'] ) || empty ( $data['favicon'] ) )
	{
		unset( $data['favicon'] );
		add_settings_error(
			'favicon',
			'universal_error',
			'Favicon field must not be empty',
			'error'
		);
	}

	$valid = $data;
	/**
	 * Okay, so what's this loop all about? Well, WordPress completely re-
	 * writes an option when it updates it. Our option `tribe-settings` might
	 * have data in it that we're not necessarily populating into $_POST.
	 * If we don't populate it into $_POST, however, it gets lost. This loop
	 * guarantees that we preserve our old data in the event that we're only
	 * posting a partial collection of the `tribe-settings`.
	 */
	foreach ( $tribe_settings as $key=>$value )
	{
		if ( ! isset($valid[$key] ) )
		{
			$valid[$key] = $value;
		}
	}
	return $valid;
}

// Adds appropriate CSS and Query to the DOM for specific admin pages
function tribe_add_resources( $page )
{
	wp_enqueue_style( 'tribe-admin.css', get_template_directory_uri() . '/admin/css/tribe-admin.css');

	wp_enqueue_style( 'wp-color-picker' );

  wp_enqueue_script(
	    'tabby.js',
	    get_template_directory_uri() . '/js/tabby.js',
			array('jquery')
	);

	wp_enqueue_script( 'jquery.text-expander.js',  get_template_directory_uri() . '/js/jquery.text-expander.js', array('jquery') );

	wp_enqueue_script( 'tribe-admin.js', get_template_directory_uri() . '/admin/js/tribe-admin.js', array('jquery', 'wp-color-picker'), false, true  );

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	/**
	 * These next few scripts handle custom functions and custom css files
	 */
	wp_enqueue_script( 'ace_code_highlighter_js', get_template_directory_uri() . '/ace/src/ace.js', '', '1.0.0', true );
}

// Controls actual HTML output for "Theme Settings" page
function tribe_settings_page()
{
	require 'pages/theme-settings.php';
}

// Controls HTML output for "Email Marketing" page
function tribe_email_page()
{
	require 'pages/signup-forms.php';
}

function tribe_custom_css_page()
{
	require 'pages/custom-css.php';
}

function tribe_custom_functions_page()
{
	require 'pages/custom-functions.php';
}

function tribe_export_import_page()
{
	require 'pages/export-import.php';
}

function tribe_license( )
{
	return true;
	/*
	$license_key = nc_tribe_get_option( 'license' );
	$license_valid = nc_tribe_get_option( 'license-valid' );
	return ! empty( $license_key ) && $license_valid  == 'indeed';
	*/
}

function tribe_curl( $url )
{
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL,$url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1) ;
	$return = curl_exec( $ch );
	curl_close( $ch );
	return $return;
}

function tribe_mc_api($action,$fields = array()){
	$apiKey = nc_tribe_get_option('mailchimp-api-key');
	if ($apiKey==""){
		return false;
	}
	list($key, $dc) = explode('-',$apiKey,2);
	if (!$dc) $dc = 'us1';
	$url = $dc . ".api.mailchimp.com/3.0/" . $action;
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_HTTPHEADER,array(
			"Accept: application/json",
			'Authorization: apiKey ' . $apiKey));
	curl_setopt( $ch, CURLOPT_URL,$url);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1);
	if (count($fields)>0){
		$fields = json_encode($fields);
		curl_setopt( $ch, CURLOPT_POSTFIELDS,$fields);
	}
	return json_decode(curl_exec($ch));
}