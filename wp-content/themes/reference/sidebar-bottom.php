<?php
/**
 * The Content Bottom widget areas.
 *
 * @package WordPress
 * @subpackage reference
 * @since reference 1.0
 */
?>

<?php
	if ( is_active_sidebar( 'content-bottom-widget-area' ))
	{
?>

			<div id="content-bottom-widget-area" role="complementary">
				<div id="content-bottom" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'content-bottom-widget-area' ); ?>
					</ul>
				</div><!-- #content-bottom .widget-area -->
			</div><!-- #content-bottom-widget-area -->

<?php
	}
	else
		return;
?>