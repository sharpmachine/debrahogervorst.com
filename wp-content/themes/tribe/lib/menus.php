<?php

function tribe_register_menus()
{

	register_nav_menus( array(
		'tribe-above' => __( 'Secondary Menu', 'tribe' ),
		'tribe-below' => __( 'Primary Menu', 'tribes' )
		)
	);
}

add_action( 'init', 'tribe_register_menus' );
