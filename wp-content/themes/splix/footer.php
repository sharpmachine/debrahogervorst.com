<?php $options = get_option('splix_options'); ?>
            
            </div>
            <div id="bottom_widgets">
            	<div class="cover">
		<?php		//Bottom_left block
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Bottom_Left") ) { ?>
        <?php		} ?>
                </div>
            	<div class="cover">
        <?php		//Bottom center block
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Bottom_Center") ) { ?>
        <?php		} ?>
                </div>
            	<div class="cover last">
        <?php		//Bottom right block
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Bottom_Right") ) { ?>
        <?php		} ?>
        		</div>
    		</div>
            <div id="footer">
        <?php	if($options['first_year']) {
                    echo __('Copyright &copy;','splix') . " " . $options['first_year'] . " - " . date(__('Y','splix')) . " " . get_bloginfo('name');
                } else {
                    echo __('Copyright &copy;','splix') . " " . date(__('Y','splix')) . " " . get_bloginfo('name');
                } ?>.
				<?php _e('Powered by','splix'); ?> <a href="http://wordpress.org">WordPress</a>. <?php _e("Template by",'splix');?> <a href='http://www.splact.com'>Splact</a>.
                <br/>
                <?php 	if($options['show_rss']) { ?> 
	                <span class="mini_rss"><a href="<?php echo ($options['rss_url']) ? $options['rss_url'] : get_bloginfo('rss2_url'); ?>"><?php _e('Rss 2.0','splix'); ?></a></span>
		<?php	} ?>
      	<?php 	if($options['show_sitemap']) { ?> 
                	<span class="sitemap"><a href="<?php echo $options['sitemap_url']; ?>"><?php _e('Sitemap','splix'); ?></a></span>
        <?php	} ?>
                <span class="mini_xhtml">Valid XHTML 1.1</span>
                <span class="mini_css">Valid CSS 3</span>
            </div>
        </div>
		<?php wp_footer(); ?>
        <!--[if lte IE 6]>
            <script src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.<?php if (__('en_UK','splix') != 'en_UK') _e('en_UK','splix'); ?>.pack.js"></script>
        <![endif]-->
    </body>
</html>