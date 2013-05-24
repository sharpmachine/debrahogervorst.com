<?php
/**
 * The Header widget areas.
 *
 * @package WordPress
 * @subpackage reference
 * @since reference 1.0
 */
?>

<?php
	/* The header widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-header-widget-area'  )
		&& ! is_active_sidebar( 'second-header-widget-area' )
		&& ! is_active_sidebar( 'third-header-widget-area'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

			<div id="header-widget-area" role="complementary">

<?php if ( is_active_sidebar( 'first-header-widget-area' ) ) : ?>
				<div id="header-first" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'first-header-widget-area' ); ?>
					</ul>
				</div><!-- #first .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-header-widget-area' ) ) : ?>
				<div id="header-second" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'second-header-widget-area' ); ?>
					</ul>
				</div><!-- #second .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-header-widget-area' ) ) : ?>
				<div id="header-third" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'third-header-widget-area' ); ?>
					</ul>
				</div><!-- #third .widget-area -->
<?php endif; ?>

			</div><!-- #header-widget-area -->
