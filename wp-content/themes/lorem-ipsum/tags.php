<?php
/*
Template Name: Tags
*/
?>

<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2><?php the_title(); ?></h2>
		<p><?php wp_tag_cloud('smallest=9&largest=26&unit=pt&orderby=name'); ?></p>
	</div>

<?php endwhile; ?>
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