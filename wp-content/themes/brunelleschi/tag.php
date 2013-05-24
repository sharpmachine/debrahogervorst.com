<?php get_header(); ?>
		
		<div id="main" role="main" class="<?php brunelleschi_content_class(); ?>">

			<h1 class="page-title"><?php
				printf( __( 'Tag Archives: %s', 'brunelleschi' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
			</h1>

			<?php get_template_part( 'loop', 'tag' ); ?>
		</div><!-- #main -->
<?php if( brunelleschi_options('sidebar') === __('both','brunelleschi')
		|| brunelleschi_options('sidebar') === __('two left','brunelleschi')
		|| brunelleschi_options('sidebar') === __('two right','brunelleschi')){
			get_sidebar('secondary');
		} ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
