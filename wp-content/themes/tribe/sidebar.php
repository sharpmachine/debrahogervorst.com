<?php

add_action('tribe_after_content', 'tribe_sidebar');
function tribe_sidebar()
{
	/**
	 * This is a copy and paste from functions.php. Sigh.
	 */

	if ( is_page_template( 'squeeze-template.php' )){
		$sidebar="no-sidebar";
	}
	else if ( is_single() )
	{
		$sidebar = get_post_meta( get_the_ID(), '_tribe_custom_layout', true);
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

	if ( $sidebar != 'no-sidebar' && is_active_sidebar( 'sidebar' ) )
	{
		echo '<div id="sidebar">';
		dynamic_sidebar( 'sidebar' );
		echo '</div><!-- end .sidebar-->';
	}
	do_action( 'tribe_after_sidebar' );
}


