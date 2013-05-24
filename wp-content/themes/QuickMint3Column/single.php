<?php get_header(); ?>
<?php get_sidebar(); ?>
			<div id="center">
				<div id="center-in">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  						
						<div class="post" id="post-<?php the_ID(); ?>">
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>						
						<div class="entry">
							<?php the_content('&#x21E5; Continued'); ?>
							<?php wp_link_pages('before=<p><strong>Pages:</strong>&after=</p>&next_or_number=number'); ?>
						</div>					
						<!-- Post entry end here -->					
						<div class="postmetadata">Posted at <?php the_time('M j, Y - g:i a') ?> by <?php the_author() ?> in <?php the_category(', ') ?><br />Follow any responses to this entry through the <?php comments_rss_link('RSS'); ?> feed.  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and <a href="#respond">leave a response</a>. Pinging is currently not allowed.
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.									
						<?php } edit_post_link('Edit this entry.','',''); ?>

						<?php comments_template(); ?>						
						<div id="pagenav">
							<div class="left"><?php previous_post_link('&laquo; %link') ?></div>
							<div class="right"><?php next_post_link('%link &raquo;') ?></div>
						</div>
						<?php endwhile; else: ?>						
						<p>Sorry, no posts matched your criteria.</p>						
						<?php endif; ?>
					</div>
					<!-- post ends here -->
				</div> <!-- end #center -->
			</div> <!-- end #center-in -->
		</div> <!-- end #content-wrap -->
<?php get_footer(); ?>