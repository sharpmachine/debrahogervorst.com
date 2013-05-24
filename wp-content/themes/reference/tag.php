<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage reference
 * @since reference 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Tag Archives: %s', 'reference' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
			<?php get_sidebar( 'bottom' ); ?>
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
