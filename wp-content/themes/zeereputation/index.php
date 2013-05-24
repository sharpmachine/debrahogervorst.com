<?php get_header(); ?>
	
		<div id="content">
		
		<?php 
		$options = get_option('themezee_options');
		if(is_home() and isset($options['themeZee_show_slider']) and $options['themeZee_show_slider'] == 'true') {
				locate_template('/slide.php', true);
			}
		?>
		
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'loop', 'index' );
		
		endwhile; ?>
			
			<div class="more_posts">
      
			<?php if(function_exists('wp_pagenavi')) { // if PageNavi is activated ?>
				<?php wp_pagenavi(); // Use PageNavi ?>
			<?php } else { // Otherwise, use traditional Navigation ?>
			
					<span class="post_links"><?php next_posts_link(__('&laquo; Older Entries', 'themezee_lang')) ?> &nbsp; <?php previous_posts_link (__('Recent Entries &raquo;', 'themezee_lang')) ?></span>
			<?php }?>
			</div>

		<?php endif; ?>
			
		</div>
		
	<div class="clear"></div>
</div>
		
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
