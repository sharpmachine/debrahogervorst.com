<?php

$css = nc_tribe_get_option( 'custom-css' );

	echo '<div class="wrap">';
	screen_icon( 'themes'); 
	echo '<h2>Custom CSS</h2>';

	if ( ! empty( $_GET['settings-updated'] ) ) echo '<div id="message" class="updated"><p><strong>' . __( 'Custom CSS updated.' ) . '</strong></p></div>'; ?>
 
        <form id="custom_css_form" method="post" action="options.php" style="margin-top: 15px;">
 
            <?php settings_fields( 'tribe-settings' ); ?>
 
            <div id="custom_css_container">
                <div name="tribe-settings[custom-css]" id="custom_css" style="border: 1px solid #DFDFDF; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; width: 100%; height: 400px; position: relative;"></div>
            </div>
 
            <textarea id="custom_css_textarea" name="tribe-settings[custom-css]" style="display: none;"><?php echo ! empty( $css ) ? $css : '/*
Welcome to the Custom CSS editor!
 
Please add all your custom CSS here and avoid modifying the core theme files, since that\'ll make upgrading the theme problematic. Your custom CSS will be loaded after the theme\'s stylesheets, which means that your rules will take precedence. Just add your CSS here for what you want to change, you don\'t need to copy all the theme\'s style.css content.
*/'; ?></textarea>
            <p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" /></p>
        </form>

