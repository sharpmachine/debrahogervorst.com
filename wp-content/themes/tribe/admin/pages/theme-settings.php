<?php

/**
 * This file is responsible for outputting the HTML that
 * is visible on the primary Tribe Settings page
 *
 *
 * First off, make the submit button the same color as the
 * specified link color
 */
echo '<style>
#tribe_settings_form input[type="submit"]:hover {
	background: ' . nc_tribe_get_option( 'button-color' ) . ';
	border: 1px solid ' . nc_tribe_get_option( 'button-color' ) . ';
}

#tribe_settings_form input[type="submit"] {
	color:  ' . nc_tribe_get_option( 'button-color' ) . ';
}

</style>';


echo '<div class="wrap">';
	screen_icon( 'options-general');
	echo '<h2>Tribe Settings</h2>';
	/**
	 * This next line of code inspiration and complements of
	 * http://core.trac.wordpress.org/ticket/11474
	 */
	settings_errors();
	if ( ! is_tribe_update() && tribe_license() )
	{
		echo '<div class="check-for-update"><p>';
		if ( isset( $_GET['check_for_tribe_update'] ) )
		{
			echo 'No update available yet! <a href="' . $_SERVER['REQUEST_URI'] . '&check_for_tribe_update">Check again</a>?';
		}
		else
		{
			echo 'You\'re rocking Tribe ' . TRIBE_VERSION . '. <a href="' . $_SERVER['REQUEST_URI'] . '&check_for_tribe_update">Check for update</a>.';
		}
		echo '</p></div>';
	}
	echo '
	<form action="options.php" method="POST" id="tribe_settings_form">';
	if ( tribe_license() )
	{
		echo '<p class="submit-buttons top">
		<input type="hidden" value="no" name="tribe-settings[reset]">
		<input type="submit" name="submit" value="Save Settings" class="button-primary">
		<input type="submit" name="reset" class="button" value="Restore Defaults" id="tribe_restore_defaults">
		</p>';
	}
		settings_fields('tribe-settings');
		do_settings_sections('tribe-settings');
		echo '<p class="submit-buttons bottom">';
		echo '<input type="hidden" value="no" name="tribe-settings[reset]"><input type="submit" name="submit" value="Save Settings" class="button-primary">
		<input type="submit" name="reset" class="button" value="Restore Defaults" id="tribe_restore_defaults">';
		echo '
		</p>
		</form></div>';
