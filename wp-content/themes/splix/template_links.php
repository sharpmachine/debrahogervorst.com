<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<?php $options = get_option('splix_options'); ?>

<div id="wrapper">
	<div id="content">

<?php	if (have_posts()) {
			while (have_posts()) {
				the_post(); ?>
                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="title">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo __('Permanent Link to','splix'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    </div>
			<?php	if(function_exists('ADDTOANY_SHARE_SAVE_BUTTON')) { ?>
                        <div class="a2a_grip">
                            <?php ADDTOANY_SHARE_SAVE_BUTTON(); ?>
                        </div>
            <?php	} ?>
   			<?php	if($options['page_show_date']) { ?>
                        <div class="post-date">
                            <div class="month"><?php the_time(__('M','splix')); ?></div>
                            <div class="day"><?php the_time(__('jS','splix')); ?></div>
                        </div>
			<?php	}else{ ?>
                        <div class="filler">
                        </div>
            <?php	} ?>
                    <div class="info">
                        <div class="act">
                            <?php if ($comments || comments_open()) { ?>
                                <span class="comments"><a href="#comments"><?php _e('Go to comments', 'splix'); ?></a></span>
                                <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'splix'); ?></a></span>
                            <?php } ?>
                            <?php edit_post_link(__('Edit', 'splix'), '<span class="editpost">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="entry">
						<?php wp_list_bookmarks(); ?>
                    </div>
			<!-- <?php	if(function_exists('the_ratings')) { ?>
                        <span class="rating">
            <?php			the_ratings(); ?>
                        </span>
            <?php	} ?> delete the comment tags if you want to use ratings for the link page -->
                    <div class="metadata">
				<?php	if($options['page_show_date']) { ?>
                            <span class="date"><?php the_date(__('F jS, Y','splix')); ?></span>
                <?php 	}
                        if($options['page_show_time']) { ?>
                            <span class="time"><?php the_time(__('g:i a','splix')); ?></span>
                <?php	} ?>
        <?php			if (comments_open()) { ?>
                            <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'splix'); ?></a></span>
        <?php			} ?>
        <?php			if (pings_open()) { ?>
                            <span class="trackback"><a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('Trackback', 'splix'); ?></a></span>
        <?php			}
						if($options['page_show_feed']) { ?>
							<span class="rss"><?php comments_rss_link(__('Follow this page','splix')); ?></span>
				<?php	} ?>
                    </div>
                </div>
				<?php comments_template(); ?>
<?php		}
		} ?>
	</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
