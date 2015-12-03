<?php

/**
 * This page handles updates to Tribe theme.
 */

add_filter( 'tuc_request_update_options-tribe', 'tribe_get_update_args' );
function tribe_get_update_args( $args )
{
	$args['user-agent'] = 'tribethemeinstall';
	return $args;
}

$tribe_update = new ThemeUpdateChecker(
    'tribe',
    tribe_api_url()
);


if ( isset( $_GET['check_for_tribe_update'] ) )
{
	$tribe_update->checkForUpdates();
}
