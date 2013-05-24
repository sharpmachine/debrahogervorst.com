<?php load_theme_textdomain('splix', TEMPLATEPATH . '/languages'); ?>
<?php	//Registering SIDEBAR WIDGET-READY
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) { 
			if ( function_exists('register_sidebar') ) {
				register_sidebar(array(
					'name' => 'Top',
					'before_widget' => '<div class="widget">',
					'after_widget' => '</div></div>',
					'before_title' => '<span class="widget_title">',
					'after_title' => '</span><div class="widget_content">'
				));	
				register_sidebar(array(
					'name' => 'Bottom_Left',
					'before_widget' => '<div class="widget">',
					'after_widget' => '</div></div>',
					'before_title' => '<span class="widget_title">',
					'after_title' => '</span><div class="widget_content">'
				));
				register_sidebar(array(
					'name' => 'Bottom_Center',
					'before_widget' => '<div class="widget">',
					'after_widget' => '</div></div>',
					'before_title' => '<span class="widget_title">',
					'after_title' => '</span><div class="widget_content">'
				));
				register_sidebar(array(
					'name' => 'Bottom_Right',
					'before_widget' => '<div class="widget">',
					'after_widget' => '</div></div>',
					'before_title' => '<span class="widget_title">',
					'after_title' => '</span><div class="widget_content">'
				));
			} 
		} 
	
		/* splix OPTIONS */
		class splixOptions {
			function getOptions() {
				$options = get_option('splix_options');
				if (!is_array($options)) {
					//userbar
						$options['show_userbar'] = true;
					//navigation
						$options['menu_show_pages'] = true;
						$options['menu_show_categories'] = false;
						$options['menu_use_jquery'] = false;
						$options['menu_show_home'] = true;
					//title
						$options['show_title'] = true;
						$options['show_description'] = true;
						$options['info_position'] = "left";
					//Color style
						$options['color_title'] = "F0F0F0";
						$options['color_description'] = "BBBBBB";
						$options['color5'] = "1D1D1D";
						$options['color6'] = "0D0D0D";
						$options['color_ub1'] = "2E2D28";
						$options['color_ub2'] = "5C5B56";
						$options['color_ub3'] = "BDBDBD";
						$options['color_bg1'] = "E0E0E0";
						$options['color_bg2'] = "EEEEEE";
						$options['color_pg1'] = "1D1D1D";
						$options['color_pg2'] = "5A5954";
						$options['color_cat1'] = "F8F8F8";
						$options['color_cat2'] = "A7B522";
						$options['color4'] = "A7B522";
						$options['color_cbg1'] = "FFFFFF";
						$options['color_cbg2'] = "F5F5F5";
						$options['color_text'] = "555555";
					//title bg
						$options['title_bg_type'] = "default";
						$options['title_bg_color'] = "black";
						$options['title_bg_url'] = "";
						$options['title_bg_css'] = "";
					//title fg
						$options['title_fg_url'] = "";
						$options['title_fg_css'] = "";
					//information message
						$options['show_info'] = false;
						$options['info_content'] = "";
					//posts
						$options['post_show_categories'] = true;
						$options['post_show_tags'] = true;
						$options['post_show_feed'] = true;
						$options['post_show_date'] = true;
						$options['post_show_time'] = true;
						$options['post_show_path'] = false;
					//pages
						$options['page_show_feed'] = false;
						$options['page_show_date'] = false;
						$options['page_show_time'] = false;
					//footer
						$options['first_year'] = '';
						$options['show_sitemap'] = false;
						$options['sitemap_url'] = "";
						$options['show_rss'] = true;
						$options['rss_url'] = "";
					
					update_option('splix_options', $options);
				}
				return $options;
			}
			
			function add() {
				if(isset($_POST['splix_save'])) {
					$options = splixOptions::getOptions();
					
					//options USERBAR
						if ($_POST['show_userbar']) $options['show_userbar'] = true;
						else $options['show_userbar'] = false;
					//options MENU
						if ($_POST['menu_show_pages']) $options['menu_show_pages'] = true;
						else $options['menu_show_pages'] = false;
						if ($_POST['menu_show_categories']) $options['menu_show_categories'] = true;
						else $options['menu_show_categories'] = false;
						if ($_POST['menu_use_jquery']) $options['menu_use_jquery'] = true;
						else $options['menu_use_jquery'] = false;
						if ($_POST['menu_show_home']) $options['menu_show_home'] = true;
						else $options['menu_show_home'] = false;
					//options TITLE
						if ($_POST['show_title']) $options['show_title'] = true;
						else $options['show_title'] = false;
						if ($_POST['show_description']) $options['show_description'] = true;
						else $options['show_description'] = false;
						$options['info_position'] = stripslashes($_POST['info_position']);
					//Color style
						$options['color_title'] = stripslashes($_POST['color_title']);
						$options['color_description'] = stripslashes($_POST['color_description']);
						$options['color5'] = stripslashes($_POST['color5']);
						$options['color6'] = stripslashes($_POST['color6']);
						$options['color_ub1'] = stripslashes($_POST['color_ub1']);
						$options['color_ub2'] = stripslashes($_POST['color_ub2']);
						$options['color_ub3'] = stripslashes($_POST['color_ub3']);
						$options['color_bg1'] = stripslashes($_POST['color_bg1']);
						$options['color_bg2'] = stripslashes($_POST['color_bg2']);
						$options['color_pg1'] = stripslashes($_POST['color_pg1']);
						$options['color_pg2'] = stripslashes($_POST['color_pg2']);
						$options['color_cat1'] = stripslashes($_POST['color_cat1']);
						$options['color_cat2'] = stripslashes($_POST['color_cat2']);
						$options['color4'] = stripslashes($_POST['color4']);
						$options['color5'] = stripslashes($_POST['color5']);
						$options['color6'] = stripslashes($_POST['color6']);
						$options['color_cbg1'] = stripslashes($_POST['color_cbg1']);
						$options['color_cbg2'] = stripslashes($_POST['color_cbg2']);
						$options['color_text'] = stripslashes($_POST['color_text']);
					//options TITLE BG
						$options['title_bg_type'] = stripslashes($_POST['title_bg_type']);
						$options['title_bg_color'] = stripslashes($_POST['title_bg_color']);
						$options['title_bg_url'] = stripslashes($_POST['title_bg_url']);
						$options['title_bg_css'] = stripslashes($_POST['title_bg_css']);
					//options TITLE FG
						$options['title_fg_url'] = stripslashes($_POST['title_fg_url']);
						$options['title_fg_css'] = stripslashes($_POST['title_fg_css']);
					//options INFO
						if ($_POST['show_info']) $options['show_info'] = true;
						else $options['show_info'] = false;
						$options['info_content'] = stripslashes($_POST['info_content']);
					//post options CATEGORIES, TAGS, FEED, DATE & TIME
						if ($_POST['post_show_categories']) $options['post_show_categories'] = true;
						else $options['post_show_categories'] = false;
						if ($_POST['post_show_tags']) $options['post_show_tags'] = true;
						else $options['post_show_tags'] = false;
						if ($_POST['post_show_feed']) $options['post_show_feed'] = true;
						else $options['post_show_feed'] = false;
						if ($_POST['post_show_date']) $options['post_show_date'] = true;
						else $options['post_show_date'] = false;
						if ($_POST['post_show_time']) $options['post_show_time'] = true;
						else $options['post_show_time'] = false;
						if ($_POST['post_show_path']) $options['post_show_path'] = true;
						else $options['post_show_path'] = false;
					//page options FEED, DATE & TIME
						if ($_POST['page_show_feed']) $options['page_show_feed'] = true;
						else $options['page_show_feed'] = false;
						if ($_POST['page_show_date']) $options['page_show_date'] = true;
						else $options['page_show_date'] = false;
						if ($_POST['page_show_time']) $options['page_show_time'] = true;
						else $options['page_show_time'] = false;
					//options FOOTER
						$options['first_year'] = stripslashes($_POST['first_year']);
						if ($_POST['show_sitemap']) $options['show_sitemap'] = true;
						else $options['show_sitemap'] = false;
						$options['sitemap_url'] = stripslashes($_POST['sitemap_url']);
						if ($_POST['show_rss']) $options['show_rss'] = true;
						else $options['show_rss'] = false;
						$options['rss_url'] = stripslashes($_POST['rss_url']);
					
					//UPDATE
					update_option('splix_options', $options);
				} else {
					splixOptions::getOptions();
				}

				add_theme_page(__('Theme Options', 'splix'), __('Theme Options', 'splix'), 'edit_themes', basename(__FILE__), array('splixOptions', 'display'));
			}
			
			function display() {
				$options = splixOptions::getOptions(); ?>
				<?php wp_enqueue_script('jquery'); ?>
                <?php wp_enqueue_script('jquery-color'); ?>
                <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/optionspage.js"></script>
                <div class="wrap">
                    <h2><?php _e('Theme Options', 'splix'); ?></h2>
            <?php	_e('Before you start blogging with Splix is recommended to set up the options listed below. If you like this theme and want to help its developing, you can do a little donation with Paypal. Thanks.','splix'); ?>
                    <div align="center">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="7265103">
                            <input type="image" style="vertical-align:middle;" src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                            <img alt="" border="0" src="https://www.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
					<form action="#" method="post" enctype="multipart/form-data" name="splix_form" id="splix_form">
                        <p class="submit">
                            <input class="button-primary" type="submit" name="splix_save" value="<?php _e('Save', 'splix'); ?>" />
                        </p>
                        
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Userbar', 'splix'); ?></th>
                                    <td>
                                        <label style="margin-right:20px;">
                                            <input name="show_userbar" type="checkbox" <?php if($options['show_userbar']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show userbar.', 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Menubar', 'splix'); ?></th>
                                    <td>
                                        <label style="margin-right:20px;">
                                            <input name="menu_show_pages" type="checkbox" value="pages" <?php if($options['menu_show_pages']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show pages in the menu.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="menu_show_categories" type="checkbox" value="categories" <?php if($options['menu_show_categories']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show categories in the menu.', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label>
                                            <input name="menu_show_home" type="checkbox" value="home" <?php if($options['menu_show_home']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show the homepage link in the menu (it will be the first page).', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label>
                                            <input name="menu_use_jquery" type="checkbox" value="jquery" <?php if($options['menu_use_jquery']) echo "checked='checked'"; ?> />
                                        	<?php _e('Activate the jQuery library in the header.', 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                
                		<table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Title', 'splix'); ?></th>
                                    <td>
                                    	<label style="margin-right:20px;">
                                        	<input class="jq_titdesc" name="show_title" type="checkbox" value="title" <?php if($options['show_title']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show the blog title.', 'splix'); ?>
                                        </label>
                                        <label style="margin-right:20px;">
                                        	<input class="jq_titdesc" name="show_description" type="checkbox" value="description" <?php if($options['show_description']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show the blog description.', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label style="margin-right:20px;">
                                        	<?php _e("Select the title position:", 'splix'); ?>
                                        	<input name="info_position" type="radio" value="left" <?php if($options['info_position'] == 'left') echo "checked='checked'"; ?> /> left
                                            <input name="info_position" type="radio" value="right" <?php if($options['info_position'] == 'right') echo "checked='checked'"; ?> /> right
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                            
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Colors', 'splix'); ?></th>
                                    <td>
                                    	<div style="clear:both;">
<!-- 									 title | description | userbar bg, border, text | bg: (top) (bottom) | pg bg | pg text | cats bg | cats text | buttons | title bg top,bottom |  cbg  |  cbg2  |  ctext -->
<input type="button" onclick="ApplyStyle('5D5D5D', '999999', '4E4D48', '7C7B76', 'DDDDDD', 'EDEFEF', 'FAFCFF', 'FFFFFF', '555555', 'FEFFFF', '8F9E00', '8F9E00', 'F5F8FC', 'E6EDF6', 'FFFFFF', 'F5F8FC', '555555')" value="<?php _e('default', 'splix'); ?>"/> | 
<input type="button" onclick="ApplyStyle('DCEFF4', '1B4046', '2E2D28', '5C5B56', 'BDBDBD', '80B0C0', '8DBAC0', '1B4046', 'EDFAF0', 'EDFAF0', '9A3431', '9A3431', '467A81', '265A61', 'FFFFFF', 'F5F5F5', '555555')" value="london classic"/> | 
<input type="button" onclick="ApplyStyle('555555', 'BBBBBB', '265579', '5C5B56', 'CDCDCD', 'FAF8F9', 'FFFFFF', '265579', 'FAF8F9', 'F5F5FF', '5685A9', '5685A9', 'FAF8F9', 'EAE8E9', 'FFFFFF', 'F5F5F5', '555555')" value="winter mirror"/>
                                        </div>
                                        <div id="color_titdesc" style="float:left; margin-right: 15px; margin-top:15px; padding:5px; border:1px dashed #ddd">                                       
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_title" type="text" maxlength="6" size="6" value="<?php echo $options['color_title'] ?>"/>
                                                <i><?php _e('Title text', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_description" type="text" maxlength="6" size="6" value="<?php echo $options['color_description'] ?>"/>
                                                <i><?php _e('Description text', 'splix'); ?></i>
                                            </label>
                                        </div>
                                        <div style="float:left; margin-top:15px; margin-right:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color5" type="text" maxlength="6" size="6" value="<?php echo $options['color5'] ?>"/>
                                                <i><?php _e('Title background gradient (TOP)', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color6" type="text" maxlength="6" size="6" value="<?php echo $options['color6'] ?>"/>
                                                <i><?php _e('Title background gradient (BOTTOM)', 'splix'); ?></i>
                                            </label>
                                        </div>
                                        <div id="color_ub" style="float:left; margin-top:15px; margin-right:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_ub1" type="text" maxlength="6" size="6" value="<?php echo $options['color_ub1'] ?>" />
                                                <i><?php _e('Userbar background', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_ub2" type="text" maxlength="6" size="6" value="<?php echo $options['color_ub2'] ?>"/>
                                                <i><?php _e('Userbar border', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_ub3" type="text" maxlength="6" size="6" value="<?php echo $options['color_ub3'] ?>"/>
                                                <i><?php _e('Userbar text', 'splix'); ?></i>
                                            </label>
                                        </div>
                                        <div id="color_pg" style="float:left; margin-right: 15px; margin-top:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_pg1" type="text" maxlength="6" size="6" value="<?php echo $options['color_pg1'] ?>"/>
                                                <i><?php _e('Pages menu background', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_pg2" type="text" maxlength="6" size="6" value="<?php echo $options['color_pg2'] ?>"/>
                                                <i><?php _e('Pages menu text', 'splix'); ?></i>
                                            </label>
										</div>
                                        <div id="color_cat" style="float:left; margin-right: 15px; margin-top:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">    
                                                <div class="showcolor"></div>
                                                <input name="color_cat1" type="text" maxlength="6" size="6" value="<?php echo $options['color_cat1'] ?>"/>
                                                <i><?php _e('Categories menu background', 'splix'); ?></i>
                                            </label>
                                            <br/>
                                            <label style="margin-right:20px; clear:both;">    
                                                <div class="showcolor"></div>
                                                <input name="color_cat2" type="text" maxlength="6" size="6" value="<?php echo $options['color_cat2'] ?>"/>
                                                <i><?php _e('Categories menu text', 'splix'); ?></i>
                                            </label>
										</div>
                                        <div style="float:left; margin-right: 15px; margin-top:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_bg1" type="text" maxlength="6" size="6" value="<?php echo $options['color_bg1'] ?>"/>
                                                <i><?php _e('Background gradient (TOP)', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_bg2" type="text" maxlength="6" size="6" value="<?php echo $options['color_bg2'] ?>"/>
                                                <i><?php _e('Background gradient (BOTTOM)', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color4" type="text" maxlength="6" size="6" value="<?php echo $options['color4'] ?>"/>
                                                <i><?php _e('Buttons | Highlighting | Anchored text', 'splix'); ?></i>
                                            </label>
                                        </div>
                                        <div style="float:left; margin-top:15px; padding:5px; border:1px dashed #ddd">
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_cbg1" type="text" maxlength="6" size="6" value="<?php echo $options['color_cbg1'] ?>"/>
                                                <i><?php _e('Content background', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_cbg2" type="text" maxlength="6" size="6" value="<?php echo $options['color_cbg2'] ?>"/>
                                                <i><?php _e('Content box background', 'splix'); ?></i>
                                            </label>
                                            <br />
                                            <label style="margin-right:20px; clear:both;">
                                                <div class="showcolor"></div>
                                                <input name="color_text" type="text" maxlength="6" size="6" value="<?php echo $options['color_text'] ?>"/>
                                                <i><?php _e('Content text', 'splix'); ?></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                        
                       	<table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Title Foreground', 'splix'); ?></th>
                                    <td>
                                    	<label style="margin-right:20px;">
                                        	<input name="title_fg_url" type="text" size="50" value="<?php echo $options['title_fg_url'] ?>"/>
                                        	<?php _e('Define a personal foreground (write the absolute url of this).<br />The max size that will be displayed is 930x85.', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label style="margin-right:20px;">
                                        	<input name="title_fg_css" type="text" size="50" value="<?php echo $options['title_fg_css'] ?>"/>
                                        	<?php _e("Define the css 'background' values.", 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                        
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e('Info', 'splix'); ?>
                                        <br/>
                                        <small style="font-weight:normal;"><?php _e('HTML enabled', 'splix'); ?></small>
                                    </th>
                                    <td>
                                        <!-- notice START -->
                                        <label>
                                            <input name="show_info" type="checkbox" value="checkbox" <?php if($options['show_info']) echo "checked='checked'"; ?> />
                                        	<?php _e('This info message will be displayed at the top of posts (only in the homepage).', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label>
                                            <textarea name="info_content" id="info_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['info_content']); ?></textarea>
                                        </label>
                                        <!-- notice END -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Posts: Categories, Tags, Feed, Date & Time', 'splix'); ?></th>
                                    <td>
                                        <label style="margin-right:20px;">
                                            <input name="post_show_categories" type="checkbox" value="checkbox" <?php if($options['post_show_categories']) echo "checked='checked'"; ?> />
                                            <?php _e('Show categories on posts.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="post_show_tags" type="checkbox" value="checkbox" <?php if($options['post_show_tags']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show tags on posts.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="post_show_feed" type="checkbox" value="checkbox" <?php if($options['post_show_feed']) echo "checked='checked'"; ?> />
                                       		<?php _e('Show feed on posts.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="post_show_date" type="checkbox" value="checkbox" <?php if($options['post_show_date']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show date on posts.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="post_show_time" type="checkbox" value="checkbox" <?php if($options['post_show_time']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show time on posts.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="post_show_path" type="checkbox" value="checkbox" <?php if($options['post_show_path']) echo "checked='checked'"; ?> />
                                        	<?php _e('Show path on posts.', 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Pages: Feed, Date & Time', 'splix'); ?></th>
                                    <td>
                                        <label>
                                            <input name="page_show_feed" type="checkbox" value="checkbox" <?php if($options['page_show_feed']) echo "checked='checked'"; ?> />
                                            <?php _e('Show feed on pages.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="page_show_date" type="checkbox" value="checkbox" <?php if($options['page_show_date']) echo "checked='checked'"; ?> />
                                            <?php _e('Show date on pages.', 'splix'); ?>
                                        </label>
                                        <label>
                                            <input name="page_show_time" type="checkbox" value="checkbox" <?php if($options['page_show_time']) echo "checked='checked'"; ?> />
                                            <?php _e('Show time on pages.', 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Footer', 'splix'); ?></th>
                                    <td>
                                    	<label>
                                            <input name="first_year" type="text" size="4" maxlength="4" value="<?php echo $options['first_year']; ?>" />
                                        	<?php _e("Set a first year for copyright (leave empty if you don't want to display it).", 'splix'); ?>
                                        </label>
                                        <br /><br />
                                        <label>
                                            <input name="show_sitemap" type="checkbox" value="checkbox" <?php if($options['show_sitemap']) echo "checked='checked'"; ?> />
                                            <?php _e('Show sitemap.', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label>
                                            <input name="sitemap_url" type="text" size="50" value="<?php echo $options['sitemap_url']; ?>" />
                                            <?php _e('Sitemap url.', 'splix'); ?>
                                        </label>
                                        <br /><br />
                                        <label>
                                            <input name="show_rss" type="checkbox" value="checkbox" <?php if($options['show_rss']) echo "checked='checked'"; ?> />
                                            <?php _e('Show rss.', 'splix'); ?>
                                        </label>
                                        <br />
                                        <label>
                                            <input name="rss_url" type="text" size="50" value="<?php echo $options['rss_url']; ?>" />
                                            <?php _e('Custom rss url. (leave empty if you want use the default url)', 'splix'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                
                        <p class="submit">
                            <input class="button-primary" type="submit" name="splix_save" value="<?php _e('Save', 'splix'); ?>" />
                        </p>
                	</form>
				</div>
<?php
			}
		}
		
		// parse request for stylesheet : /?splix-css=css
		add_action( 'parse_request', 'splix_wp_request' );
		function splix_wp_request( $wp ) {
			if ( !empty( $_GET['splix-css'] ) && $_GET['splix-css'] == 'css') {
			
				$options = get_option('splix_options');
				$tmpURL = get_bloginfo('template_url');
				
				header( 'Content-Type: text/css' );
				require dirname( __FILE__ ) . '/style.php';
				exit;
			}
		}
		
		// register functions
		add_action('admin_menu', array('splixOptions', 'add'));
		
?>