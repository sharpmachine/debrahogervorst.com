<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="center">
	<div id="center-in">
		<?php if (have_posts()) : ?>		
		<?php while (have_posts()) : the_post(); ?>							
		<?php include ("post.php"); ?>
		<?php endwhile; ?>					
		<div id="pagenav">
			<div class="left"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="right"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>
		<?php else : ?>
			<p>No posts found. Try a different search?</p>
		<?php endif; ?>
	</div> <!-- end #center -->
</div> <!-- end #center-in -->
</div> <!-- end #content-wrap -->
<?php get_footer(); ?>