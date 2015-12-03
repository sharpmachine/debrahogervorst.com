<?php

/**
* This lets us actually have shortcodes inside of our posts and pages
*/
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 11);

add_shortcode('theme', 'nc_tribe_theme');
function nc_tribe_theme() {
	return get_stylesheet_directory_uri();
}

add_shortcode( 'word-count', 'tribe_words');
function tribe_words()
{
	global $post;
	$char_list = "";
	return str_word_count(strip_tags($post->post_content), 0, $char_list);
}

add_shortcode('minute-count', 'tribe_minutes');
function tribe_minutes() {
	return ceil( tribe_words() / 250 );
}

add_shortcode( 'author', 'tribe_author' );
function tribe_author()
{
	return get_the_author_link();
}

add_shortcode( 'author-with-archive-link', 'tribe_author_archive_link' );
function tribe_author_archive_link()
{
	ob_start();
	the_author_posts_link();
	$data = ob_get_contents();
	ob_clean();
	return $data;
}

add_shortcode( 'specialbox', 'tribe_specialbox' );
add_shortcode( 'special', 'tribe_specialbox' );
function tribe_specialbox( $atts, $content = null )
{
	return '<div class="special">' . $content . '</div>';
}

add_shortcode( 'loggedin', 'tribe_loggedin_shortcode' );
function tribe_loggedin_shortcode( $atts, $content = null )
{
	return is_user_logged_in() ? $content : "";
}

add_shortcode( 'not_loggedin', 'tribe_notloggedin_shortcode' );
function tribe_notloggedin_shortcode( $atts, $content = null )
{
	return ! is_user_logged_in() ? $content : "";
}


add_shortcode( 'callout', 'tribe_callout' );
function tribe_callout( $atts, $content = null )
{
	return '<div class="content-box-yellow">' . $content . '</div>';
}

add_shortcode( 'bluebox', 'tribe_bluebox' );
function tribe_bluebox( $atts, $content = null )
{
	return '<div class="content-box-blue">' . $content . '</div>';
}


add_shortcode( 'popular-articles', 'tribe_popular_articles' );
function tribe_popular_articles( $args )
{
	extract( shortcode_atts( array(
		'category' => 'Popular',
		'showposts' => '15',
		'showcommentcount' => 'yes'
	), $args ) );

	$output = '<div class="popular">';

	query_posts('category_name=' . $category . '&showposts=' . $showposts);
	while ( have_posts() )
	{
		the_post();

		$output .= '<div class="popular-article"><li><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title();

		if ( $showcommentcount == 'yes' )
		{
			$output .= ' <span class="comment-number">' . get_comments_number('0', '1', '%') . '</span>';
		}
		$output .= '</a></li></div>';
	}

	$output .= '</div>';

	wp_reset_query();

	return $output;
}

add_shortcode( 'comments', 'tribe_comments' );
function tribe_comments()
{
	$data = '<a href="' . get_permalink();
	/**
	* Check to see if Disqus is active
	*/
	if ( function_exists( 'dsq_identifier_for_post' ) )
	{
		$data .= '#disqus_thread">';
	}
	else
	{
		$data .= '#comments">';
	}
	ob_start();
	comments_number( 'Leave a Comment', '1 Comment', '% Comments' );
	$data .= ob_get_contents();
	ob_end_clean();
	$data .= '</a>';
	return $data;
}
add_shortcode('button', 'tribe_button');
function tribe_button( $args )
{
	if ( isset( $args['link'] ) && isset( $args['text'] ) )
	{
		return sprintf( '<center><a class="btn" href="%s">%s</a></center>', $args['link'], $args['text'] );
	}
	return "";
}
add_shortcode( 'date', 'tribe_date' );
function tribe_date()
{
	return get_the_date();
}

add_shortcode( 'edit', 'tribe_edit' );
function tribe_edit()
{
	ob_start();
	edit_post_link( '(Edit)' );
	$data = ob_get_contents();
	ob_end_clean();
	return $data;
}
add_shortcode( 'tags', 'nc_tribe_tags' );
function nc_tribe_tags() {
	$tags = get_the_tags();
	if ( $tags ) {
	$html = '<span class="post-tags">';
	$i = 0;
	foreach ( $tags as $tag ) {
		$i++;
		$tag_link = get_tag_link( $tag->term_id );

		$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
		$html .= "{$tag->name}</a>";
		if ( $i != count( $tags ) )
		{
			$html .= ', ';
		}
	}
	$html .= '</span>';
	return $html;
}
return "";
}
add_shortcode( 'year', 'tribe_current_year' );
function tribe_current_year()
{
	return date('Y');
}

add_shortcode( 'site-name', 'tribe_site_name' );
function tribe_site_name()
{
	return get_bloginfo( 'name' );
}

add_shortcode( 'categories', 'tribe_list_categories' );
function tribe_list_categories()
{
	$categories = get_the_category();
	$output = "";
	$separator = ', ';
	if ( count( $categories ) == 2 )
	{
		$separator = ' ';
	}
	foreach( $categories as $category )
	{
		static $i = 0; $i ++;
		if ( count( $categories ) == $i + 1 )
		{
			$separator .= 'and ';
		}
		else if ( count( $categories ) == $i )
		{
			$separator = '';
		}

		$output .= '<a href="'.get_category_link( $category->term_id ) .'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator;
	}
	return $output;
}

add_shortcode( 'share-quote', 'tribe_share_quote' );
function tribe_share_quote($args,$content)
{
	global $post;
	$via = nc_tribe_get_option('twitter-handle');
	if ( isset( $args['via'] )){
		$via = $args['via'];
	}
	$output = '<script type="text/javascript" async src="//platform.twitter.com/widgets.js"></script>';
	$output.= '<div class="share-quote"><div class="share-quote-quote">“</div>';
	$output.= '<div class="share-quote-text">' . $content . '</div>';
	$shareCopy= $content;
	if ( isset( $args['author'] )){
		$output.='<div class="share-quote-author">' . $args['author'] . '</div>';
		$shareCopy.=" - " . $args['author'];
	}
	$twitterIntentUrl = 'https://twitter.com/intent/tweet?url=' . get_permalink() . '&text=' . $shareCopy;
	if ($via!=""){
		$twitterIntentUrl.='&via=' . $via;
	}
	$output.='</div><div class="share-quote-shares"><div class="share-quote-shares-block">Tweet this</div><div class="share-quote-shares-block"><a title="Tweet This" href="' . $twitterIntentUrl . '" class="share-quote-twitter">Tweet</a></div></div>';
	return $output;
}
