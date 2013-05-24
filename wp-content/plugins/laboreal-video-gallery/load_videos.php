<script type="text/javascript">
$(document).ready(function() {
	$(".video_link").fancybox({
		'width'				: 500,
		'height'			: 350,
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe',
		'enableEscapeButton': false,
		'centerOnScroll'	: true,
		'hideOnOverlayClick': false
	});
});
</script>
<?php
if (file_exists('../wp-load.php')) { require_once('../wp-load.php'); } else { require_once('../../../wp-load.php'); }
global $wpdb, $table_name, $lvg_id;

// *** Exibe a listagem de vídeos geral
echo "<h3>Your Videos"; if (function_exists('laboreal_vg_total')) echo ' (Total: ' . laboreal_vg_total('videos') . ')'; echo "</h3>";
echo "<div id=\"laboreal_vg_list\"><ul>";
$qry = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'gallery' AND meta_key = 'name' ORDER BY meta_value DESC" );
if ( $qry ) {
	foreach ( $qry as $gallery ) {
		echo "<div class='laboreal_category_list'>";
		echo "<h1>" . $gallery->meta_value . "</h1>";
	  	$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'parent' AND meta_value = '" . $gallery->uniq . "'" );
	  	foreach ( $result as $video ) {
			$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'url' AND uniq = '" . $video->uniq . "'" );
	  		foreach ( $result as $url ) { }
			$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'description' AND uniq = '" . $video->uniq . "'" );
  			foreach ( $result as $description ) { }
	?>
	  <li>
		  <form method="post">
			  <?php laboreal_vg_get_url($url->meta_value, $description->meta_value); ?>
			  <input type="hidden" name="del_form" value="<?php echo $video->uniq; ?>" />
			  <div style="height: 22px; line-height: 22px;">
				  <input type="image" src="../wp-content/plugins/laboreal-video-gallery/img/trash.png" value="Excluir" class="excluir" style="float: left;" />
				  <div class="clear"></div>
			  </div>
		  </form>
	  </li>
	<?php
		}
		echo "<div class='clear'></div>";
		echo "<span class='shortcode'><i>Gallery shortcode:</i> [laboreal id=\"" . $gallery->uniq . "\"]</span>";
		echo "</div>";
	}
} else {
	echo "<i>No videos were added yet.</i>";
}
	echo "</div></ul>";
?>