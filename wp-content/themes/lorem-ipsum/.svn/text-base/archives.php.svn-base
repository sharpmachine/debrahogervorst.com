<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2>Archives - Yearly</h2>
		<ul>
		<?php
		$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
		foreach($years as $year) : 
		?>
		<li><a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="post">
		<h2>Archives - Monthly</h2>
		<ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul>
	</div>
	<div class="post">
		<h2>Categories</h2>
		<ul><?php wp_list_categories('orderby=name&show_count=1&hide_empty=1&title_li'); ?></ul>
	</div>
	<div class="post">
		<h2>The Last 100 Article (if available)</h2>
		<ol><?php wp_get_archives('type=postbypost&limit=100&format=html'); ?></ol>
		
		<p><?php edit_post_link('&uarr; edit this page'); ?></p>
	</div>

<?php endwhile; else : ?>

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