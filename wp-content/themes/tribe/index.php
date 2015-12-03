<?php 

get_header(); 

do_action('tribe_before_content');

//query_posts($query_string . '&order=ASC');
if ( ! have_posts() )
{
	echo '<p>Sorry, we couldn\'t find anything that matched what you were after.</p>';
}
else while ( have_posts() )
{
	the_post();
	echo tribe_format_archive_post();
}

do_action('tribe_after_content');

get_footer();
