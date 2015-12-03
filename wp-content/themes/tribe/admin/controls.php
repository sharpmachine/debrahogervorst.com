<?php

/**
 * This file contains the web form elements for every single aspect
 * of the WP dashboard Tribe Theme Settings. These initial arrays are declared in this
 * file because this is the only location in which they're used
 */

$tribe_fonts = array(
	'ABeeZee',
	'Arial',
	'Bree Serif',
	'Cabin',
	'Cabin Sketch',
	'Calibri',
	'Century Gothic',
	'Century Schoolbook',
	'Constantia',
	'Courier',
	'Crimson Text',
	'Droid Sans',
	'Garamond',
	'Georgia',
	'Helvetica',
	'Lobster',
	'Lora',
	'Lucida Grande',
	'Merriweather',
	'Monda',
	'Oxygen',
	'Playfair Display',
	'Roboto',
	'Tahoma',
	'Times New Roman',
	'Trebuchet MS',
	'Ubuntu',
	'Verdana',
	'Vollkorn',
);

/**
 * List fonts that are not being called by Google and that are not on
 * the hard drive of every operating system / available in every browser
 */
$tribe_unsafe_fonts = array(
	'Calibri',
	'Century Gothic',
	'Century Schoolbook',
	'Constantia',
	'Garamond',
	'Helvetica',
	'Lucida Grande',
	'Merriweather',
	'Tahoma',
);

function tribe_headline_font_family_control()
{
	global $tribe_fonts, $tribe_unsafe_fonts;
	echo '<div class="tribe-font-selects headlines"><select id="headline-font-family" name="tribe-settings[headline-font-family]">';
	$custom_font_family = true;
	foreach (	$tribe_fonts as $font )
	{
		echo '<option value="' . $font . '"';
		if ( nc_tribe_get_option( 'headline-font-family' ) == $font )
		{
			$custom_font_family = false;
			echo $selected_text = ' selected="selected"';
		}
		echo '>' . $font;
		if ( in_array( $font, $tribe_unsafe_fonts ) )
		{
			echo ' *';
		}
		echo'</option>';
	}
	echo '<option ';
	if ( $custom_font_family ) {
		echo ' selected="selected" ';
	}
	echo ' value="Custom">Custom</option>';
	echo '</select>';


	echo '<input type="text" name="tribe-settings[custom-headline-font-family]"';
	if ( ! $custom_font_family )
	{
		echo ' style="display: none" disabled="disabled"';
	}
	echo 'class="fake headline-font-family" placeholder="Custom Font Family" value="';
	echo nc_tribe_get_option( 'headline-font-family' ) != "Custom" && $custom_font_family ? htmlentities(nc_tribe_get_option( 'headline-font-family' ) ) : "";
	echo '">';

	echo '<select id="headline-font-size" name="tribe-settings[headline-font-size]" class="left">';
	for ( $i = 25; $i <= 60; $i++ )
	{
		echo '<option value="' . $i . '"';
		if ( nc_tribe_get_option( 'headline-font-size' ) == $i )
		{
			echo ' selected="selected"';
		}
		echo '>' . $i . '</option>';
	}
	echo '</select>


	<select id="headline-font-weight" name="tribe-settings[headline-font-weight]" class="left">';
		echo '<option value="normal">Normal</option>';
		echo '<option value="bold"';
		if ( nc_tribe_get_option( 'headline-font-weight' ) == 'bold' )
		{
			echo ' selected="selected"';
		}
		echo '>Bold</option>';
	echo '</select>

	</div>
	<div class="tribeclear"></div>
	<p class="description">Fonts <strong>not</strong> compatible in all browers are marked with an asterisk.</p>

	<textarea class="tribe-preview headline-font">Grumpy wizards make toxic brew for the evil Queen and Jack.</textarea>';
}

function tribe_body_font_family_control()
{
	global $tribe_fonts, $tribe_unsafe_fonts;
	echo '<div class="tribe-font-selects body"><select id="body-font-family" name="tribe-settings[body-font-family]">';
	$custom_font_family = true;
	foreach (	$tribe_fonts as $font )
	{
		echo '<option value="' . $font . '"';
		if ( nc_tribe_get_option( 'body-font-family' ) == $font )
		{
			$custom_font_family = false;
			echo ' selected="selected"';
		}
		echo '>' . $font;
		if ( in_array( $font, $tribe_unsafe_fonts ) )
		{
			echo ' *';
		}
		echo'</option>';
	}

	echo '<option ';
	if ( $custom_font_family ) {
		echo ' selected="selected" ';
	}
	echo ' value="Custom">Custom</option>';
	echo '</select>';


	echo '<input type="text" name="tribe-settings[custom-body-font-family]"';
	if ( ! $custom_font_family )
	{
		echo ' style="display: none" disabled="disabled"';
	}
	echo 'class="fake body-font-family" placeholder="Custom Font Family" value="';
	echo nc_tribe_get_option( 'body-font-family' ) != "Custom" && $custom_font_family ? htmlentities(nc_tribe_get_option( 'body-font-family' ) ) : "";
	echo '"">';

	echo '<select id="body-font-size"  name="tribe-settings[body-font-size]" class="left">';
	for ( $i = 14; $i < 21; $i++ )
	{
		echo '<option value="' . $i . '"';
		if ( nc_tribe_get_option( 'body-font-size' ) == $i )
		{
			echo ' selected="selected"';
		}
		echo '>' . $i . '</option>';
	}
	echo '</select></div>
	<div class="tribeclear"></div>
	<p class="description"></p>
	<textarea class="tribe-preview body-font">Grumpy wizards make toxic brew for the evil Queen and Jack.</textarea>
	';
}


function tribe_logo_control()
{
	echo '<input type="hidden" name="tribe-settings[logo-width]" value="' . nc_tribe_get_option('logo-width') . '">';
	echo '<input type="hidden" name="tribe-settings[logo-height]" value="' . nc_tribe_get_option('logo-height') . '">';
	echo '<a href="#" id="set-post-thumbnail" class="button logo-upload-button insert-media add_media" data-editor="content"><span class="wp-media-buttons-icon"></span>Change Logo</a><input id="custom-logo" type="text" val="img_resource"  name="tribe-settings[logo]" value="' . nc_tribe_get_option('logo') . '">
	<p class="description">Upload a logo (any size) or a full header image (recommended size: 960px x 320px).</p><br/>
	<div><img style="padding: 3px 10px 0 0; max-width:200px" src="' . nc_tribe_get_option('logo') . '" class="alignleft logo">
	</div>
	';

}

function tribe_featured_image_control()
{
	$appears = nc_tribe_get_option( 'featured-image-appears' );
	$size = nc_tribe_get_option( 'featured-image-size' );
	$position = nc_tribe_get_option( 'featured-image-alignment' );

	$pages = get_pages();
	echo '<label for="featured_image_appears">Featured Image appears: <select id="featured_image_appears" name="tribe-settings[featured-image-appears]">
	<option value="nowhere"';
	if ( $appears == 'nowhere' )
	{
		echo ' selected="selected"';
	}
	echo '>Nowhere</option>
	<option value="archives"';
	if ( $appears == 'archives' )
	{
		echo ' selected="selected"';
	}
	echo '>In Archives</option>
	<option value="archives-and-single"';
	if ( $appears == 'archives-and-single' )
	{
		echo ' selected="selected"';
	}
	echo '>In Archives & Single Posts</option>
	</select>

	<div class="tribeclear padding-bottom"></div>

	<label for="featured-image-size">Featured Image Size:</label>
	<select name="tribe-settings[featured-image-size]" id="featured-image-size">
	<option value="thumbnail"';
	if ( $size == 'thumbnail' )
	{
		echo ' selected="selected"';
	}
	echo '>Thumbnail (150 x 150)</option>
	<option value="medium"';
	if ( $size == 'medium' )
	{
		echo ' selected="selected"';
	}
	echo '>Medium (300 x 300)</option>
	<option value="large"';
	if ( $size == 'large' )
	{
		echo ' selected="selected"';
	}
	echo '>Large (640 x 640)</option>
	<option value="full"';
	if ( $size == 'full' )
	{
		echo ' selected="selected"';
	}
	echo'>Full Resolution</option>
	</select>

	<div class="tribeclear padding-bottom"></div>

	<label for="featured-image-alignment">Featured Image Alignment:</label>
	<select name="tribe-settings[featured-image-alignment]" id="featured-image-alignment">
	<option value="alignleft"';
	if ( $position == 'alignleft' )
	{
		echo ' selected="selected"';
	}
	echo '>Left</option>
	<option value="alignright"';
	if ( $position == 'alignright' )
	{
		echo ' selected="selected"';
	}
	echo '>Right</option>
	<option value="aligncenter"';
	if ( $position == 'aligncenter' )
	{
		echo ' selected="selected"';
	}
	echo '>Center</option>
	<option value="alignnone"';
	if ( $position == 'alignnone' )
	{
		echo ' selected="selected"';
	}
	echo '>None</option>
	</select>

	';

}


function tribe_first_paragraph_control()
{

	echo '<label for="make_first_paragraph_larger-single">For single blog posts:</label> <select id="make_first_paragraph_larger-single" name="tribe-settings[first-paragraph-larger-single]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'first-paragraph-larger-single' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>

	<div class="tribeclear padding-bottom"></div>';



	echo '<label for="make_first_paragraph_larger-pages">For pages:</label> <select id="make_first_paragraph_larger-pages" name="tribe-settings[first-paragraph-larger-pages]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'first-paragraph-larger-pages' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>

	<div class="tribeclear padding-bottom"></div>';



	echo '<label for="make_first_paragraph_larger-archives">For archives:</label> <select id="make_first_paragraph_larger-archives" name="tribe-settings[first-paragraph-larger-archives]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'first-paragraph-larger-archives' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>';

}


function show_author_box_control()
{

	echo '<select id="show-author-box" name="tribe-settings[show-author-box]">
	<option value="yes">Yes</option>
	<option value="no" ';
	if ( nc_tribe_get_option( 'show-author-box' ) == 'no' )
	{
		echo 'selected="selected" ';
	}
	echo '>No</option>';

	echo '</select><p class="description">This will also appear at the end of single blog posts.</p>';

}

function show_previous_next_control()
{

	echo '<select id="show-previous-next" name="tribe-settings[show-previous-next]">
	<option value="yes">Yes</option>
	<option value="no" ';
	if ( nc_tribe_get_option( 'show-previous-next' ) == 'no' )
	{
		echo 'selected="selected" ';
	}
	echo '>No</option>';

	echo '</select><p class="description">This will appear at the end of single blog posts.</p>';

}


function tribe_404_page_control()
{
	$pages = get_pages();
	echo '<select id="four-o-four-page" name="tribe-settings[404-page]">
	<option value="default">Default Tribe 404</option>';
	foreach ( $pages as $page )
	{
		echo '<option value="' . $page->ID . '"';
		if ( nc_tribe_get_option('404-page') == $page->ID )
		{
			echo ' selected="selected" ';
		}
		echo '> ' . $page->post_title . '</option>';
	}
	echo '</select>
	<p class="description">This is what visitors see when the page they\'re on doesn\'t exist.</p>';

}

function tribe_header_contains_control()
{
	echo '<select id="header-is" name="tribe-settings[header-contains]">
	<option value="logo">Image Logo</option>
	<option';
	if ( nc_tribe_get_option('header-contains') == 'text' )
	{
		echo ' selected="selected"';
	}
	echo ' value="text">HTML Text</option>
	</select>';
}

function tribe_layout_control()
{
	echo '<select id="layout" name="tribe-settings[layout]">
	<option value="left-justified">Left Justified</option>
	<option';
	if ( nc_tribe_get_option('layout') == 'centered' )
	{
		echo ' selected="selected"';
	}
	echo ' value="centered">Centered</option>
	</select>
	<p class="description">This determines your menu and headlines. If you choose <strong>centered</strong>, some of the elements (such as the headlines) will only be centered on pages that have no sidebar.</p>';
}


function tribe_archive_pages_show_control()
{
	echo '<select id="archive_pages_show" name="tribe-settings[archive-pages-show]">
	<option value="full_content">Full content</option>
	<option';
	if ( nc_tribe_get_option('archive-pages-show') == 'excerpt' )
	{
		echo ' selected="selected"';
	}
	echo ' value="excerpt">Excerpt</option>
	</select>

	<div class="excerpt-limit-wrap';
	if ( nc_tribe_get_option( 'archive-pages-show' ) == 'full_content' )
	{
		echo ' hidden';
	}
	echo '"><label for="excerpt_limit">Word limit:</label>&nbsp;&nbsp;<input id="excerpt_limit" type="text" class="short" name="tribe-settings[excerpt-word-limit]" value="' . nc_tribe_get_option( 'excerpt-word-limit' ) . '">

	&nbsp;&nbsp;

	<label for="excerpt_more">"More link" anchor text:</label>&nbsp;&nbsp;<input id="excerpt_more" type="text" name="tribe-settings[excerpt-more]" value="' . nc_tribe_get_option( 'excerpt-more' ) . '"></div>
	<p class="description tribeclear">This applies to all views where you\'re showing more than one post at a time.</p>
	';
}

function tribe_default_layout_control()
{

	echo '<label for="default-layout-single">For single blog posts:</label> <select id="default-layout-single" name="tribe-settings[default-layout-single]">
	<option ';
	if ( nc_tribe_get_option( 'default-layout-single' ) == 'right-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="right-sidebar">Right Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-single' ) == 'left-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="left-sidebar">Left Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-single' ) == 'no-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="no-sidebar">No Sidebar</option>';
	echo '</select>

	<div class="tribeclear padding-bottom"></div>';


	echo '<label for="default-layout-pages">For pages:</label> <select id="default-layout-pages" name="tribe-settings[default-layout-pages]">
	<option ';
	if ( nc_tribe_get_option( 'default-layout-pages' ) == 'right-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="right-sidebar">Right Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-pages' ) == 'left-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="left-sidebar">Left Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-pages' ) == 'no-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="no-sidebar">No Sidebar</option>';
	echo '</select>

	<div class="tribeclear padding-bottom"></div>';


	echo '<label for="default-layout-archives">For archives:</label> <select id="default-layout-archives" name="tribe-settings[default-layout-archives]">
	<option ';
	if ( nc_tribe_get_option( 'default-layout-archives' ) == 'right-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="right-sidebar">Right Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-archives' ) == 'left-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="left-sidebar">Left Sidebar</option>
	<option ';
	if ( nc_tribe_get_option( 'default-layout-archives' ) == 'no-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="no-sidebar">No Sidebar</option>';
	echo '</select>


	<p class="description">You can override this on individual pages/posts.</p>';
}




function tribe_body_color_control()
{
	echo '<input type="text" class="color" id="body-color" name="tribe-settings[body-color]" value="' . nc_tribe_get_option( 'body-color' ) . '">';
}


function tribe_link_color_control()
{
	echo '<input type="text" class="color" id="link-clor" name="tribe-settings[link-color]" value="' . nc_tribe_get_option( 'link-color' ) . '">';
}


function tribe_link_hover_color_control()
{
	echo '<input type="text" id="link-hover-color" class="color" name="tribe-settings[link-hover-color]" value="' . nc_tribe_get_option( 'link-hover-color' ) . '">';
}

function tribe_headline_link_color_control()
{
	echo '<input type="text" class="color" id="headline-link-color" name="tribe-settings[headline-link-color]" value="' . nc_tribe_get_option( 'headline-link-color' ) . '">';
}

function tribe_headline_link_hover_color_control()
{
	echo '<input type="text" id="headline-link-hover-color" class="color" name="tribe-settings[headline-link-hover-color]" value="' . nc_tribe_get_option( 'headline-link-hover-color' ) . '">';
}
function tribe_header_background_color_control()
{
	echo '<input type="text" id="header-background" class="color" name="tribe-settings[header-background-color]" value="' . nc_tribe_get_option( 'header-background-color' ) . '"><!--<p class="description">This setting will only apply if you are showing <strong>HTML Text</strong> in Appearance & Content below.</p>-->';
}
function tribe_header_text_color_control()
{
	echo '<input type="text" id="header-text-color" class="color" name="tribe-settings[header-text-color]" value="' . nc_tribe_get_option( 'header-text-color' ) . '">';
}
function tribe_button_color_control()
{
	echo '<input type="text" class="color" id="button-color" name="tribe-settings[button-color]" value="' . nc_tribe_get_option( 'button-color' ) . '">
	<p class="description">This includes your "Read more" and form submit buttons, including the <a href="http://members.tribetheme.com/available-shortcodes-in-tribe-theme/#button" target="_blank">[button] shortcode</a>.</p>';
}

function tribe_special_background_color_control()
{
	echo '<input type="text" class="color" id="button-color" name="tribe-settings[special-background-color]" value="' . nc_tribe_get_option( 'special-background-color' ) . '">
	<p class="description">This is the background of text you put inside the <a href="http://members.tribetheme.com/available-shortcodes-in-tribe-theme/#special" target="_blank">[special] shortcode</a>.</p>';
}

function tribe_sticky_bar_background_control()
{
	echo '<input type="text" class="color" id="sticky-bar-background" name="tribe-settings[sticky-bar-background]" value="' . nc_tribe_get_option( 'sticky-bar-background' ) . '">';
}

function tribe_sticky_bar_font_color()
{
	echo '<input type="text" class="color" id="sticky-bar-font-color" name="tribe-settings[sticky-bar-font-color]" value="' . nc_tribe_get_option( 'sticky-bar-font-color' ) . '">';
}

function tribe_sticky_bar_control()
{

	echo '<label for="sticky-bar-appears-single">Show on single blog posts:</label> <select id="sticky-bar-appears-single" name="tribe-settings[sticky-bar-appears-single]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'sticky-bar-appears-single' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>

		<div class="tribeclear padding-bottom"></div>';

	echo '<label for="sticky-bar-appears-pages">Show on pages:</label> <select id="sticky-bar-appears-pages" name="tribe-settings[sticky-bar-appears-pages]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'sticky-bar-appears-pages' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>

	<div class="tribeclear padding-bottom"></div>';


		echo '<label for="sticky-bar-appears-archives">Show on archives:</label> <select id="sticky-bar-appears-archives" name="tribe-settings[sticky-bar-appears-archives]">
	<option value="no">No</option>
	<option value="yes" ';
	if ( nc_tribe_get_option( 'sticky-bar-appears-archives' ) == 'yes' )
	{
		echo 'selected="selected" ';
	}
	echo '>Yes</option>';

	echo '</select>
	<p class="description">To edit the content in your sticky sidebar, head over to your widgets page.</p>';


}

function tribe_post_meta_data_control()
{
	echo '<textarea id="post-meta-data" name="tribe-settings[post-meta-data]">' . nc_tribe_get_option( 'post-meta-data' ) . '</textarea>
	<p class="description">This appears between your post title and your post content.<br/> <a href="#" class="toggle">Show available shortcodes for Post Meta Data</a><br/>
	<span class="hidden hiding">
	<strong>[author]</strong> — Name of the post\'s author, with a link that author\'s Website<br/>
	<strong>[author-with-archive-link]</strong> — Name of the post\'s author, with a link that author\'s Archive<br/>
	<strong>[comments]</strong> — A link to the comments section<br/>
	<strong>[categories]</strong> — Shows the categories under which your post was published. Recommended usage: "Filed under [categories]."<br/>
	<strong>[date]</strong> — The date the post was published<br/>
	<strong>[edit]</strong> — A handy link that lets administrators edit the page. Only visible if the viewer is logged in.</span></p>';
}

function tribe_header_scripts_control()
{
	echo '<textarea id="header-scripts" name="tribe-settings[header-scripts]">' . nc_tribe_get_option( 'header-scripts' ) . '</textarea>
	<p class="description">Executes just before <code>&lt;/head&gt;</code></p>';
}

function tribe_footer_scripts_control()
{
	echo '<textarea id="footer-scripts" name="tribe-settings[footer-scripts]">' . nc_tribe_get_option( 'footer-scripts' ) . '</textarea>
	<p class="description">Executes just before <code>&lt;/body&gt;</code></p>';
}

function tribe_footer_text_control()
{
	echo '<textarea id="footer-text" name="tribe-settings[footer-text]">' . nc_tribe_get_option( 'footer-text' ) . '</textarea>
	<p class="description"><a href="#" class="toggle">Show available shortcodes for Footer</a><br/>
	<span class="hidden hiding">
	<strong>[site-name]</strong> — Shows the name of your site (i.e., ' . do_shortcode('[site-name]'). ').<br/>
	<strong>[year]</strong> — Shows current year (currently ' . date('Y') .', but updates dynamically).
	</span></p>';
}

function tribe_twitter_handle_control()
{
	echo '<input type="text" id="twitter-handle" name="tribe-settings[twitter-handle]" value="' . nc_tribe_get_option( 'twitter-handle' ) . '"/>
	<p class="description">Used within the share quote shortcode.<br/><a href="#" class="toggle">Show available shortcode for sharing quotes.</a><br/>
	<span class="hidden hiding">
	<strong>[share-quote author="Abraham Lincoln" via="JeffGoins"] This is a quote [/share-quote]</strong> — Formats a quote as a tweetable block. You can optionally use the via attribute to override the Twitter handle set above.<br/>
	</span></p>';
}

function tribe_external_service_control()
{
	echo '<select id="external-service" name="tribe-settings[external-service]">
	<option></option>
	<option value="mailchimp" ';
	if ( nc_tribe_get_option( 'external-service' ) == 'mailchimp' )
	{
		echo 'selected="selected" ';
	}
	echo '>Mailchimp</option>';
	echo '</select>';
}

function tribe_mailchimp_api_control()
{
	echo '<input type="text" id="mailchimp-api-key" name="tribe-settings[mailchimp-api-key]" value="' . nc_tribe_get_option( 'mailchimp-api-key' ) . '"/>';
	echo '<p class="description">Retrieve your <a href="https://admin.mailchimp.com/account/api-key-popup" target="_blank">mailchimp API key here</a>.</p>';
}

function tribe_favicon_control()
{
	echo '<input type="hidden" name="sanitized_favicon" value="' . nc_tribe_get_option('favicon') . '"><a href="#" id="set-post-thumbnail" class="button favicon-upload-button insert-media add_media" data-editor="content"><span class="wp-media-buttons-icon"></span>Change Favicon</a><input id="custom-favicon" type="text" val="img_resource"  name="tribe-settings[favicon]" value="' . nc_tribe_get_option('favicon') . '">
	<div><img style="padding: 3px 10px 0 0; max-width:40px" src="' . nc_tribe_get_option('favicon') . '" class="alignleft favicon"><p class="description">Favicons are square. We strongly recommend you upload an image that\'s already square, or that you crop it using WordPress\' image editor. Otherwise, Tribe will crop it for you, and you may not like how it turns out.</p>
	</div>
	';

}
