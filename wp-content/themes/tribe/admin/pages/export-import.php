<?php

/**  
 * The tribe-version-control option is a bit complicated because it
 * is a three-dimensional array. The data cell is json encoded, then
 * the entire thing is also encoded. Here is what that looks like:

 	array(
		[time()] => array(
			'name' => 'Custom name',
			'data' => json_encode( $data ),
		),
	)

 */

$status = "";

if ( isset( $_POST['tribe_imports'] ) && ! empty( $_FILES['tribe_import']['name'] ) )
{
	$file = $_FILES['tribe_import'];
	$data = file_get_contents( $file['tmp_name'] );
	tribe_update_settings( $data, true );
	$status = "Settings successfully imported.";
}


if ( isset( $_POST['tribe-version-name'] ) && ! empty( $_POST['tribe-version-name'] ) )
{
	$versions = get_option( 'tribe-version-control' );
	$versions = json_decode( $versions, true );
	$time = time(); // don't want a nuance, we're using this twice
	$versions[ $time ] = array(
		'name' => stripslashes( trim( $_POST['tribe-version-name'] ) ),
		'date' => $time,
		'data' => json_encode( get_option('tribe-settings' ) ),
	);
	$versions = json_encode( $versions );
	update_option( 'tribe-version-control', $versions );
	$status = "Settings successfully saved.";
}

else if ( isset( $_GET['delete-tribe-revision'] ) && isset( $_GET['id'] ) && ! empty( $_GET['id'] ) )
{
	$versions = get_option( 'tribe-version-control' );
	$versions = json_decode( $versions, true );
	unset( $versions[ $_GET['id'] ] );
	$versions = json_encode( $versions );
	update_option( 'tribe-version-control', $versions );
	$status = "Settings successfully deleted.";
}

else if ( isset( $_GET['restore-tribe-revision'] ) && isset( $_GET['id'] ) && ! empty( $_GET['id'] ) )
{
	$versions = get_option( 'tribe-version-control' );
	$versions = json_decode( $versions, true );
	$restore = $versions[ $_GET['id'] ];
	tribe_update_settings( json_decode($restore['data']), false );
	$status = "Settings successfully restored.";
}


echo '<div class="wrap export-import">';

	screen_icon( 'options-general'); 
	echo '
	<h2>Export & Import Your Tribe Settings</h2>';
if ( ! empty( $status ) )
{
	echo '<div id="setting-error-settings_updated" class="updated settings-error below-h2"> 
<p><strong>' . $status . '</strong></p></div>';
}
	echo '<p>Click the Export button to download your Tribe settings to your desktop.</p>
	
	<p><form action="" method="post">
	<input type="submit" name="tribe_export" value="Export" class="button-primary">
	</form></p>

	<p>If you import, you will override all your  Tribe settings. This includes Theme Settings, custom CSS and PHP. We strongly recommend you export or save your current settings first so you don\'t lose anything.</p>

	<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="tribe_import">
	<input type="submit" name="tribe_imports" value="Import" class="button-primary">
	</form><br/>';


	echo '
	<h2>Save Your Tribe Settings</h2> 
	<p>On the fence between two different settings? Save your current one so you can easily restore it in the future.</p>
	<p><form action="" method="post">
	<input type="text" name="tribe-version-name" placeholder="Name your current setting">
	<input type="submit" value="Save settings" class="button">
	';

	$designs = get_option( 'tribe-version-control' );
	$designs = json_decode( $designs, true );
	if ( ! empty( $designs ) )
	{
		echo '<h3>Saved Tribe Settings</h3><table>';
	
		krsort( $designs ) . " ";
		foreach ( $designs as $design )
		{

			echo '<tr><td>' . $design['name'] . '</td><td class="date">'
			. date_i18n('F j, Y', $design['date'] )
			. '</td><td> <a href="?page=tribe-export-import&restore-tribe-revision&id=' . $design['date'] . '"">Restore</a></td><td> <a class="delete" href="?page=tribe-export-import&delete-tribe-revision&id=' . $design['date'] . '">Delete</a></td></tr>';
		}
		echo '</table>';
	}
	echo '</div><!-- end .wrap -->';



