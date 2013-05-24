<?php
/**
 * The Menu widget areas.
 *
 * @package WordPress
 * @subpackage reference
 * @since reference 1.0
 */
?>

<?php
	if ( is_active_sidebar( 'menu-widget-area' ))
	{
?>

			<div id="menu-widget-area" role="complementary">
				<div id="menu-widget" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'menu-widget-area' ); ?>
					</ul>
				</div><!-- #menu .widget-area -->
			</div><!-- #menu-widget-area -->

<?php
	}
	else
		return;

?>
