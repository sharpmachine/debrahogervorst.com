<?php
 // Common template for the posts
?>
<!-- post starts here -->
<div class="post" id="post-<?php the_ID(); ?>">
	<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>						
	<div class="entry">
		<?php the_content('&#x21E5; Continued'); ?>
	</div>					
	<!-- Post entry end here -->					
	<div class="postmetadata"><?php the_time('M j, Y') ?> <!-- <?php  the_author_nickname() ?>--> | <?php the_category(', ') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> <?php edit_post_link('e', ' | ', ''); ?></div>
</div>
<!-- post ends here -->