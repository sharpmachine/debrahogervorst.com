<?php

/** 
 * Icon set compliments of 
 * http://www.onextrapixel.com/2012/02/28/freebies-black-white-minimal-social-icons-pack/
 */
class TribeSocialWidget extends WP_Widget {

	function TribeSocialWidget() {
		// Instantiate the parent object
		$options = array( 'description' => 'Stick this in the Right Sidebar widget area to the right' );

		parent::__construct( 'tribe_social_widget', 'Tribe — Social Widget</span>', $options );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$content = $before_widget;
		$content .= '<div class="social-widget-wrap">';
		foreach ( $instance as $key => $value )
		{
			if ( ! empty( $value ) )
			{
				$content .=  '<a href="' . $value . '" class="alignleft ' . $key . '" target="_blank">';
				$content .=  '<img src="' . get_template_directory_uri() . '/images/icons/' . strtolower( $key ) . '.png" alt="' . ucwords( $key ) . '">';
				$content .=  '</a>';
			}
		}
		$content .=  '</div>';
		$content .= $after_widget;
		echo apply_filters('widget_tribe_social', $content);
	}

	function update( $new_instance, $old_instance ) 
	{
		foreach( $new_instance as $key=>$val )
		{
			$instance[ $key ] = esc_url( $val );
		}
		return $instance;
	}

	function form( $instance ) {
		$id = rand(0, time() );
		// Output admin widget options form
		echo '<p>Please use the <strong>full url</strong> for each site you wish to use.</p>';

		$defaults = array(
			'twitter' => '',
			'facebook' => '',
			'linkedin' => '',
			'RSS' => '',
			'Pinterest' => '',
			'google Plus' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults);
		foreach ( $defaults as $key => $value )
		{
			echo '<p><label for="' . $this->get_field_id( $key ) . '">' . ucwords($key) . ': </label> <input class="widefat" name="' . $this->get_field_name( $key ) . '" id="' . $this->get_field_id( $key ) . '" type="text" value="' . esc_attr( $instance[ $key ] ) . '" /></p>';
		}
	}
}

function tribe_social_register_widgets() {
	register_widget( 'TribeSocialWidget' );
}

add_action( 'widgets_init', 'tribe_social_register_widgets' );
