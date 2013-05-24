<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="postmetadata"><?php the_time('M jS, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><?php edit_post_link('e &hellip;', ' | ', ''); ?></p>
		<?php the_content('&rarr; continue reading'); ?>
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
	<p class="center">Sorry, but you are looking for something that isn't here. Looks like the site does not have articles yet!</p>
</div>

<?php endif; ?>
</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>