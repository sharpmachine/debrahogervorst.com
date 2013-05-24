<?php
/* Theme: Asokay by andreasviklund.com - Based on Toolbox by Automattic */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'asokay' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'asokay' ), '<span class="edit-link">', '</span>' ); ?>
	<br class="clear-content" />
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
