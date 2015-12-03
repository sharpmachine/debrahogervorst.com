<?php

add_action('tribe_after_content', 'tribe_paginate', 0);

// This is a direct copy and paste from Twenty Fourteen theme.
// Got to love GPL licensing.
function tribe_paginate() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$prevText = "&larr; Newer";
	$nextText = "Older &rarr;";

	if(isset($GLOBALS['wp_query']->query["order"]) && $GLOBALS['wp_query']->query["order"]=="ASC"){
		$prevText = "&larr; Previous";
		$nextText = "Next &rarr;";
	}
	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( $prevText, 'twentyfourteen' ),
		'next_text' => __( $nextText, 'twentyfourteen' ),
	) );

	if ( $links )
	{
		echo '

		<div class="pagination">' . $links . '</div>';
	}
}



?>
