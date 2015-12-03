<?php

get_header();

do_action('tribe_before_content');

if ( nc_tribe_get_option( '404-page' ) == 'default' ) : ?>
	<h1>You CANNOT Be Serious!</h1>
			<div class="entry-content"><p><img src="<?php echo get_template_directory_uri() ?>/images/john-mcenroe.jpeg" class="alignright frame" /></p>
				<p>I've got some bad news for you:</p>
				<p><em>That URL doesn't exist.</em></p>
				<p><strong>How did you get here, anyhows? <img src='<?php echo bloginfo( 'url' ) ?>/wp-includes/images/smilies/icon_biggrin.gif' alt=':D' class='wp-smiley' /></strong></p>
				<p>Try <a href="javascript: history.go(-1)">going back</a> and seeing where you went wrong.</p>
	<p>Before you get as steamed as John McEnroe, please do me a quick favor. See your address bar? Copy the link in there and head over to the contact page. Say something like this:</p>
			<blockquote><p>Hey <?php bloginfo('name'); ?>, I just tried loading this page and I'm getting a 404 error.</p></blockquote>
			<p>Bonus points if you remember how you got here so I can fix it.</p>
			<p>Thanks! Appreciate it.</p>
			</div>


<?php else : 
	echo tribe_format_404( nc_tribe_get_option( '404-page' ) );
endif;


do_action('tribe_after_content');

get_footer();
