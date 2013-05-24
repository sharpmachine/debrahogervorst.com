<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2>Links</h2>
		<ul><?php get_links_list(); ?></ul>
		<p><?php edit_post_link('&uarr; edit this page'); ?></p>
	</div>

<?php endwhile; ?>

<!-- START: navigation -->
<div class="navigation">
	<div class="alignleft"><?php next_posts_link('&larr; Previous Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Next Entries &rarr;') ?></div>
</div>
<!-- END: navigation -->

<?php else : ?>

<div class="post">
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
</div>

<?php endif; ?>
</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>