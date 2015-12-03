<?php

get_header();

do_action('tribe_before_content');

while ( have_posts() )
{
	the_post();
	echo tribe_format_page();
}

do_action('tribe_after_content');

get_footer();
