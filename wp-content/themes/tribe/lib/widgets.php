<?php

register_sidebar(array(
	'name' => 'Sidebar',
	'id' => 'sidebar',
	'description' => 'You only get one sidebar. Treat it right.',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


register_sidebar(array(
	'name' => 'Feature Box',
	'id' => 'feature-box',
	'description' => 'Tribe has its very own widget just for this! See it down there?',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


register_sidebar(array(
	'name' => 'Sticky Bar',
	'id' => 'sticky-bar',
	'description' => 'FYI, we don\'t show the title field so feel free to leave that empty.',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<div style="display:none">',
	'after_title' => '</div>',
));

register_sidebar(array(
	'name' => 'End-of-Post Area',
	'id' => 'end-of-post',
	'description' => 'This appears at the end of all single blog posts.',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));

register_sidebar(array(
	'name' => 'Footer (left)',
	'id' => 'footer-left',
	'description' => 'A left widget will want a right one...',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


register_sidebar(array(
	'name' => 'Footer (right)',
	'id' => 'footer-right',
	'description' => '...and a right widget will want a left one!',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));
