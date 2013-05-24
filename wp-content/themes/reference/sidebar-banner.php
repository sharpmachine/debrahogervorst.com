<?php
/**
 * The Top Banner widget areas.
 *
 * @package WordPress
 * @subpackage reference
 * @since reference 1.0
 */
?>

<?php
	if ( is_active_sidebar( 'top-banner-widget-area' ))
	{
?>

			<div id="banner-widget-area" role="complementary">
				<div id="banner" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'top-banner-widget-area' ); ?>
					</ul>
				</div><!-- #banner .widget-area -->
			</div><!-- #banner-widget-area -->

<?php
	}
	else
		return;
?>


