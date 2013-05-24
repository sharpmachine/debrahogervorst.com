<?php
/*
Template Name: Search
*/
?>

<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		
		<!-- START: Custom Search -->
		<!-- END: Custom Search -->
		
	</div>
	
	<div class="post">
		<h2>NOT HAPPY with Google powered Search?</h2>
		<p>You can always try the inbuilt Site-Search.</p>
		<?php include(TEMPLATEPATH."/searchform.php");?>
		<p><?php edit_post_link('&uarr; edit this page'); ?></p>
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
	
</div>
<!-- END: content -->
<?php get_footer(); ?>