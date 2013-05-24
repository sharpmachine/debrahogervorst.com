<?php
require_once('../../../wp-load.php');
global $wpdb, $lvg_name, $lvg_id, $laboreal_vg_version, $table_name;

// *** Adiciona uma nova galeria ao banco de dados
if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
	$uniq = md5(microtime());
	$wpdb->insert( 'wp_lvg_meta', array( 'uniq' => $uniq, 'type' => 'gallery', 'meta_key' => 'name', 'meta_value' => $_POST['gallery'] ) );
	echo $wpdb->insert_id . '@' . substr($uniq,0,6);
}

// *** Insere os registros dos vídeos no banco de dados
if (isset($_POST['url']) && !empty($_POST['url']) && isset($_POST['parent']) && !empty($_POST['parent']) && isset($_POST['description'])) {
	$uniq = md5(microtime());
	$wpdb->insert( $table_name, array( 'uniq' => $uniq, 'type' => 'video', 'meta_key' => 'url', 'meta_value' => $_POST['url'] ) );
	$wpdb->insert( $table_name, array( 'uniq' => $uniq, 'type' => 'video', 'meta_key' => 'parent', 'meta_value' => $_POST['parent'] ) );
	$wpdb->insert( $table_name, array( 'uniq' => $uniq, 'type' => 'video', 'meta_key' => 'description', 'meta_value' => $_POST['description'] ) );
}
?>