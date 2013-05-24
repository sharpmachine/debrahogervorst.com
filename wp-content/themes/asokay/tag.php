<?php
/* Theme: Asokay by andreasviklund.com - Based on Toolbox by Automattic */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

				<?php the_post(); ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'asokay' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>
				</header>

				<?php rewind_posts(); ?>

				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-above">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'asokay' ); ?></h1>
						<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'asokay' ) ); ?></div>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'asokay' ) ); ?></div>
					</nav><!-- #nav-above -->
				<?php endif; ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>
				
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'asokay' ); ?></h1>
						<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'asokay' ) ); ?></div>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'asokay' ) ); ?></div>
					</nav><!-- #nav-below -->
				<?php endif; ?>				

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>