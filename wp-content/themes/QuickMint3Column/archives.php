<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="center">
	<div id="center-in">
		<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<h2>Archives by Subject:</h2>
		<ul>
	 		<?php wp_list_categories(); ?>
		</ul>
	</div> <!-- end #center -->
</div> <!-- end #center-in -->
</div> <!-- end #content-wrap -->
<?php get_footer(); ?>∑