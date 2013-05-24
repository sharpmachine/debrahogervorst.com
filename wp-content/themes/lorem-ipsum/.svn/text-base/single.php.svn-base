<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="article-jump"><a href="#article">Skip to the Article</a> &#x2193;</p>
		
		<p>
			<script type="text/javascript"><!--
			google_ad_client = "pub-4468481779445136";
			google_ad_width = 336;
			google_ad_height = 280;
			google_ad_format = "336x280_as";
			google_ad_type = "text_image";
			//2007-04-08: wp-theme-lorem-ipsum
			google_ad_channel = "2784874737"; // optional but you can add your desired adsense channel
			google_color_border = "FFFFFF";
			google_color_bg = "FFFFFF";
			google_color_link = "333333";
			google_color_text = "666666";
			google_color_url = "000000";
			//-->
			</script>
			<script type="text/javascript"
			  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</p>
		
		<a id="article"></a>
		<?php the_content(); ?>
		
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
		
		<p class="single-postmeta">
			<strong><abbr title="<?php the_author_description(); ?>"><?php the_author(); ?></abbr></strong>
			posted this article under <?php the_category(', ') ?>
			on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
			You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed.

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

			<?php } edit_post_link('Edit this entry.','',''); ?>
			<script src="http://embed.technorati.com/linkcount" type="text/javascript"></script> <a class="tr-linkcount" href="http://technorati.com/search/<?php the_permalink(); ?>">View Technorati Linkbacks.</a>
			
		</p>
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