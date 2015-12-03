<?php

/**
 * Template Name: Story
 *
 */

 get_header();

 do_action('tribe_before_content');
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 $cat = get_post_meta( get_the_ID(), '_tribe_story_category', true );
 query_posts('order=ASC&cat='. $cat . '&paged=' . $paged);
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

?>