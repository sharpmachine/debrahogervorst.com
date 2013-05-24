<?php get_header(); ?>

<?php $options = get_option('splix_options'); ?>

<div id="wrapper">
	<div id="content">

        <div class="scroller top">
            <div class="newer"><?php previous_posts_link(__('Next posts', 'splix')); ?></div>
            <div class="older"><?php next_posts_link(__('Previous posts', 'splix')); ?></div>
        </div>
        
<?php	if (have_posts()) { ?>

<?php		$post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php		if (is_category()) {	// If this is a category archive ?>				
				<div class="msgbox"><?php printf(__('Archive for the <b>%1$s</b> category','splix'), single_cat_title('', false)); ?></div>
<?php		} elseif(is_tag()) {	// If this is a tag archive ?>
				<div class="msgbox"><?php printf(__('Posts Tagged <b>%1$s</b>', 'splix'), single_tag_title('', false)); ?></div>
<?php		} elseif (is_day()) {	// If this is a daily archive ?>
				<div class="msgbox"><?php _e('Archive for','splix'); ?> <b><?php the_date(__('F jS, Y','splix')); ?></b></div>
<?php		} elseif (is_month()) {	// If this is a monthly archive ?>
				<div class="msgbox"><?php _e('Archive for','splix'); ?> <b><?php the_time(__('F, Y','splix')); ?></b></div>
<?php		} elseif (is_year()) { // If this is a yearly archive ?>
				<div class="msgbox"><?php _e('Archive for','splix'); ?> <b><?php the_time(__('Y','splix')); ?></b></div>
<?php		} elseif (is_author()) { ?>
				<div class="msgbox"><?php _e('Author Archive','splix'); ?></div>
<?php		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {	// If this is a paged archive ?>
				<div class="msgbox"><?php _e('Blog Archives','splix'); ?></div>
<?php		} ?>

<?php		while (have_posts()) {
				the_post(); ?>
				
				<div class="post" id="post-<?php the_ID(); ?>">
                	<div class="title">
                		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo __('Permanent Link to','splix'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                	</div>
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
			<?php	if(function_exists('the_ratings')) { ?>
                        <span class="rating">
            <?php			the_ratings(); ?>
                        </span>
            <?php	} ?>
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
<?php		} ?>
	
<?php	} else { ?>

			<div class="msgerror"><?php _e('Not found','splix') ?></div>
            <div class="msgbox"><?php _e('Sorry, no posts matched your criteria. Please, try again.', 'splix'); ?></div>
            <?php include (TEMPLATEPATH . '/searchform.php'); ?>

<?php	} ?>
		
        <div class="scroller">
            <div class="newer"><?php previous_posts_link(__('Next posts', 'splix')); ?></div>
            <div class="older"><?php next_posts_link(__('Previous posts', 'splix')); ?></div>
        </div>
        
	</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>