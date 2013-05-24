<?php get_header(); ?>
<?php get_sidebar(); ?>
			<div id="center">
				<div id="center-in">
					<?php if (have_posts()) : ?>					
				 	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2 class="pagetitle">Archive for the &#8216;<?php echo single_cat_title(); ?>&#8217; Category</h2>
				 	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
					<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2 class="pagetitle">Author Archive</h2>
					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2 class="pagetitle">Blog Archives</h2>
					<?php } ?>
					<?php while (have_posts()) : the_post(); ?>					
					<?php include ("post.php"); ?>
					<?php endwhile; ?>

					<div class="pagenav">
						<div class="left"><?php next_posts_link('&laquo; Previous Entries') ?></div>
						<div class="right"><?php previous_posts_link('Next Entries &raquo;') ?></div>
					</div>
					<?php else : ?>
					<h2 class="center">Not Found</h2>
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					<?php endif; ?>
				</div> <!-- end #center -->
			</div> <!-- end #center-in -->
		</div> <!-- end #content-wrap -->
<?php get_footer(); ?>