<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel='stylesheet' type='text/css' href="<?php bloginfo( 'url' ); ?>/?splix-css=css" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_get_archives('type=monthly&format=link'); ?>

<?php wp_enqueue_script('jquery'); ?>

<?php $options = get_option('splix_options'); ?>

<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/comments.js"></script>
<?php if($options['menu_use_jquery']) { ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/navigation.js"></script>
<?php } ?>
</head>
<body>
<div id="page">
    <div id="header">
<?php 	if($options['show_userbar']) { ?>
            <div id="wrap_caption">
                <div id="caption">
                <?php  	global $user_ID, $user_identity;
                        get_currentuserinfo();	?>
        <?php			if (!$user_ID){	?>
                            <div class="login floatright">
                                <form action="<?php bloginfo('url') ?>/wp-login.php" method="post">
                                        <label for="log"><input type="text" name="log" class="textfield" id="log" size="22" value="Username"/></label>
                                        <label for="pwd"><input type="password" name="pwd" class="textfield" id="pwd" size="22" value="Password"/></label>
                                        <label for="rememberme" id="rememberme"><?php _e('Remember me', 'splix'); ?> <input name="rememberme" class="checker" id="rememberme" type="checkbox" checked="checked" value="forever" /></label>
                                        <input type="submit" name="submit" value="Login" class="sender" />
                                        <input type="button" value="<?php _e("Sign in", 'splix'); ?>" src="<?php bloginfo('url') ?>/wp-login.php?action=register" />
                                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
                                </form>
                            </div>
        <?php			}else{	?>
                    <div class="metafield">
        <?php			/* PRIVATE MESSAGE - is required the plugin "WP Private Messages" */
                        if(function_exists('wpu_pm_page')){	?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/users.php?page=wp-private-messages/wpu_private_messages.php" title="<?php _e('Private message','splix'); ?>"/>		
                                <span class="manage_pm"></span>
        <?php	 					$newpm = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->prefix".private_messages." WHERE rcpid = $user_ID AND status = 0");
                                    if($newpm == 0) _e('No new messages','splix'); 
                                    else	if($newpm == 1) echo $newpm . " " . __('new message','splix');
                                            else echo $newpm . " " . __('new messages','splix'); ?>
                            </a>
        <?php			}            
                        /* PUBLISH POSTS */
                        if(current_user_can('publish_posts')) {
                            $count_posts = wp_count_posts();
                            $draft_posts = $count_posts->draft;	?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/post-new.php" title="<?php _e('Add New Post','splix') ?>">
                                <span class="add_post"></span>
                            </a>
        <?php		 		if($draft_posts == 1) { ?>
                                <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/edit.php?post_status=draft" title="<?php _e('drafts','splix'); ?>">
                                    <span class="manage_draft"></span>
                                    <?php echo $draft_posts . " " . __('draft','splix'); ?>
                                </a>
        <?php				} elseif($draft_posts>1) { ?>
                                <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/edit.php?post_status=draft" title="<?php _e('drafts','splix'); ?>">
                                    <span class="button manage_draft"></span>
                                    <?php echo $draft_posts . " " . __('drafts','splix'); ?>
                                </a>
        <?php				}
                        }
                        /* ADD LINKS */
                        if(current_user_can('manage_links')) { ?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/link-add.php" title="<?php _e('Add New Link','splix') ?>">
                                <span class="add_link"></span>
                            </a>
        <?php		 	}
                        /* ADD FILE TO DOWNLOAD - is required the plugin "WP-DownloadManager" */
                        if (current_user_can('manage_downloads') && function_exists('download_file')) { ?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/admin.php?page=wp-downloadmanager/download-add.php" title="<?php _e('Add New File','splix') ?>">
                                <span class="add_file"></span>
                            </a>
        <?php 			}
                        /* EDIT THEMES */
                        if(current_user_can('edit_themes')) { ?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/themes.php" title="<?php _e('Layout','splix') ?>">
                                <span class="manage_layout"></span>
                            </a>
        <?php 			}
                        /* MANAGE PLUGINS */
                        if(current_user_can('activate_plugins')) { ?>
                            <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/plugins.php" title="<?php _e('Plugins','splix')	?>">
                                <span class="manage_plugins"></span>
                            </a>
        <?php 			}
                        /* USER ONLINE - is required the plugin "WP-UserOnline" */
                        if(function_exists('get_useronline')) {
                            if(current_user_can('moderate_comments')) {	?>
                                <a href="<?php echo get_settings('siteurl'); ?>/wp-admin/index.php?page=wp-useronline" title="<?php _e('Users Online','splix') ?>">
                                    <span class="user_online"></span>
                                </a>
        <?php			 	}
                        } ?>
                        <a href="<?php echo get_option('siteurl'); ?>/wp-admin/">
                            <span class="user"></span>
                            <?php echo $user_identity; ?>
                        </a>
                        <a href="<?php echo get_option('siteurl') . '/author/' . $user_identity ?>">
                            <span class="posts"></span>
                            <?php echo get_usernumposts($user_ID); ?>
                        </a>
                        <a href="#">
                            <span class="comments"></span>
                  <?php		$count_comments = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $wpdb->comments WHERE user_id = %d", $user_ID));
                            echo $count_comments; ?>
                        </a>
                        <a href="<?php echo wp_logout_url('$index.php'); ?>">
                            <span class="logout"></span>
                            <?php _e('Logout', 'splix'); ?>
                        </a>
                </div>
    <?php			}	?>
            </div>
        </div>
<?php 	} ?>
        <div id="wrap_info">
            <div id="info"<?php echo " style='background:url(" . $options['title_fg_url'] . ") " . $options['title_fg_css'] . "'" ?>>
     <?php		if ($options['info_position'] == 'left') {
	 			 	if($options['show_title']) { ?>
						<span class="title floatleft"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></span>
		 <?php		}
					if($options['show_description']) { ?>
						<span class="description floatleft"><?php bloginfo('description'); ?></span>
		 <?php		}
		 		} else {
					if($options['show_description']) { ?>
						<span class="description floatright"><?php bloginfo('description'); ?></span>
		 <?php		}
					if($options['show_title']) { ?>
						<span class="title floatright"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></span>
		 <?php		}
		 		} ?>
            </div>
        </div>
<?php	if($options['menu_show_pages']) { ?>
			<div id="wrap_pages">
				<div class="set_middle">
					<ul class="pages nav">
<?php					if($options['menu_show_home']) { ?>
                    		<li class="home">
                        		<a href="<?php echo get_settings('siteurl'); ?>">
                                	<img src="<?php bloginfo('template_url'); ?>/img/icons/house.png" alt="<?php _e('Homepage','splix'); ?>"/>
                                </a>
                        	</li>
<?php					}
						wp_list_pages('title_li=0&sort_column=menu_order');	?>
					</ul>
				</div>
			</div>
<?php	} ?>
<?php 	if($options['menu_show_categories']) { ?>
			<div id="wrap_cats">
				<div class="set_middle">
					<ul class="categories nav">
						<?php	wp_list_categories('title_li=0&orderby=name&show_count=0');	?>
					</ul>
				</div>
			</div>
<?php	} ?>
    </div>
    <div id="wrap_wrapper">