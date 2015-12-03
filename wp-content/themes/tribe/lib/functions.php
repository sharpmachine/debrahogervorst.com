<?php

$theme_data = wp_get_theme('tribe');
define( 'TRIBE_VERSION', $theme_data->Version );

/**
 * Data is the most important part of a piece of software. It's also
 * the most exctiting, which is why it appears first in this software.
 *
 * In WordPress themes and plugins, data is typically stored via the
 * Options API. With a theme that has lots of settings, it is a bad
 * idea to store all of these settings in dedicated options. Instead,
 * it's better to store all of them in a single option, as an array.
 * The challenege is that reading and writing a single setting without
 * worrying about the integrity of the data for the other settings is
 * not built out-of-the-box with WordPress. In addition to that,
 * as a theme matures, new data is added to it and you cannot assume
 * that old users will have indexes for a newly created key within the
 * array. These functions try to make this process more manageable so
 * that throughout the theme, accessing the settings is an enjoyable
 * breeze.
 */

function tribe_get_default_options()
{
	$tribe_settings_defaults = array(
		'404-page' => 'default',
		'activation-timestamp' => '',
		'archive-pages-show' => 'excerpt',
		'body-font-family' => 'Oxygen',
		'body-font-size' => 18,
		'body-color' => '#000',
		'button-color' => '#d33',
		'custom-css' => '',
		'custom-functions' => tribe_default_custom_functions(),
		'default-layout-single' => 'right-sidebar',
		'default-layout-pages' => 'right-sidebar',
		'default-layout-archives' => 'right-sidebar',
		'excerpt-more' => 'Read More',
		'excerpt-word-limit' => 55,
		'featured-image-alignment' => 'left',
		'featured-image-size' => 'thumbnail',
		'featured-image-appears' => 'nowhere',
		'favicon' => get_template_directory_uri() . '/images/favicon.ico',
		'first-paragraph-larger-single' => 'yes',
		'first-paragraph-larger-pages' => 'no',
		'first-paragraph-larger-archives' => 'no',
		'footer-scripts' => '',
		'footer-text' => 'Copyright &#169; [site-name] [year] &bull; All Rights Reserved',
		'header-background-color' => "#fff",
		'header-text-color' => "#111",
		'header-contains' => 'text',
		'header-scripts' => "<script type=\"text/javascript\">\n(function($) {\n\t\n})(jQuery);\n</script>",
		'headline-font-family' => 'Oxygen',
		'headline-font-size' => 38,
		'headline-font-weight' => 'normal',
		'layout' => 'centered',
		'link-color' => '#d33',
		'logo' => get_template_directory_uri() . '/images/logo.png',
		'logo-height' => 230,
		'logo-width' => 960,
		'post-meta-data' => '<em>by</em> [author] | [comments] [edit]',
		'show-author-box' => 'yes',
		'show-previous-next' => 'yes',
		'show-previous-next' => 'yes',
		'special-background-color' => '#f7f7f7',
		'sticky-bar-appears-archives' => 'no',
		'sticky-bar-appears-pages' => 'no',
		'sticky-bar-appears-single' => 'no',
		'sticky-bar-background' => '#101010',
		'sticky-bar-font-color' => '#fff',
		'twitter-handle'=> ''
	);
	return $tribe_settings_defaults;
}

/**
 * Some data shouldn't easily be changed
 */
function tribe_dont_change()
{
	return array( 'activation-timestamp' );
}

/**
 * Get a single default option
 */
function tribe_get_default_option( $option )
{
	$tribe_settings_defaults = tribe_get_default_options();
	return $tribe_settings_defaults[ $option ];
}

/**
 * This function allows you to update a single setting without worrying  * what happens to the rest of the data in that option.
 *
 * "nc_" prefix could stand for "No conflict," which is to avoid the
 * Events Calendar plugin conflict, or it could also stand for
 * "North Carolina," which is where I'm writing this code.
 */
function nc_tribe_update_option( $option_key, $option_val )
{
	$tribe_settings = tribe_get_options();
	$tribe_settings[ $option_key ] = $option_val;
	update_option( 'tribe-settings', $tribe_settings );
}

/**
 * Get all of the options.
 */
function tribe_get_options()
{
	$defaults = tribe_get_default_options();
	$db = get_option( 'tribe-settings' );
	if ( is_array( $db ) )
	{
		return array_merge( $defaults, $db );
	}
	return $defaults;
}

/**
 * Get a single option
 */
function nc_tribe_get_option( $option )
{
	$tribe_settings = tribe_get_options();
	/**
	 * Do not assume the data exists. If the user has recently done
	 * an upgrade, they may not have this data.
	 */
	if ( isset( $tribe_settings[ $option ] ) )
	{
		return $tribe_settings[ $option ];
	}
	else
	{
		// Nothing in db, so see if we have a default for
		// that setting
		$defaults = tribe_get_default_options();
		if ( isset( $defaults[ $option] ) )
		{
			return $defaults[ $option ];
		}
		else
		{
			return "";
		}
	}
}

add_action('wp', 'tribe_remove_disqus');
function tribe_remove_disqus()
{
	if ( is_single() || is_page() )
	{
		global $post;
		if ( 'closed' == $post->comment_status && 'closed' == $post->ping_status )
		{
			remove_filter('comments_template', 'dsq_comments_template');
		}
	}
}

/**
 * At the end of a single blog post, show links to previous and next
 */
add_action('tribe_after_single', 'tribe_show_prev_next', 0);
function tribe_show_prev_next()
{
	$previous = get_adjacent_post(false, '', true);
	$next = get_adjacent_post(false, '', false);

	/**
	 * This will only return false if they've only published on blog
	 * post
	 */
	if ( ($previous != NULL || $next != NULL) && nc_tribe_get_option( 'show-previous-next' ) == 'yes' )
	{
		// Check if one and only one link is showing
		$mutex = $previous && ! $next || ! $previous && $next;
		$class = "";
		if ( $mutex )
		{
			$class = "mutex";
		}
		echo '<div class="links ' . $class . '">';
		if ( $next != NULL )
		{
			echo '<div class="next">';
			if ( $mutex )
			{
				echo 'Recent: ';
			}
			echo '<a href="' . get_permalink( $next->ID ) . '">';
			if ( ! $mutex )
			{
				echo  ' &#8592;';
			}
			echo $next->post_title . '</a></div>';
		}
		if ( $previous != NULL )
		{
			echo '<div class="previous">';
			if ( $mutex )
			{
				echo 'Recent: ';
			}
			echo '<a href="' . get_permalink( $previous->ID ) . '">' . $previous->post_title;
			if ( ! $mutex )
			{
				echo  ' &#8594';
			}
			echo '</a></div>';
		}

		echo '</div>';
	}
}

add_action('tribe_after_content', 'tribe_comments_template', 0);
function tribe_comments_template()
{
	if ( is_page() && ! is_page_template('page_blog.php') || is_single() )
	{
		comments_template();
	}
}

if (is_numeric( nc_tribe_get_option('excerpt-word-limit') ) )
{
		add_filter( 'excerpt_length', 'tribe_custom_excerpt_word_length', 999 );
}
function tribe_custom_excerpt_word_length( $length ) {
	return nc_tribe_get_option('excerpt-word-limit');
}

function tribe_infinite_excerpt_word_length( $length ) {
	return 10000000;
}

function tribe_new_excerpt_more( $more ) {
	return "";
}
add_filter('excerpt_more', 'tribe_new_excerpt_more');

add_action('tribe_after_content', 'tribe_edit_link');
function tribe_edit_link()
{
	if ( is_page() || is_single() )
	{
		edit_post_link( 'Edit ' . ucfirst( get_post_type() ) );
	}
}

if ( is_active_sidebar( 'feature-box' ) )
{
	add_action( 'tribe_after_header', 'tribe_feature_box', 100 );
}
function tribe_feature_box()
{
	if ( is_front_page() )
	{
		echo '<div class="feature-box"><div class="wrap">';
		dynamic_sidebar( 'feature-box ');
		echo '</div></div><!-- end .feature-box -->';
	}
}

if ( is_active_sidebar( 'end-of-post' ) )
{
	add_action('tribe_after_single', 'tribe_end_of_post', 10);
}
function tribe_end_of_post()
{
	echo '<div class="end-of-post-widget">';
	dynamic_sidebar('end-of-post');
	echo '</div>';
}

if ( nc_tribe_get_option( 'show-author-box' ) == 'yes' )
{
	add_action( 'tribe_after_single', 'tribe_about_author_box', 5 );
}
function tribe_about_author_box()
{
	echo '<div class="bio">';
	echo get_avatar( get_the_author_meta('ID') , 100 );
  echo '<div class="bio-copy"><h3 class="author-name">About ';
	the_author();
	echo '</h3><p>';
	the_author_meta('description');
	echo '</p></div></div><!-- end .bio -->';
}

if ( is_active_sidebar( 'footer-left' ) || is_active_sidebar( 'footer-right' ) )
{
	add_action( 'tribe_footer', 'tribe_footer_widgets', 0 );
}
function tribe_footer_widgets()
{
	echo '<div class="footer-widgets-wrap">';
	echo '<div class="footer-left">';
	dynamic_sidebar( 'footer-left' );
	echo '</div>';
	echo '<div class="footer-right">';
	dynamic_sidebar( 'footer-right' );
	echo '</div></div><!-- end .footer-widgets-wrap --><div class="tribeclear"></div>';
}


add_action( 'tribe_before_content', 'tribe_opening_content_div' );
function tribe_opening_content_div()
{
	echo '<div id="content">';
}

add_action ('tribe_after_content', 'tribe_closing_content_div' );
function tribe_closing_content_div()
{
	echo '</div><!-- end #content -->';
}

add_action( 'tribe_after_sidebar', 'tribe_clear_content_sidebar_wrap' );
function tribe_clear_content_sidebar_wrap()
{
	echo '<div class="tribeclear"></div>';
}

/**
 * Consistency is key, which is why we're making a function out of this.
 * It's actually used in a couple of places.
 */
function tribe_default_custom_functions()
{
	return '<?php

/**
 * CAUTION: Do not edit this file if you are not comfortable
 * writing PHP code. Do not save this file if there are any red
 * Xs appearing to the left of this file. All code written will
 * be executed immediately upon saving this file, which may crash
 * your site. In order to fix this problem, go to
 * ' . get_home_url() . '?reset_tribe_custom_functions. This will
 * download your custom functions to your computer for offline
 * analyzation, and restore this online version to its default state.
 */

';
}

add_theme_support( 'post-thumbnails' );
require_once get_template_directory() . '/php-ico-master/class-php-ico.php';
require_once get_template_directory() . '/lib/shortcodes.php';
require_once get_template_directory() . '/lib/post-meta.php';
require_once get_template_directory() . '/lib/pagination.php';
require_once get_template_directory() . '/admin/theme-update-checker.php';
require_once get_template_directory() . '/admin/update.php';
require_once get_template_directory() . '/admin/theme-settings.php';
require_once get_template_directory() . '/admin/controls.php';
require_once get_template_directory() . '/lib/css.php';
require_once get_template_directory() . '/lib/menus.php';
require_once get_template_directory() . '/lib/widgets.php';
require_once get_template_directory() . '/sidebar.php';
require_once get_template_directory() . '/widgets/feature-box.php';
require_once get_template_directory() . '/widgets/social.php';
require_once get_template_directory() . '/cmb2/init.php';
add_filter('admin_footer_text', 'customize_footer_admin');
function customize_footer_admin () {
	echo 'You are rocking Tribe ' . TRIBE_VERSION;
}

add_action( 'tribe_after_footer', 'tribe_footer_scripts');
function tribe_footer_scripts()
{
	echo nc_tribe_get_option( 'footer-scripts' );
}

add_action( 'tribe_footer', 'tribe_footer' );
function tribe_footer()
{
	echo '<div class="footer-text">' . do_shortcode( nc_tribe_get_option( 'footer-text' ) ) . '</div>';
}

/**
 * Let's face it — this function does a very simple task: it outputs a
 * simple stylesheet link. But before you shake your head, try writing this function
 * less verbose. I think you'll find it difficult.
 */
add_action('tribe_header_scripts', 'tribe_load_google_fonts');
function tribe_load_google_fonts()
{
	/**
	 * These 2 arrays are the only items here that must be updated to include
	 * new Google font choices and new areas to apply those font choices. Everything
	 * else is 100% scalable.
	 */
	$fonts_user_selected = array(
		nc_tribe_get_option( 'body-font-family' ),
		nc_tribe_get_option( 'headline-font-family' )
	);

	$fonts_that_require_google = array(
		'ABeeZee' => 'ABeeZee:400,400italic',
		'Cabin' => 'Cabin:400,700,400italic,700italic',
		'Cabin Sketch' => 'Cabin+Sketch:400,700',
		'Crimson Text' => 'Crimson+Text:400,700,400italic',
		'Droid Sans' => 'Droid+Sans:400,700',
		'Lobster' => 'Lobster',
		'Lora' => 'Lora:400,700,400italic,700italic',
		'Merriweather' => 'Merriweather:400,700,400italic',
		'Monda' => 'Monda:400,700',
		'Oxygen' => 'Oxygen:400,300,700',
		'Playfair Display' => 'Playfair+Display:400,700,400italic,700italic',
		'Roboto' => 'Roboto:400,700,700italic,400italic',
		'Ubuntu' => 'Ubuntu:400,700,400italic,700italic',
		'Vollkorn' => 'Vollkorn:400italic,700italic,400,700',
	);

	$fonts_needed_from_google = array();

	/**
	 * Check to make sure they've actually selected a font that
	 * requires Google.
	 */
	foreach ( $fonts_user_selected as $font )
	{
		if ( array_key_exists( $font, $fonts_that_require_google ) )
		{
				array_push( $fonts_needed_from_google, $font );
		}
	}

	if ( count( $fonts_needed_from_google ) > 0 )
	{
		$i = 0;
		echo "<link href='http://fonts.googleapis.com/css?family=";
		foreach ( $fonts_needed_from_google as $font )
		{
			echo $i > 0 ? "%7c" : "";
			echo $fonts_that_require_google[ $font ];
			$i++;
		}
		echo "' rel='stylesheet' type='text/css' />";
	}
}

add_action('tribe_before_header', 'tribe_do_nav');
function tribe_do_nav()
{
	if ( has_nav_menu( 'tribe-above' ) )
	{
		echo '<div class="nav navigation dropdown">';
		wp_nav_menu( array( 'theme_location' => 'tribe-above' ) );
		echo '<div class="tribeclear"></div></div>';
		echo '';
	}
}

add_action('tribe_header', 'tribe_logo', 1);
function tribe_logo()
{
	if (is_page_template( 'squeeze-template.php' )){
		return;
	}
	echo '<div class="header-wrap">';
	$h1 = false;

	if ( is_front_page() && ! is_page() )
		$h1 = true;

	if ($h1)
		echo '<h1>';
	else
		echo '<h2>';

		echo '<a href="' . get_bloginfo( 'wpurl' ) . '">' . get_bloginfo('name') . '</a>';

	if ($h1)
		echo '</h1>';
	else
		echo '</h2>';

	$description = get_bloginfo( 'description' );
	if ( ! empty( $description ) )
	{
			echo '<div class="border"></div><div class="tagline"> ' . $description . '</div>';
	}

	echo '</div><!-- end .header-wrap -->';
}

add_action( 'tribe_head', 'tribe_header_scripts', 99 );
function tribe_header_scripts()
{
	echo nc_tribe_get_option( 'header-scripts' );
}

add_action('tribe_after_header', 'tribe_do_subnav');
function tribe_do_subnav()
{
	if ( has_nav_menu( 'tribe-below' ) )
	{
		echo '<div class="subnav navigation dropdown">';
		echo wp_nav_menu( array( 'theme_location' => 'tribe-below' ) );
		echo '<div class="tribeclear"></div></div>';
	}
}

add_action( 'tribe_after_post_title', 'tribe_post_meta_data' );
function tribe_post_meta_data()
{
	echo do_shortcode( nc_tribe_get_option( 'post-meta-data' ) );
}

add_action( 'tribe_before_content', 'tribe_show_search_message');
function tribe_show_search_message()
{
	if ( is_search() )
	{
		echo '<h3 class="showing-search-results">Showing Search Results for <strong>' . htmlspecialchars( $_GET['s'] ) . '</strong>:</h3>';
	}
}

/**
 * This function is responsible formatting all posts (as opposed
 * to pages).
 *
 * This function uses important hooks to let future developers tap
 * into it via custom functions
 */
function tribe_format_archive_post()
{
	ob_start();
	do_action( 'tribe_before_archive_post' );
 	$data = ob_get_contents();
	ob_end_clean();
	$output = $data;

	$output .= '<div class="post"><h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

	$output .= '<div class="entry-content">';

	ob_start();
	do_action( 'tribe_after_post_title' );

 	$post_meta_data = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $post_meta_data ) )
	{
		$output .= '<div class="post-meta-data">' . $post_meta_data . '</div>';
	}
	$output .= tribe_get_the_content_with_formatting();
	$output .= '</div>';

	ob_start();
	do_action( 'tribe_after_archive_post' );
 	$data = ob_get_contents();
	ob_end_clean();

	$output .= $data . '</div>';

	// this should probably never happen, but just in case
	if ( empty( $output ) )
	{
		$output = '<p>Sorry, we couldn\'t find anything that matched what you were after</p>';
	}
	return apply_filters('tribe_archive', $output);

}

/**
 * This function is only used to assist in archive prints.
 * At some point these functions need to be consolidated with single
 * view so everything is more DRY
 */
function tribe_get_the_content_with_formatting( $post_id = "", $status = "regular" )
{
		/**
		 * Don't delete these next two lines or the More tag will
		 * break. Complements of
		 * http://wordpress.org/support/topic/more-tag-not-working-in-custom-page-template
		 */
		global $more;
		$more = 0;

		$featured_image = "";
		if ( nc_tribe_get_option( 'featured-image-appears' ) == 'archives' || nc_tribe_get_option( 'featured-image-appears' ) == 'archives-and-single' )
		{
			$featured_image = tribe_get_featured_image();
		}

		if ( nc_tribe_get_option( 'archive-pages-show' ) == 'excerpt' )
		{
			/**
			 * Check to see if the excerpt is showing the full blog post
			 * or not.
			 */
			$e_len = strlen ( get_the_excerpt() );
			add_filter( 'excerpt_length', 'tribe_infinite_excerpt_word_length', 999 );
			$c_len = strlen ( get_the_excerpt() );
			remove_filter( 'excerpt_length', 'tribe_infinite_excerpt_word_length', 999 );

			$excerpt_shows_full_post = $c_len == $e_len;

			$content = '<p>' . get_the_excerpt();
			if ( ! $excerpt_shows_full_post && ! has_excerpt( get_the_ID() ) ) {
				$content .= ' [...]';
			}
			$content .= '</p>';
			$content = apply_filters( 'the_content', $content );
			$excerpt_more = nc_tribe_get_option('excerpt-more');
			/**
			 * In order to show the "read more" button, the anchor text must
			 * be specified by the user, and either there must exist a TRUE
			 * excerpt, or else the auto-generated excerpt must be shorter
			 * than the full blog post
			 */
			if ( ! empty( $excerpt_more ) && ( ! $excerpt_shows_full_post || has_excerpt( get_the_ID() ) ) )
			{
				$content .= '<div class="tribeclear"></div><p class="more-link-p overflowhidden"><a class="more-link" href="' . get_permalink() . '">' . nc_tribe_get_option('excerpt-more') . '</a></p><div class="tribeclear"></div>';
			}
		}
		else
		{
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
		}
		return $featured_image . $content;
}

/**
 * This function assumes that you are in the loop. It also assumes
 * that the calling function wants the image regardless of user
 * settings to the contrary. That conditional logic must be worked
 * out before this function is called.
 *
 * @return a string containing the entire <img> jazz
 *
 * Regular expression complements of
 * http://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/
 */
function tribe_get_featured_image() {

	global $post, $posts;
	$args = array(
		'class' => nc_tribe_get_option( 'featured-image-alignment' ) . ' featured_image',
	);
	$featured_image = get_the_post_thumbnail( get_the_ID(), nc_tribe_get_option( 'featured-image-size' ), $args );

	/**
	 * If the user hasn't specified a featured image, let's see
	 * if the post has any images itself
	 */
	if ( empty( $featured_image ) )
	{
		/**
		 * We don't just take the first image, because there is no
		 * guarantee that it will be in the database. So instead,
		 * we loop through the images until we find a suitable one.
		 * Normally it should break after the first image, since most
		 * WP users tend to insert images by uploading them to their
		 * media library
		 *
		 * I avoid reg expressions like the plague so here's what's
		 * going on. A user may have an image e.g.
		 * example.com/uploads/image-150x150.png. Our job is to find
		 * out if the image has a size extension in the name and if
		 * so, remove it. Then we take this string and manually
		 * query the database to see if it exists. If so, we get its
		 * unique ID and then run wp_get_attachment_image_src.
		 * This is superior to any sytem I have ever seen before.
		 */
		 global $wpdb;
		 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

		/**
		 * According to http://php.net/preg_match_all,
		 * "$matches[0] is an array of full pattern matches, $matches[1]
		 * is an array of strings matched by the first parenthesized
		 * subpattern, and so on."
		 */
  	$images = $matches[1];

		foreach ( $images as &$img )
		{
			$last_dash = strrpos( $img, '-' );
			$last_period = strrpos( $img, '.' );
			$is_resized  = false;
			for ( $i = $last_dash + 1; $i < $last_period; $i++)
			{
				if ( is_int( $img[ $i ] ) || $img[ $i ] == 'x' )
				{
					$is_resized = true;
				}
			}
			if ( $is_resized )
			{
				$start = substr( $img, 0, $last_dash );
				$finish = substr( $img, $last_period );
				$img = $start . $finish;
			}
			$row = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE guid = '" .  $img . "'" );
			if ( ! empty( $row ) )
			{
				//$featured_image = get_image_tag( $row->ID, '', '', substr( nc_tribe_get_option( 'featured-image-alignment' ), 5 ), nc_tribe_get_option( 'featured-image-size' ) );
				$featured_image = get_image_tag( $row->ID, '', '', substr( nc_tribe_get_option( 'featured-image-alignment' ), 5 ), nc_tribe_get_option( 'featured-image-size' ) );
				break; // don't keep making expensive SQL queries
			}
		}
	}
	return $featured_image;
}



function tribe_format_page()
{
	$content = get_the_content();

	$checked = get_post_meta( get_the_ID(), '_tribe_disable_markup', true);
	if ( $checked == 'yes' )
	{
		$filters_to_remove = array(
			'wptexturize',
			'convert_smilies',
			'convert_chars',
			'wpautop',
			'shortcode_unautop',
			'prepend_attachment'
		);
		foreach ( $filters_to_remove as &$filter )
		{
			 remove_filter( 'the_content', $filter );
		}
	}
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$output = '<div class="post">';

	ob_start();
	do_action( 'tribe_page_title' );
	$output .= ob_get_contents();
	ob_end_clean();

	$output .= '<div class="entry-content">' .
   $content .
	'</div></div>';

	return $output;
}

function tribe_format_404( $id )
{
	$content = get_post( $id );
	$content = apply_filters( 'the_content', $content->post_content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$output = '<div class="post"><h1 class="entry-title">' . get_the_title( $id ) . '</h1>
	<div class="entry-content">' .
   $content .
	'</div></div>';

	return $output;
}


function tribe_format_single()
{
	$featured_image = "";
	if ( nc_tribe_get_option( 'featured-image-appears' ) == 'archives-and-single' )
	{

	$args = array(
		'class' => nc_tribe_get_option( 'featured-image-alignment' ) . ' featured_image',
			);
		$featured_image = tribe_get_featured_image();
		}

	$content = get_post();


	$checked = get_post_meta( get_the_ID(), '_tribe_disable_markup', true);
	if ( $checked == 'yes' )
	{
		$filters_to_remove = array(
			'wptexturize',
			'convert_smilies',
			'convert_chars',
			'wpautop',
			'shortcode_unautop',
			'prepend_attachment'
		);
		foreach ( $filters_to_remove as &$filter )
		{
			remove_filter( 'the_content', $filter );
		}
	}

	$content = apply_filters( 'the_content', $content->post_content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$output = '<div class="post">';

	ob_start();
	do_action( 'tribe_single_post_title' );
	$output .= ob_get_contents();
	ob_end_clean();

	$output .= '<div class="entry-content">';
	ob_start();
	do_action( 'tribe_after_post_title' );

 	$post_meta_data = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $post_meta_data ) )
	{
		$output .= '<div class="post-meta-data">' . $post_meta_data . '</div>';
	}

	$output .= $featured_image . $content . '</div>';

	ob_start();
	do_action( 'tribe_after_single' );

 	$output .= ob_get_contents();
	ob_end_clean();

	$output .= '</div>';

	return $output;
}

add_action( 'tribe_single_post_title', 'nc_tribe_single_post_title' );

function nc_tribe_single_post_title() {
	echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
}

add_action( 'tribe_page_title', 'nc_tribe_page_title' );
function nc_tribe_page_title() {
	echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
}


/**
 * Add user-specified favicon to site
 */
add_action( 'wp_head', 'tribe_load_favicon');
function tribe_load_favicon()
{
	echo '<link rel="Shortcut Icon" href="' . nc_tribe_get_option( 'favicon' ) . '" type="image/x-icon" />';
}


add_action( 'admin_head', 'tribe_load_favicon' );
function tribe_format_title()
{
	if ( is_home() || is_front_page() )
	{
		$title = bloginfo( 'name' );
	}
	else if ( is_single() || is_page() )
	{
		$title = ( get_the_title() );
	}
	else if ( is_404() )
	{
		$title = 'This page does not exist!';
	}
	else if ( is_archive() )
	{
		$title = 'Archives for ' . get_bloginfo( 'name' );
	}
	else if ( is_search() )
	{
		$title = 'Searching ' . get_bloginfo( 'name' );
	}
	else
	{
		$title = bloginfo( 'name' );
	}
	return strip_tags( $title );
}

add_action('wp_enqueue_scripts', 'tribe_add_css_js', 0);
function tribe_add_css_js()
{
	// A child theme should be able to enqueue or @import the parent
	// CSS. Giving different IDs to parent and child stylesheets lets
	// us do that
	if ( ! is_child_theme() )
	{
		if ( is_singular() )
		{
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script(
			'tabby.js',
			get_template_directory_uri() . '/js/tabby.js',
			array('jquery')
			);
		wp_enqueue_script(
			'jquery.text-expander.js',
			get_template_directory_uri() . '/js/jquery.text-expander.js',
			array('jquery')
			);
		wp_enqueue_script(
			'tribe-site.js',
			get_template_directory_uri() . '/js/site.js',
			array('jquery')
			);


		wp_enqueue_style(
			'tribe-reset.css',
			get_template_directory_uri() . '/lib/reset.css'
			);

		wp_enqueue_style(
			'tribe-site.css',
			get_template_directory_uri() . '/style.css'
			);
	}
	else
	{
		wp_enqueue_style(
		    'tribe-child-site.css',
		    get_stylesheet_directory_uri() . '/style.css'
		);
	}
}

add_action('wp_head', 'tribe_add_css_user_generated' );
function tribe_add_css_user_generated()
{
	echo '<style>' . tribe_print_css() . '</style>';
}


/**
 * Show sticky bar
 */
add_action('tribe_before_header', 'tribe_show_sticky_bar', 0);
function tribe_show_sticky_bar()
{
	if ( is_page() && nc_tribe_get_option( 'sticky-bar-appears-pages' ) == 'yes' || is_single() && nc_tribe_get_option( 'sticky-bar-appears-single' ) == 'yes' || ! is_page() && ! is_single() && nc_tribe_get_option( 'sticky-bar-appears-archives' ) == 'yes' )
	{
		ob_start();
		dynamic_sidebar('sticky-bar');
		$sticky_bar = ob_get_contents();
		ob_clean();
		if ( ! empty( $sticky_bar ) )
		{
			echo '<div class="sticky-bar-wrap"><div class="sticky-bar">' . $sticky_bar . '</div></div>';
		}
	}
}




/**
 * I firmly believe that much of what goes on in WordPress could be
 * better handled with smarter body classes. That's why this funciton
 * is going to look pretty bizarre to firsttimers. Deal with it...
 */
add_filter( 'body_class', 'tribe_add_body_class' );
function tribe_add_body_class( $classes ) {

	$description = get_bloginfo( 'description' );
	$header_background_color = nc_tribe_get_option('header-background-color');
	if ( $header_background_color == '#fff' || $header_background_color == "#ffffff" )
	{
		$classes[] = "white_header_background_color";
	}
	if ( ! empty( $description ) )
	{
		$classes[] = "showing_description";
	}
	else
	{
		$classes[] = "hiding_description";
	}

	if ( ! is_active_sidebar( 'footer-left' ) && !is_active_sidebar( 'footer-right' ) )
	{
		$classes[] = "no_footer_widgets";
	}

	$slug = basename( get_permalink());
	if ( is_single() || is_page() )
	{
		$classes[] = $slug;
		$classes[] = get_post_meta( get_the_ID(), '_tribe_custom_body_class', true);
	}
	/**
	 * Sidebar logic is complex. If is_single(), try to get the custom
	 * setting set by the user. If that doesn't exist, use the default
	 * setting for single. Rinse and repeat for non-archive is_page().
	 * Otherwise, use default for archive, since there can be no custom
	 * setting for archives.
	 */
	if ( is_page_template( 'squeeze-template.php' )){
		$sidebar="no-sidebar";
	}
	else if ( is_single() )
	{
		$sidebar = get_post_meta( get_the_ID(), '_tribe_custom_layout', true);
		/**
		 * The only way $sidebar could possibly be empty is if they
		 * created the page prior to installing this theme.
		 */
		if ( empty( $sidebar ) || $sidebar == "default" )
		{
			$sidebar = nc_tribe_get_option( 'default-layout-single' );
		}

	}
	else if ( is_page() && ! is_page_template( 'page_blog.php' ) )
	{
		$sidebar = get_post_meta( get_the_ID(), '_tribe_custom_layout', true);
		if ( empty( $sidebar ) || $sidebar == "default" )
		{
			$sidebar = nc_tribe_get_option( 'default-layout-pages' );
		}

	}
	else // HAS to be an archive page at this point
	{
		$sidebar = nc_tribe_get_option( 'default-layout-archives' );
	}
	$classes[] = $sidebar;

	if ( ! is_front_page() && ! is_home() )
	{
		$classes[] = 'not_home';
	}
	if ( has_nav_menu( 'tribe-above' ) )
	{
		$classes[] = 'has_nav_menu_tribe_above';
	}
	else
	{
		$classes[] = 'not_has_nav_menu_tribe_above';
	}
	if ( has_nav_menu( 'tribe-below' ) )
	{
		$classes[] = 'has_nav_menu_tribe_below';
	}
	else
	{
		$classes[] = 'not_has_nav_menu_tribe_below';
	}

	if ( ! is_single() && ( ! is_page() || is_page_template( 'page_blog.php' ) ) )
	{
		$classes[] = 'archive';
	}
	if ( ! is_page() || is_page_template( 'page_blog.php' ) )
	{
		$classes[] = 'single_or_archive';
	}
	if ( nc_tribe_get_option('header-contains') == 'logo' )
	{
		$classes[] = 'tribe_logo';
	}
	else
	{
		$classes[] = 'tribe_text';
	}
	if ( ( is_front_page() || is_page_template( 'page_blog.php' ) ) && is_active_sidebar( 'feature-box' ) )
	{
		$classes[] = 'has_feature_box';
	}
	if  ( nc_tribe_get_option( 'layout' ) == 'centered' && !is_page_template( 'squeeze-template.php' ) )
	{
		$classes[] = 'centered';
	}
	$classes[] = 'custom';
	return $classes;
}

/* Mailchimp */

function tribe_mc_signup($mailchimpListId,$showFirst,$showLast){
	$content = "";
	if ($mailchimpListId!="" && nc_tribe_get_option('mailchimp-api-key')!=""){
		$content .= "<form class='newsletter-signup ajax-submit' method='post'>";
		$content .= "<div class='inside'><input type='hidden' name='newsletter-type' value='MC'>";
		$content .= "<input type='hidden' name='list-id' value='" . $mailchimpListId . "'>";
		$content .= "<div><label>Email</label><input name='email' type='email'/></div>";
		if ($showFirst){
			$content .= "<div><label>First Name</label><input name='first-name' type='text'/></div>";
		}
		if ($showLast){
			$content .= "<div><label>Last Name</label><input name='last-name' type='text'/></div>";
		}
		$content .= "<div><input type='submit' value='Subscribe'/></div></div><div class='response-message'></div>";
		$content .= "</form>";
	}
	return $content;
}

if ( isset( $_POST['newsletter-type'] )){
	if($_POST['newsletter-type']=="MC"){
		//Validate
		if (!ctype_alnum($_POST["list-id"])){
			die();
		}
		if ((strlen( $_POST['email']) > 256) || (strlen( $_POST['first-name']) > 256) || (strlen( $_POST['last-name']) > 256)){
			die();
		}
		$fields["email_address"] = $_POST['email'];
		$fields["status"] = "subscribed";
		if (isset($_POST['first-name'])){
			$fields["merge_fields"]["FNAME"] = $_POST['first-name'];
		}
		if (isset($_POST['last-name'])){
			$fields["merge_fields"]["LNAME"] = $_POST['last-name'];
		}

		$listId = $_POST["list-id"];

		$tribeResponse = tribe_mc_api("lists/" . $listId . "/members/",$fields);
		$response = array();
		if($tribeResponse->status=="400"){
			$response["message"] = "You are already subscribed to this list.";
		} else {
			$response["message"] = "Thanks for subscribing!";
		}
		echo json_encode($response);
	}
	die();
}

if ( isset( $_GET['reset_tribe_custom_functions'] ) && is_user_logged_in() )
{
  $tribe_settings = tribe_get_options();

  $custom_functions = $tribe_settings['custom-functions'];
  /**
	 * Download file to user's desktop. No reason they have to lose their
	 * hard (but broken) work.
	 */
	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename=custom-functions.php");
	print $custom_functions;

	/**
	 * Fix the actual problem by restoring the custom functions.php to its
	 * defaults, then leave the page (otherwise the entire DOM will be
	 * written to custom-functions.php. The alternative is to generate the file
	 * on the server and then redirect people to a download page, but that would
	 * assume that www-data can write to files on the server, which isn't always
	 * the case, and I want this to work on as many installations as posssible).
	 */
  $tribe_settings['custom-functions'] = tribe_default_custom_functions();
  update_option( 'tribe-settings', $tribe_settings );
	exit;
}
$php = nc_tribe_get_option( 'custom-functions' );
if ( ! empty( $php ) )
{
	/**
	 * This guarantees that the Custom Functions are not eval() with
	 * actual <?php ?> syntax inside the evaluated string
	 */
	$php = trim ( $php );
	$php = ltrim( $php, '<?php' );
	$php = rtrim( $php, '?>' );
	/**
	 * eval() has its hazards, but this is really the only way to let
	 * the user write custom PHP in a standalone theme.
	 */
	eval( $php );
}
if ( isset( $_POST['tribe_export'] ) )
{
	$data = get_option( 'tribe-settings' );
	$data = json_encode( $data );
	$data = base64_encode( $data );
	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename=tribe-settings.txt");
	print $data;
	exit;
}

function tribe_update_settings( $data, $encoded = true )
{
	if ( $encoded )
	{
		$data = base64_decode( $data );
		$data = json_decode( $data, true );
		//$data = $data[0];
	}
	/**
	 * This ensures that we retain data from new fields that did not
	 * exist at the time of export. Ensures backwards compatability.
	 */
	$tribe_settings = get_option( 'tribe-settings' );
	foreach ( $data as $key=>$value )
	{
		$tribe_settings[$key] = $value;
	}
	update_option( 'tribe-settings', $tribe_settings );
}

function tribe_api_url()
{
	return 'http://members.tribetheme.com/';
}

add_filter( 'widget_text', 'wptexturize' );
add_filter( 'widget_tribe_social', 'wptexturize' );
add_filter( 'widget_tribe_feature_box', 'wptexturize' );
