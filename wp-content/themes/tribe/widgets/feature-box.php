<?php

class FeatureBoxWidget extends WP_Widget {

	function FeatureBoxWidget() {
		// Instantiate the parent object
		$options = array( 'description' => 'Stick this in the Feature Box widget area to the right' );

		parent::__construct( false, 'Tribe — Feature Box', $options );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$content = $before_widget;
		static $i = 0;
		$i++;
		$content .= '<div class="widget_' . $i . '"><h2>' . $instance['title'] . '</h2>';
		$content .= '<img src="' . $instance[ 'img'] . '" class="alignright" alt="Feature Box">';
		$content .= '<p>' . $instance['copy'] . '</p>';
		if ($instance['mailchimp-list-id']!=""){
			$showFirst = isset($instance["f" . $instance['mailchimp-list-id'] . "-FNAME"]);
			$showLast = isset($instance["f" . $instance['mailchimp-list-id'] . "-LNAME"]);
			$content .= tribe_mc_signup($instance['mailchimp-list-id'],$showFirst,$showLast);
		} else {
			$content .= $instance[ 'form' ];
		}
		$content .= '</div>';
		$content .= $after_widget;
		echo apply_filters( 'widget_tribe_feature_box', $content );
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$removeFields = array();
		foreach( $new_instance as $key=>$val )
		{
			$instance[ $key ] = $val;
			if ($key=="mailchimp-list-id"){
				if (!isset($new_instance["f" . $val . "-FNAME"]) && isset($old_instance["f" . $val . "-FNAME"])){
					$removeFields[] = "f" . $val . "-FNAME";
				}
				if (!isset($new_instance["f" . $val . "-LNAME"]) && isset($old_instance["f" . $val . "-LNAME"])){
					$removeFields[] = "f" . $val . "-LNAME";
				}
			}
		}
		foreach($removeFields as $field){
			unset($instance[$field]);
		}
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$defaults = array(
			'title' => '',
			'copy' => '',
			'form' => '',
		//	'below_form' => '',
			'img' => get_template_directory_uri() . '/images/feature.png'
		);
		$instance = wp_parse_args( (array) $instance, $defaults);
		$mcLists = tribe_mc_api("lists");
		?>
		<p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
		<p>Copy: <textarea rows="8" cols="20" class="widefat" name="<?php echo $this->get_field_name( 'copy' ); ?>"><?php echo esc_attr( $instance['copy'] ); ?></textarea></p>
		<?php if ($mcLists) { ?>
			<div>
				<label for="mailchimp-list">Mailchimp List:</label>
				<select class="widefat mailchimp-select" name="<?php echo $this->get_field_name( 'mailchimp-list-id' ); ?>">
					<option value=""></option>
					<?php foreach ($mcLists->lists as $list) { ?>
					<option value="<?php echo $list->id; ?>" <?php if (esc_attr( $instance['mailchimp-list-id'] )==$list->id){ ?>selected="selected"<?php } ?>><?php echo $list->name; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php foreach ($mcLists->lists as $list) {
			?>
			<div class="mc-list-fields-options mc-list-fields-options-<?php echo $list->id?>">
			<p>
				<label>Include Fields: </label>
			</p>
			<?php
				$respFields = tribe_mc_api("lists/" . $list->id . "/merge-fields");
				foreach($respFields->merge_fields as $field){
					if ($field->tag=="FNAME" || $field->tag=="LNAME"){
						$inputName = "f" . $list->id . "-" . $field->tag;
						?>
					<div><input name="<?php echo $this->get_field_name( $inputName) ?>" type="checkbox"/ <?php if (esc_attr( $instance[$inputName] )){ ?>checked="checked"<?php } ?>><?php echo $field->name; ?></div>
					<?php } } ?>
			</div>
			<?php }
		} else { ?>
			<p>HTML form: <textarea rows="8" cols="20" class="widefat" name="<?php echo $this->get_field_name( 'form' ); ?>"><?php echo esc_attr( $instance['form'] ); ?></textarea></p>
		<?php } ?>
		<div class="clearboth"><p><img class="alignleft" width="100" src="<?php echo esc_attr( $instance['img'] ); ?>"> <a href="#" id="set-post-thumbnail" class="button upload-feature-image" data-editor="content"><span class="wp-media-buttons-icon"></span>Change Image</a><input type="hidden" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo esc_attr( $instance['img'] ); ?>" class="img"></p></div>
		<?php
	}
}

function featureboxwidget_register_widgets() {
	register_widget( 'FeatureBoxWidget' );
}

add_action( 'widgets_init', 'featureboxwidget_register_widgets' );
