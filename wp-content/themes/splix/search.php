<?php get_header(); ?>

<?php $options = get_option('splix_options'); ?>

<div id="wrapper">
	<div id="content">

<?php	if (have_posts()) { ?>            
			<div class="msgbox"><?php echo __('Search results for:','splix') . " <b>" . wp_specialchars($s, 1) . "</b>"; ?></div>

<?php		while (have_posts()) {
				the_post(); ?>
				
				<div class="post" id="post-<?php the_ID(); ?>">
                	<div class="title">
                		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo __('Permanent Link to','splix'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                	</div>
			<?php	if(function_exists('the_ratings')) { ?>
                        <span class="rating">
            <?php			the_ratings(); ?>
                        </span>
            <?php	} ?>
                	<div class="post-date">
                    	<div class="month"><?php the_time(__('M','splix')); ?></div>
                        <div class="day"><?php the_time(__('jS','splix')); ?></div>
                	</div>
                	<div class="info">
                		<div class="act">
                <?php		if ($comments || comments_open()) { ?>
                        		<span class="comments"><?php comments_popup_link(__('No comments', 'splix'), __('1 comment', 'splix'), __('% comments', 'splix')); ?></span>
                <?php		}    
               				edit_post_link(__('Edit', 'splix'), '<span class="editpost">', '</span>'); ?>
                    		<span class="author_post"><?php the_author_posts_link(); ?></span>
                    	</div>
					</div>
					<div class="entry">
						<?php the_content(__('Read more...','splix')); ?>
					</div>
			<?php 	if(function_exists('selfserv_sexy')) { selfserv_sexy(); } ?>
					<div class="metadata">
				<?php 	if($options['post_show_categories']) { ?>
                            <div class="categories"><?php the_category(', '); ?></div>
                <?php	}
                        if($options['post_show_tags']) { ?>
                            <div class="tags"><?php the_tags('', ', ', ''); ?></div>
                <?php	} ?>
                	</div>
				</div>
	<?php	} ?>
    
    		<div class="scroller">
            	<div class="newer"><?php previous_posts_link(__('Next posts', 'splix')); ?></div>
                <div class="older"><?php next_posts_link(__('Previous posts', 'splix')); ?></div>
            </div>
	
<?php	} else { ?>

            <div class="msgerror"><?php _e('Not found','splix') ?></div>
            <div class="msgbox"><?php _e('Sorry, no posts matched your criteria. Please, try again.', 'splix'); ?></div>

<?php	} ?>
		
	</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>