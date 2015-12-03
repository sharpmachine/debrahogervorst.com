<?php

get_header();

do_action('tribe_before_content');

the_post();

echo tribe_format_single();

do_action('tribe_after_content');

get_footer();
