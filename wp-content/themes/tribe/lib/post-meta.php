<?php

/**
 * Adds the "Custom body class" option for posts and pages
 */

add_action( 'add_meta_boxes', 'tribe_add_custom_body_class_option' );
add_action( 'save_post', 'tribe_save_custom_body_class');

function tribe_add_custom_body_class_option()
{
	// Show the box on pages and posts
	$post_types = array( 'post', 'page');
	foreach( $post_types as $type )
	{
		add_meta_box( 'custom-body-class', 'Custom Body Class', 'tribe_custom_body_class', $type, 'side', 'low' );
	}
}

function tribe_save_custom_body_class( $post_id )
{
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
	{
		return $post_id;
	}
	update_post_meta( $post_id, '_tribe_custom_body_class', isset( $_POST['tribe-custom-body-class'] ) ? $_POST['tribe-custom-body-class'] : '' );
}

function tribe_custom_body_class()
{
	$setting = get_post_meta( get_the_ID(), '_tribe_custom_body_class', true );
	echo '<input type="text" id="default-layout" name="tribe-custom-body-class" value="' . $setting . '">';
}

/**
 * In-house implementation of my Don't Muck My Markup plugin
 */

add_action( 'add_meta_boxes', 'tribe_add_markup_option' );
add_action( 'save_post', 'tribe_save_markup_option');

function tribe_add_markup_option()
{
	// Show the box on pages and posts
	$post_types = array( 'post', 'page');
	foreach( $post_types as $type )
	{
		add_meta_box( 'custom-markup', 'Disable Auto Formatting', 'tribe_disable_markup', $type, 'side', 'low' );
	}
}

function tribe_save_markup_option( $post_id )
{
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
	{
		return $post_id;
	}
	update_post_meta( $post_id, '_tribe_disable_markup', isset( $_POST['tribe-disable-markup'] ) ? 'yes' : '' );
}

function tribe_disable_markup()
{
	$setting = get_post_meta( get_the_ID(), '_tribe_disable_markup', true );
	$checked = isset( $setting ) && $setting == 'yes' ? ' checked="checked" ' : "";
	echo '<input ' . $checked . ' type="checkbox" id="disable-markup" name="tribe-disable-markup" value="' . '"><label for="disable-markup">Disable auto-formatting for this page</label>';
}

/**
 * Adds the "Custom Layout" option for posts and pages
 */
add_action( 'add_meta_boxes', 'tribe_add_custom_layout_option' );
add_action( 'save_post', 'tribe_save_custom_layout');

function tribe_add_custom_layout_option()
{
	// Show the box on pages and posts
	$post_types = array( 'post', 'page');
	foreach( $post_types as $type )
	{
		add_meta_box( 'custom-layout', 'Custom Layout', 'tribe_custom_layout_control', $type, 'side', 'low' );
	}
}

function tribe_save_custom_layout( $post_id )
{
	update_post_meta( $post_id, '_tribe_custom_layout', isset( $_POST['tribe-custom-layout'] ) ? $_POST['tribe-custom-layout'] : 'default' );
}

function tribe_custom_layout_control()
{
	$setting = get_post_meta( get_the_ID(), '_tribe_custom_layout', true );
	if ( empty( $setting ) )
	{
		$setting = 'default';
	}
	echo '<select id="default-layout" name="tribe-custom-layout">
	<option ';
	if ( $setting == 'default' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="default">Default</option>
	<option ';
	if ( $setting == 'right-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="right-sidebar">Right Sidebar</option>
	<option ';
	if ( $setting == 'left-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="left-sidebar">Left Sidebar</option>
	<option ';
	if ( $setting == 'no-sidebar' )
	{
		echo 'selected="selected" ';
	}
	echo 'value="no-sidebar">No Sidebar</option>';
	echo '</select>';
}

/* Story Template */
add_action( 'cmb2_init', 'cmb2_story' );
function cmb2_story() {
	$prefix = '_tribe_';

	$story_cats_cmb = new_cmb2_box( array(
			'id'            => 'story_category_metabox',
			'title'         => __( 'Story Category', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'story-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$categories = get_categories(array("hide_empty"=>0));
	$options = array();
	foreach($categories as $category){
		$options[$category->term_id] = 	$category->name;
	}
	$story_cats_cmb->add_field( array(
      'id'         => $prefix . 'story_category',
      'type'       => 'select',
			'options'		 => $options
  ));
}

/* Squeeze Template */
add_action( 'cmb2_init', 'cmb2_squeeze' );

function cmb2_squeeze() {
	$prefix = '_tribe_';

	$bg_color_cmb = new_cmb2_box( array(
			'id'            => 'squeeze_color_metabox',
			'title'         => __( 'Colors', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'squeeze-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$bg_color_cmb->add_field( array(
			'name' => 'Box Color',
			'default'  => '#7f7f7f',
      'id'         => $prefix . 'box_color',
      'type'       => 'colorpicker'
  ));

	$bg_photos_cmb = new_cmb2_box( array(
			'id'            => 'squeeze_photo_metabox',
			'title'         => __( 'Photos', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'squeeze-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$bg_photos_cmb->add_field( array(
			'name' => 'Profile Photo',
			'desc' => 'Upload a square image sized at 300px by 300px',
      'id'         => $prefix . 'profile_photo',
      'type'       => 'file',
			'allow' => array( 'url', 'attachment' )
  ));

	$quotes_cmb = new_cmb2_box( array(
			'id'            => 'quotes_metabox',
			'title'         => __( 'Quotes', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'squeeze-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$social_cmb = new_cmb2_box( array(
			'id'            => 'social_metabox',
			'title'         => __( 'Social', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'squeeze-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$respLists = tribe_mc_api("lists");
	$options = array(''=>'');
	if ($respLists){
		foreach ($respLists->lists as $list) {
			$options[$list->id] = 	$list->name;
		}
	}

	if($respLists){
		
	$newsletter_cmb = new_cmb2_box( array(
			'id'            => 'mailchimp_newsletter_list_metabox',
			'title'         => __( 'Mailchimp Newsletter List', 'cmb2' ),
			'object_types'  => array( 'page', ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'squeeze-template.php' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
	) );

	$newsletter_cmb->add_field( array(
      'id'         => $prefix . 'newsletter_list',
      'type'       => 'select',
			'options'		 => $options
  ));
		foreach ($respLists->lists as $list) {
			$respFields = tribe_mc_api("lists/" . $list->id . "/merge-fields");
			$options = array();
			foreach($respFields->merge_fields as $field){
				if ($field->tag=="FNAME" || $field->tag=="LNAME"){
					$options[$field->tag] = $field->name;
				}
			}
			$newsletter_cmb->add_field( array(
				'name'       => __( 'Fields', 'cmb2' ),
				'id'         => $prefix . 'newsletter_list_fields_' . $list->id,
				'type'       => 'multicheck',
				'options'		 => $options
			));
		}
	}


	$quote_group_id = $quotes_cmb->add_field( array(
    'id'          => $prefix . 'quotes_group',
    'type'        => 'group',
		'required'		=> false,
    'options'     => array(
        'group_title'   => __( 'Quote {#}', 'cmb' ),
        'add_button'    => __( 'Add Another Quote', 'cmb' ),
        'remove_button' => __( 'Remove Quote', 'cmb' )
	    ),
	) );

	$quotes_cmb->add_group_field( $quote_group_id, array(
	    'name' => 'Quote',
	    'id'   => 'quote',
	    'type' => 'textarea_small',
	) );

	$quotes_cmb->add_group_field( $quote_group_id, array(
	    'name' => 'Quote Author',
	    'id'   => 'quote_author',
	    'type' => 'text',
	) );

	$quotes_cmb->add_group_field( $quote_group_id, array(
	    'name' => 'Quote Author Title',
	    'id'   => 'quote_author_title',
	    'type' => 'text',
	) );

  $social_cmb->add_field( array(
      'name'       => __( 'Twitter URL', 'cmb2' ),
      'id'         => $prefix . 'twitter',
      'type'       => 'text',
  ));

	$social_cmb->add_field( array(
      'name'       => __( 'Facebook URL', 'cmb2' ),
      'id'         => $prefix . 'facebook',
      'type'       => 'text',
  ));

	$social_cmb->add_field( array(
      'name'       => __( 'Google+ URL', 'cmb2' ),
      'id'         => $prefix . 'google',
      'type'       => 'text',
  ));
}
