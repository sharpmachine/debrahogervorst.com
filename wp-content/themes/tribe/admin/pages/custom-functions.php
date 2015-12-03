<?php
	$tribe_settings = tribe_get_options();

	echo '<div class="wrap">';
	screen_icon( 'themes'); 
	echo '<h2>Custom Functions</h2>';
	if ( ! empty( $_GET['settings-updated'] ) ) echo '<div id="message" class="updated"><p><strong>' . __( 'Custom Functions updated.' ) . '</strong></p></div>'; ?>
 
        <form id="custom_php_form" method="post" action="options.php" style="margin-top: 15px;">
 
            <?php settings_fields( 'tribe-settings' ); ?>
 
            <div id="custom_php_container">
                <div name="tribe-settings[custom-functions]" id="custom_php" style="border: 1px solid #DFDFDF; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; width: 100%; height: 400px; position: relative;"></div>
            </div>
 
            <textarea id="custom_php_textarea" name="tribe-settings[custom-functions]" style="display: none;"><?php echo ! empty( $tribe_settings['custom-functions'] ) ? $tribe_settings['custom-functions'] : tribe_default_custom_functions() ?></textarea>
            <p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" /></p>
        </form>
