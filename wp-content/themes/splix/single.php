<?php get_header(); ?>

<?php $options = get_option('splix_options'); ?>

<div id="wrapper">
	<div id="content">
<?php	if (have_posts()) : while (have_posts()) : the_post(); ?>        
            <div class="scroller top">
                <div class="newer"><?php previous_post_link('%link') ?></div>
                <div class="older"><?php next_post_link('%link') ?></div>
            </div>
    <?php	if($options['post_show_path']) { ?>
                <div id="post_path">
                    <a href="<?php echo get_settings('home'); ?>/"><?php _e('Homepage', 'splix'); ?></a> &bull; <?php the_category(', '); ?> &bull; <?php the_title(); ?>
                </div>
    <?php	} ?>
            
            <div class="post" id="post-<?php the_ID(); ?>">
                <div class="title">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo __('Permanent Link to','splix'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                </div>
			<?php	if(function_exists('the_ratings')) { ?>
                        <span class="rating">
            <?php			the_ratings(); ?>
                        </span>
            <?php	} ?>
        <?php	if($options['post_show_date']) { ?>
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
                        <span class="author_post"><?php the_author_posts_link(); ?></span>
                    </div>
                </div>
                <div class="entry">
                    <?php the_content(__('Read more...','splix')); ?>
                </div>
                
                <?php wp_link_pages("before=" . "<span class=page_links>" . __('Pages:') . "&after=</span>"); ?>
                
		<?php 	if(function_exists('selfserv_sexy')) { selfserv_sexy(); } ?>
                <div class="metadata">
            <?php 	if($options['post_show_categories']) { ?>
                        <div class="categories"><?php the_category(', '); ?></div>
            <?php	}
                    if($options['post_show_tags']) { ?>
                        <div class="tags"><?php the_tags('', ', ', ''); ?></div>
            <?php	} ?>
                    <div class="fixed"></div>
            <?php	if($options['post_show_date']) { ?>
                        <span class="date"><?php the_date(__('F jS, Y','splix')); ?></span>
            <?php 	}
                    if($options['post_show_time']) { ?>
                        <span class="time"><?php the_time(__('g:i a','splix')); ?></span>
            <?php	} ?>
    <?php			if (comments_open()) { ?>
                        <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'splix'); ?></a></span>
    <?php			} ?>
    <?php			if (pings_open()) { ?>
                        <span class="trackback"><a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('Trackback', 'splix'); ?></a></span>
    <?php			}
                    if($options['post_show_feed']) { ?>
                        <span class="rss"><?php comments_rss_link(__('Follow this post','splix')); ?></span>
            <?php	} ?>
                </div>
            </div>
            
<?php		comments_template(); ?>
        
<?php		endwhile; else: ?>
        
            <p>Sorry, no posts matched your criteria.</p>
	
<?php	endif; ?>
		
        <div class="scroller">
            <div class="newer"><?php previous_post_link('%link') ?></div>
            <div class="older"><?php next_post_link('%link') ?></div>
        </div>
	
	</div>
	
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
