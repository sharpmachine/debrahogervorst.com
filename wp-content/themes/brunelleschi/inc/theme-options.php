<?php

/* Brunelleschi Options Page */
$settings_prefix = 'brunelleschi_options';
add_action( 'admin_init', $settings_prefix.'_init' );
add_action( 'admin_menu', $settings_prefix.'_add_page' );
add_action( 'admin_init', $settings_prefix.'_scripts');

/* Brunelleschi Settings Scripts */
function brunelleschi_options_scripts(){
	/* Additional Scripts */
		wp_register_script('brunelleschi-options-scripts', get_template_directory_uri() . '/js/brunelleschi-options-scripts.js', array());
		wp_enqueue_script('brunelleschi-options-scripts');
}

/* Brunelleschi Options Init */
function brunelleschi_options_init(){
	global $settings_prefix;
	register_setting( $settings_prefix.'_group', $settings_prefix, $settings_prefix.'_sanitize' );
}

/* Brunelleschi Options Add Page */
function brunelleschi_options_add_page() {
	global $settings_prefix;
	add_theme_page( __( 'Brunelleschi Options', 'brunelleschi' ), __( 'Brunelleschi Options', 'brunelleschi' ), 'edit_theme_options', $settings_prefix, $settings_prefix.'_render' );
}

/* Brunelleschi Options Fields */
function brunelleschi_options_fields($tab) {

	if($tab === 'general'){
		$brunelleschi_options_fields = array(
			'start' => array(
				'type' => 'start'
			),
			'icon' => array(
				'type' => 'icon'
			),
			'title' => array(
				'type' => 'title',
				'value' => __('Brunelleschi Theme Settings','brunelleschi')
			),
			'form-start' => array(
				'type' => 'form-start'
			),
			'section-start' => array(
				'type' => 'section-start',
				'heading' => __('Display Settings','brunelleschi')
			),
			'fonts' => array(
				'type' => 'select',
				'name' => 'fonts',
				'label' => __('Use Alternative Fonts?','brunelleschi'),
				'description' => __('Choose a Font Set','brunelleschi'),
				'options' => array(
					__('Classic','brunelleschi'),
					__('Modern','brunelleschi')
				),
				'std' => __('Classic','brunelleschi')
			),
			'left-heading' => array(
				'type' => 'checkbox',
				'name' => 'left-heading',
				'label' => __('Use Left Aligned Header Text?','brunelleschi'),
				'description' => __('Check to left align header text.','brunelleschi'),
				'std' => ''
			),
			'use-featured-content' => array(
				'type' => 'checkbox',
				'name' => 'use-featured-content',
				'label' => __('Use a Featured Content Slider?','brunelleschi'),
				'description' => __('Featured content slider overrides the header image','brunelleschi'),
				'std' => ''
			),
			'header-order' => array(
				'type' => 'select',
				'name' => 'header-order',
				'label' => __('Header Text or Banner Image on Top?','brunelleschi'),
				'description' => __('Choose the order you want the header to display.','brunelleschi'),
				'options' => array(
					__('Text on Top','brunelleschi'),
					__('Text on the Left','brunelleschi'),
					__('Text on the Right','brunelleschi'),
					__('Text on the Bottom','brunelleschi')
				),
				'std' => __('Text on Top','brunelleschi')
			),
			'hide-navigation' => array(
				'type' => 'checkbox',
				'name' => 'hide-navigation',
				'label' => __('Hide Navigation?','brunelleschi'),
				'description' => __('Check to add a hide the primary navigation','brunelleschi'),
				'std' => ''
			),
			'center-navigation' => array(
				'type' => 'checkbox',
				'name' => 'center-navigation',
				'label' => __('Center Navigation?','brunelleschi'),
				'description' => __('Check to center the primary navigation','brunelleschi'),
				'std' => ''
			),
			'navigation-position' => array(
				'type' => 'select',
				'name' => 'navigation-position',
				'label' => __('Pick Navigation Position.','brunelleschi'),
				'description' => __('Navigation above the banner, below, or within the body column?','brunelleschi'),
				'options' => array(
					__('Nav Above Banner','brunelleschi'),
					__('Nav Below Banner','brunelleschi'),
					__('Nav Fixed to Top of Screen', 'brunelleschi')
				),
				'std' => __('Nav Below Banner','brunelleschi')
			),
			'sidebar' => array(
				'type' => 'select',
				'name' => 'sidebar',
				'label' => __('Left, Right, None, or Both Sidebars?','brunelleschi'),
				'description' => __('Pick which side you want the sidebar on. Choose none for no sidebar.','brunelleschi'),
				'options' => array(
					__('left','brunelleschi'),
					__('right','brunelleschi'),
					__('none','brunelleschi'),
					__('both','brunelleschi'),
					__('two left', 'brunelleschi'),
					__('two right', 'brunelleschi')
				),
				'std' => __('right','brunelleschi')
			),
			'sidebar-width' => array(
				'type' => 'select',
				'name' => 'sidebar-width',
				'label' => __('Sidebar Width?','brunelleschi'),
				'description' => __('Pick a number between two and four.','brunelleschi'),
				'options' => array(
					__('two','brunelleschi'),
					__('three','brunelleschi'),
					__('four','brunelleschi')
				),
				'std' => __('three','brunelleschi')
			),
			'content-width' => array(
				'type' => 'select',
				'name' => 'content-width',
				'label' => __('Content Width:','brunelleschi'),
				'description' => __('Choose the overall Content Width in pixels.','brunelleschi'),
				'std' => '960',
				'options' => array(
					'800',
					'960',
					'1024',
					'1140'
				)
			),
			'posted-on' => array(
				'type' => 'select',
				'name' => 'posted-on',
				'label' => __('Posted On Position:','brunelleschi'),
				'description' => __('This is the part that says <b>by AUTHOR posted on DATE</b>.','brunelleschi'),
				'options' => array(
					__('Above Post','brunelleschi'),
					__('Below Post','brunelleschi'),
					__('Hidden','brunelleschi')
				),
				'std' => 'Above Post'
			),
			'archives-format' => array(
				'type' => 'checkbox',
				'name' => 'archives-format',
				'label' => __('Show Full Post in Archives and Tags?','brunelleschi'),
				'description' => __('Check to show full post, uncheck for excerpt.','brunelleschi'),
				'std' => '',
			),
			'box-shadow' => array(
				'type' => 'checkbox',
				'name' => 'box-shadow',
				'label' => __('Use box shadow?','brunelleschi'),
				'description' => __('Check to add a groovy box shadow (new browsers only)','brunelleschi'),
				'std' => ''
			),
			'extra-css' => array(
				'type' => 'textarea',
				'name' => 'extra-css',
				'label' => __('Custom CSS:','brunelleschi'),
				'description' => __('Caution! CSS is very powerful!','brunelleschi'),
				'std' => ''
			),
			'section-end' => array(
				'type' => 'section-end'
			),
			'form-end' => array(
				'type' => 'form-end'
			),
			'end' => array(
				'type' => 'end'
			)
		);
	}elseif($tab == 'donate'){
		$brunelleschi_options_fields = array(
			'start' => array(
				'type' => 'start'
			),
			'icon' => array(
				'type' => 'icon'
			),
			'title' => array(
				'type' => 'title',
				'value' => __('Donate','brunelleschi')
			),
			'donate' => array(
				'type' => 'donate',
				'name' => 'donate'
			),
			'end' => array(
				'type' => 'end'
			)
		);
	}

	return $brunelleschi_options_fields;
}

/* Setting Page Tabs */
function brunelleschi_get_settings_page_tabs(){
	$tabs = array(
		'general' => __('General','brunelleschi')
		,'donate' => __('Donate','brunelleschi')
	);
	return $tabs;
}

/* Brunelleschi page Tabs */
function brunelleschi_page_tabs( $current = 'general' ) {
     if ( isset ( $_GET['tab'] ) ) :
          $current = $_GET['tab'];
     else:
          $current = 'general';
     endif;
     $tabs = brunelleschi_get_settings_page_tabs();
     $links = array();
     foreach( $tabs as $tab => $name ) :
          if ( $tab == $current ) :
               $links[] = '<a class="nav-tab nav-tab-active" href="?page=brunelleschi_options&tab='.$tab.'">'.$name.'</a>';
          else :
               $links[] = '<a class="nav-tab" href="?page=brunelleschi_options&tab='.$tab.'">'.$name.'</a>';
          endif;
     endforeach;
     echo '<div id="icon-themes" class="icon32"><br /></div>';
     echo '<h2 class="nav-tab-wrapper">';
     foreach ( $links as $link )
          echo $link;
     echo '</h2>';
}

/* Render Options Page */
function brunelleschi_options_render() {
	global $settings_prefix;
	if(isset($_GET['tab'])){
		$brunelleschi_options_fields = brunelleschi_options_fields($_GET['tab']);
	}else{
		$brunelleschi_options_fields = brunelleschi_options_fields('general');
	}
	foreach ( $brunelleschi_options_fields as $key => $field ) {
		if(isset($field['name'])){ $slug = $settings_prefix.'['.$field['name'].']'; }
		$options = get_option($settings_prefix);
		switch( $field['type'] ) {
			case 'start':?>
				<div class="wrap">
				<?php brunelleschi_page_tabs(); ?>
				<?php if ( isset( $_GET['settings-updated'] ) && 'true' == esc_attr( $_GET['settings-updated'] ) ) echo '<div class="updated fade below-h2" style="padding: 5px 10px; margin: 15px 0 0 0;"><strong>' . __( 'Settings saved.', 'brunelleschi') . '</strong></div>'; ?>
				<?php
				break;
			case 'end':?>
				</div><!-- .wrap --><?php
				break;
			case 'icon':?>
				<div id="icon-options-general" class="icon32">
					<br />
				</div><?php
				break;
			case 'title':?>
				<h2><?php echo $field['value']; ?></h2><?php
				break;
			case 'form-start':?>
				<div class="metabox-holder">
				<form method="post" action="options.php">
				<?php
				settings_fields($settings_prefix . '_group');
				break;
			case 'form-end':?>
					<p class="submit">
						<input type="submit" class="button-primary" value="Save Changes" />
						<input name="reset" type="submit" class="button-secondary" value="Reset Defaults" />
					</p>
				</form>
				</div><!-- .metabox-holder --><?php
				break;
			case 'section-start':?>
				<div class="postbox-container" style="width:100%">
					<div class="meta-box-sortables">
						<div class="postbox " > 
							<div class="handlediv" title="Click to toggle">
								<br />
							</div><!-- .handlediv -->
							<h3 class='hndle'><?php echo $field['heading']; ?></h3> 
							<div class="inside">
   								<table class="form-table"><tbody><?php
				break;
			case 'section-end':?>
				</tbody></table></div><!-- .inside --></div><!-- .postbox --></div><!-- .meta-box-sortables --></div><!-- postbox-container --><?php
				break;
 			case 'checkbox':?>
 				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $slug; ?>"><?php echo $field['label']; ?></label>
					</th>
					<td>
						<?php if(isset($options[$key]['name'])){$opt = $options[$key]['name']; } else { $opt = $field['std']; } ?>
						<input type="checkbox" class="checkbox" value="1" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($field['name']); ?>" <?php checked( '1', $opt); ?> />
						<?php if ( isset($field['description']) ): ?>
						<span class="description"><?php echo $field['description']; ?></span>
						<?php endif; ?>
					</td>
 				</tr><?php
				break;
			case 'select':?>
 				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $slug; ?>"><?php echo $field['label']; ?></label>
					</th>
					<td>
						<select class="select" name="<?php echo $slug; ?>" id="<?php echo $field['name']; ?>" />
							<?php foreach($field['options'] as $option){ ?>
								<option value="<?php echo $option; ?>" <?php selected( $option, $options[$key] ); ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
						<?php if ( isset($field['description']) ): ?>
						<span class="description"><?php echo $field['description']; ?></span>
						<?php endif; ?>
					</td>
 				</tr><?php
				break;
			case 'textarea':?>
 				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $slug; ?>"><?php echo $field['label']; ?></label>
					</th>
					<td>
						<?php if(isset($options[$key])){$opt = $options[$key]; } else { $opt = $field['std']; } ?>
						<textarea class="text-area" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($field['name']); ?>" cols="50" rows="4"><?php echo esc_textarea(stripslashes($opt)); ?></textarea>
						<br/>
						<?php if ( isset($field['description']) ): ?>
						<span class="description"><?php echo $field['description']; ?></span>
						<?php endif; ?>
					</td>
 				</tr><?php
				break;
			case 'text':?>
 				<tr valign="top">
					<th scope="row">
						<label for="<?php echo $slug; ?>"><?php echo $field['label']; ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" value="<?php if ( isset($options['name'])){ echo esc_att($opt); } else { echo esc_attr($field['std']); } ?>" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($field['name']); ?>" />
						<?php if ( isset($field['description']) ): ?>
						<span class="description"><?php echo $field['description']; ?></span>
						<?php endif; ?>
					</td>
 				</tr><?php
				break;
			case 'donate':?>
				<p style="width:400px">Brunelleschi is 100% free. Don't feel obligated or required in any way to pay me for this theme. That said, if you like the theme and want to buy me a Coffee, that's great! I put a lot of time into Brunelleschi and I hope you enjoy it!</p>
				<form style="width:400px;text-align:center" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank"><input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7----- " />
				<input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="PayPal - The safer, easier way to pay online!" />
				<img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" /></form>
				<?php
				break;
		}
	}
}

/* Sanitize Options for Database */
function brunelleschi_options_sanitize($input) {
	if( isset($_POST['reset']) && $_POST['reset'] === 'Reset Defaults' ){
		$valid_input = array(
			'fonts' => __('Classic','brunelleschi'),
			'left-heading' => '',
			'use-featured-content' => '',
			'header-order' => __('Text on Top','brunelleschi'),
			'hide-navigation' => '',
			'center-navigation' => '',
			'navigation-position' => __('Nav Below Banner','brunelleschi'),
			'sidebar' => 'right',
			'sidebar-width' => __('three','brunelleschi'),
			'content-width' => '960',
			'posted-on' => __('Above Post','brunelleschi'),
			'archives-format' => '',
			'box-shadow' => '',
			'extra-css' => ''
		);
	}else{
		$valid_input = get_option('brunelleschi_options');
		$valid_input['fonts'] = (__('Classic','brunelleschi') || __('Modern','brunelleschi') === $input['fonts'] ? $input['fonts'] : $valid_input['fonts']);
		$valid_input['left-heading'] = (isset($input['left-heading']) ? '1' : '');
		$valid_input['remove-header-image-border'] = (isset($input['remove-header-image-border']) ? '1' : '');
		$valid_input['use-featured-content'] = (isset($input['use-featured-content']) ? '1' : '');
		$valid_input['header-order'] = (__('Text on Top','brunelleschi') || __('Text on the Left','brunelleschi') || __('Text on the Right','brunelleschi') || __('Text on the Bottom','brunelleschi') === $input['header-order'] ? $input['header-order'] : $valid_input['header-order']);
		$valid_input['hide-navigation'] = (isset($input['hide-navigation']) ? '1' : '');
		$valid_input['center-navigation'] = (isset($input['center-navigation']) ? '1' : '');
		$valid_input['navigation-position'] = (__('Nav Above Banner','brunelleschi') || __('Nav Below Banner','brunelleschi') || __('Nav Fixed to Top of Screen','brunelleschi') === $input['navigation-position'] ? $input['navigation-position'] : $valid_input['navigation-position']);
		$valid_input['sidebar'] = (__('left','brunelleschi') || __('right','brunelleschi') || __('none','brunelleschi') || __('both','brunelleschi') || __('two left','brunelleschi') || __('two right','brunelleschi') === $input['sidebar'] ? $input['sidebar'] : $valid_input['sidebar']);
		$valid_input['sidebar-width'] = (__('two','brunelleschi') || __('three','brunelleschi') || __('four','brunelleschi') === $input['sidebar-width'] ? $input['sidebar-width'] : $valid_input['sidebar-width']);
		$valid_input['content-width'] = ('800' || '960' || '1024' || '1140' === $input['content-width'] ? $input['content-width'] : $valid_input['content-width']);
		$valid_input['posted-on'] = (__('Above Post','brunelleschi') || __('Below Post','brunelleschi') || __('Hidden','brunelleschi') === $input['posted-on'] ? $input['posted-on'] : $valid_input['posted-on']);
		$valid_input['archives-format'] = (isset($input['archives-format']) ? '1' : '');
		$valid_input['box-shadow'] = (isset($input['box-shadow']) ? '1' : '');
		$valid_input['extra-css'] = addslashes($input['extra-css']);
	}
	return $valid_input;
}

/* Sucessful Update Message */
function brunelleschi_update_message(){
	if( isset($_GET['activated']) ){
		echo '<div id="message2" class="updated"><p>';
		$theme_data = $theme_data = wp_get_theme( trailingslashit( get_template_directory() ) . 'style.css' );
		printf( __('Thank you for using Brunelleschi version %s. Edit your theme options <a href="%s">here</a>. Learn what\'s new in version <a href="http://kitmacallister.com/2011/brunelleschi-changelog/">%s</a>.'), $theme_data['Version'], admin_url( 'themes.php?page=brunelleschi_options' ), $theme_data['Version']);
		echo '</p></div>';
	}
}

/* Temporary Update Migration Code */
/* Necessary for theme_options overhaul */
function brunelleschi_update_migration(){
	global $settings_prefix;
	$defaults = array(
			'fonts' => __('Classic','brunelleschi'),
			'left-heading' => '',
			'remove-header-image-border' => '',
			'use-featured-content' => '',
			'header-order' => __('Text on Top','brunelleschi'),
			'hide-navigation' => '',
			'center-navigation' => '',
			'navigation-position' => __('Nav Below Banner','brunelleschi'),
			'sidebar' => 'right',
			'sidebar-width' => __('three','brunelleschi'),
			'content-width' => '960',
			'posted-on' => __('Above Post','brunelleschi'),
			'archives-format' => '',
			'box-shadow' => '',
			'extra-css' => ''
		);
	if(!get_option('brunelleschi_options')){
		add_option( 'brunelleschi_options', $defaults );
	}
	$new_options = get_option('brunelleschi_options');
	foreach($defaults as $option => $val){
		if( get_option('brunelleschi_settings_'.$option) ){
			$temp = get_option('brunelleschi_settings_'.$option);
			if($temp === 'checked'){ $temp = '1'; }
			delete_option('brunelleschi_settings_'.$option);
			$new_options[$option] = $temp;
		}
	}
	update_option('brunelleschi_options',$new_options);
	add_action('validate_current_theme','brunelleschi_update_message');
}
add_action('after_setup_theme','brunelleschi_update_migration');
