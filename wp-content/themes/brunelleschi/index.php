<?php get_header(); ?>
		<div id="main" role="main" class="<?php brunelleschi_content_class(); ?>">
		
		<?php get_template_part( 'loop', 'index' ); ?>
		
		</div><!-- #main -->
<?php if( brunelleschi_options('sidebar') === __('both','brunelleschi')
		|| brunelleschi_options('sidebar') === __('two left','brunelleschi')
		|| brunelleschi_options('sidebar') === __('two right','brunelleschi')){
			get_sidebar('secondary');
		} ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
