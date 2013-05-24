<?php $options = get_option('splix_options'); ?>
    <div id="sidebar">
<?php 	include (TEMPLATEPATH . '/searchform.php'); ?>

<?php	//RSS
		if($options['show_rss']) {
			$rss_url = ($options['rss_url'] == '') ? get_bloginfo('rss2_url') : $options['rss_url']; ?>
            <div class="grip top">
                <span class="rss"><a href="<?php echo $rss_url; ?>"><?php _e('Follow this weblog','splix'); ?></a></span>
            </div>
<?php	}

	 	//Top block
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Top") ) { ?>
<?php	}		
		
		//Meta buttons		
		global $user_ID, $user_identity;
		if($user_ID) { ?>
			<div class="grip bottom">
				<span class="user">
					<a href="<?php echo get_settings('siteurl'); ?>/wp-admin/">
						<?php echo $user_identity; ?>
					</a>
				</span>
			</div>
			<div class="grip bottom">
				<span class="logout">
					<a href="<?php echo wp_logout_url('$index.php'); ?>">
						<?php _e('Logout', 'splix'); ?>
					</a>
				</span>
			</div>
<?php	}else{ ?>
            <div class="grip bottom">
                <span class="login">
                    <a href="<?php bloginfo('url') ?>/wp-login.php">
                        <?php _e('Login', 'splix'); ?>
                    </a>
                </span>
            </div>
            <div class="grip bottom">
                <span class="signin">
                    <a href="<?php bloginfo('url') ?>/wp-login.php?action=register">
                        <?php _e("Sign in", 'splix'); ?>
                    </a>
                </span>
            </div>
<?php	} ?>
	</div>