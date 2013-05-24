<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php the_content(''); ?>
		<p><?php the_tags(); ?></p>
		
		<div id="related-random">
		<?php if (function_exists('matt_random_redirect')) { ?>
		<p>&#x2192; You can <a href="<?php bloginfo('url'); ?>/?random" title="Stumble on a Random Article">Stumble on a Random Article</a> on this site for further reading.</p>
		<?php } ?>
		
		<?php if (function_exists('related_posts')) { ?>
		<p>
		&#x2192; Or, You can read the following available related articles from this site
		<ul><?php related_posts(); ?></ul>
		</p>
		<?php } ?>
		</div>
		
		<script src="http://feeds.feedburner.com/~s/ojustme?i=<?php the_permalink() ?>" type="text/javascript" charset="utf-8"></script>
		
		<p class="single-postmeta">
			<strong><abbr title="<?php the_author_description(); ?>"><?php the_author(); ?></abbr></strong>
			posted this article under <?php the_category(', ') ?>
			on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
			You can follow any responses to this entry through the <?php comments_rss_link('RSS'); ?> feed.

			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
			// Both Comments and Pings are open ?>
			You can <a href="#respond">leave a comment</a> or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.

			<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
			// Only Pings are Open ?>
			Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

			<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
			// Comments are open, Pings are not ?>
			You can <a href="#respond">skip to the end</a> and leave a comment. Pinging is currently not allowed.

			<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
			// Neither Comments, nor Pings are open ?>
			Both comments and pings are currently closed.

			<?php }
			edit_post_link('Edit this Article','<br />',''); ?>
						
		</p>
		<p><script src="http://feeds.feedburner.com/~s/ojustme?i=<?php the_permalink() ?>" type="text/javascript" charset="utf-8"></script></p>
	</div>
		
	<?php comments_template(); ?>

<?php endwhile; else : ?>

<div class="post">
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
</div>

<?php endif; ?>

<div class="navigation">
	<p>
		<?php previous_post_link('Prev Article &larr; %link') ?><br />
		<?php next_post_link('Next Article &rarr; %link') ?>
	</p>
</div>

</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>