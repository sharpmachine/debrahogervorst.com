	<?php if(brunelleschi_options('sidebar') !== 'none'): ?>
		<div id="sidebar-two" class="widget-area <?php brunelleschi_secondary_sidebar_class(); ?>" role="complementary">
			<!-- Unified into one widget area, as of 1.1.8 -->
			<?php if ( is_active_sidebar( 'ternary-widget-area' ) ) : ?>
					
				<div class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'ternary-widget-area' ); ?>
					</ul>
				</div><!-- #secondary .widget-area -->
			
			<?php endif; ?>
			
			<!-- Unified into one widget area, as of 1.1.8 -->
			<?php if ( is_active_sidebar( 'quaternary-widget-area' ) ) : ?>
					
				<div class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'quaternary-widget-area' ); ?>
					</ul>
				</div><!-- #secondary .widget-area -->
			
			<?php endif; ?>
		</div><!-- #primary .widget-area -->
	<?php endif; ?>