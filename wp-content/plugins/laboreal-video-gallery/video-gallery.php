<?php
/*
Plugin Name: Laboreal Video Gallery
Description: This is a simple but powerful video gallery plugin. Just create your galleries and add videos by copying and pasting the URLs. For a simple usage in your post/page, just insert the shortcode in the content of the post/page.
Author: Robson Botelho
Version: 0.2
*/

global $wpdb, $lvg_name, $lvg_id, $laboreal_vg_version, $table_name;
$lvg_name = 'Laboreal Video Gallery';
$lvg_id = 'laboreal_vg';
$laboreal_vg_version = "0.1";
$table_name = $wpdb->prefix . 'lvg_meta';

// *** Carrega a "thickbox" nativa do WordPress
add_action('init','laboreal_thickbox');

function laboreal_thickbox(){
    if(!is_admin()){
    wp_enqueue_script('jquery');
    wp_enqueue_script('thickbox',null,array('jquery'));
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
    }
}

// *** Adiciona o item ao menu "WP-ADMIN -> Plugins"
require(ABSPATH . WPINC . '/pluggable.php');
global $display_name , $user_email; get_currentuserinfo();
if( current_user_can( 'manage_options' ) ) {
	add_action('admin_menu', 'laboreal_vg_menuitem');
}

function laboreal_vg_menuitem() {
	global $lvg_name, $lvg_id;
	add_plugins_page($lvg_name, $lvg_name, 'read', 'laboreal_vg', 'laboreal_vg_page');
}

// *** Faz a instalação do plugin e cria seu banco de dados
function laboreal_vg_install() {
   global $wpdb, $table_name, $lvg_id, $laboreal_vg_version;
      
   $sql = "
   	CREATE TABLE IF NOT EXISTS " . $table_name . " (
	`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
	`uniq` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
	`type` enum('gallery','video') COLLATE utf8_unicode_ci NOT NULL,
	`meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`meta_value` longtext COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
	KEY `uniq` (`uniq`)
	);";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
 
   add_option("laboreal_vg_version", $laboreal_vg_version);
}

register_activation_hook(__FILE__,'laboreal_vg_install');

// Verifica quantos vídeos e quantas galerias têm cadastrados e retorna esse valor
function laboreal_vg_total($type = 'videos', $id = NULL) {
	global $wpdb, $table_name, $lvg_id;
	
	switch ($type) {
		case ('videos') :
			$qry = $wpdb->query("SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'url'"); break;
		case ('gallery') :
			$qry = $wpdb->query("SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'parent' AND meta_value = '".$id."'"); break;
	}
	return $qry;
}

// *** Retorna uma lista de todas as galerias cadastradas
function laboreal_vg_list_galleries($type = 'selectbox') {
	global $wpdb, $table_name, $lvg_id;
	
	$qry = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'gallery' AND meta_key = 'name' ORDER BY meta_value ASC" );
	if ($qry) {
	  if ($type == 'checkbox') {
		  foreach ($qry as $gallery) {
			  echo "<li><label><input type='checkbox' name='gallery_del[]' value='".$gallery->id."' /> ".$gallery->meta_value.' ('.laboreal_vg_total('gallery', $gallery->uniq).")</label></li>";
		  }
	  } elseif ($type == 'selectbox') {
		  foreach ($qry as $gallery) {
			  echo "<option value='".$gallery->uniq."' /> ".$gallery->meta_value."</option>";
		  }
	  }
	}
}

// *** Exclui as galerias selecionadas no formulário
function laboreal_vg_del_galleries($ids) {
	global $wpdb, $table_name, $lvg_id;
	
	$galerias = $wpdb->get_results("SELECT * FROM $table_name WHERE id IN (".implode(",",$ids).")");
	foreach ($galerias as $galeria) {
		$videos = $wpdb->get_results("SELECT * FROM $table_name WHERE meta_key = 'parent' AND meta_value = '" . $galeria->uniq . "'");
		foreach ($videos as $video) {
			$list = $wpdb->get_results("SELECT * FROM $table_name WHERE uniq = '" . $video->uniq . "'");
			foreach ($list as $item) {
				$wpdb->query("DELETE FROM $table_name WHERE uniq = '" . $item->uniq . "'");
			}
		}
	}
	$wpdb->query("DELETE FROM $table_name WHERE id IN (".implode(",",$ids).")");
}

if (isset($_POST['gallery_del']) && !empty($_POST['gallery_del'])) { laboreal_vg_del_galleries($_POST["gallery_del"]); }

// *** Exclui todos os vídeos em uma galeria quando essa é excluída
function laboreal_vg_del_all_videos($ids) {
	global $wpdb, $table_name, $lvg_id;
	
	$galerias = $wpdb->get_results("SELECT * FROM $table_name WHERE id IN (".implode(",",$ids).")");
	foreach ($galerias as $galeria) {
		$videos = $wpdb->get_results("SELECT * FROM $table_name WHERE parent ='" . $galeria->uniq . "'");
		foreach ($videos as $video) {
			$list = $wpdb->get_results("SELECT * FROM $table_name WHERE uniq ='" . $video->uniq . "'");
			foreach ($list as $item) {
				$wpdb->query("DELETE FROM $table_name WHERE id = '" . $item->id . "'");
			}
		}
	}
}

// *** Exclui um vídeo quando o botão da "lixeira" é clicado
function laboreal_vg_del_video($video_uniq) {
	global $wpdb, $table_name, $lvg_id;
	
	$wpdb->query("DELETE FROM $table_name WHERE uniq = '" . $video_uniq . "'");
}

if (isset($_POST["del_form"]) && !empty($_POST["del_form"])) { laboreal_vg_del_video($_POST["del_form"]); }

// *** Pega a URL de cada vídeo e retorna um link com a miniatura do vídeo
function laboreal_vg_get_url($url, $description) {
	global $wpdb, $table_name, $lvg_id;
	
	// Pega o site onde o vídeo está
	preg_match('@^(?:http://)?([^/]+)@i', $url, $matches);
	$host = $matches[1];
	preg_match('/[^.]+\.[^.]+$/', $host, $matches);
	
	// Pega as variáveis da URL
	switch ($matches[0]) {
		case ('youtube.com') : parse_str(parse_url($url, PHP_URL_QUERY)); $id = $v; break; //ok
		case ('youtu.be') : $exp = explode('/',$url); $id = array_pop($exp); break; //ok
		case ('dailymotion.com') : $exp = explode('/',$url); $code = array_reverse($exp); ($code[0] == '') ? $id = $code[1] : $id = $code[0]; break; //ok
		case ('vimeo.com') : sscanf(parse_url($url, PHP_URL_PATH), '/%d', $id); break; //ok
		case ('metacafe.com') : $exp = explode('/',$url); $code = array_reverse($exp); if ($code[0] == '') { $id = $code[2]; $ttl = $code[1]; } else { $id = $code[1]; $ttl = $code[0]; } break; //ok
	}
	
	echo '<style type="text/css">';
	echo '.video_thumb { width: 120px; height: 90px; }';
	echo '</style>';
	
	switch ($matches[0]) {
		// youtube.com
		case ('youtube.com') :
			echo '<a href="http://www.youtube.com/embed/' . $id . '" id="vid_' . $id . '" class="video_link" title="' . $description . '">
			<img src="http://i4.ytimg.com/vi/' . $id . '/0.jpg" class="video_thumb" /></a>
			<p style="font-size:12px;">' . $description;
			break;
		// youtu.be
		case ('youtu.be') :
			echo '<a href="http://www.youtube.com/embed/' . $id . '" id="vid_' . $id . '" class="video_link" title="' . $description . '">
			<img src="http://i4.ytimg.com/vi/' . $id . '/0.jpg" class="video_thumb" />
			</a>';
			break;
		// dailymotion.com
		case ('dailymotion.com') :
			echo '<a href="http://www.dailymotion.com/embed/video/' . $id . '" id="vid_' . $id . '" class="video_link" title="' . $description . '">
			<img src="http://dailymotion.com/thumbnail/video/' . $id . '" class="video_thumb" />
			</a>';
			break;
		// vimeo.com
		case ('vimeo.com') :
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . $id . ".php"));
			echo '<a href="http://player.vimeo.com/video/' . $id . '" id="vid_' . $id . '" class="video_link" title="' . $description . '">
			<img src="' . $hash[0]['thumbnail_medium'] . '" class="video_thumb" />
			</a>';
			break;
		// metacafe.com
		case ('metacafe.com') :
			echo '<a href="http://www.metacafe.com/fplayer/' . $id . '/' . $ttl . '.swf" id="vid_' . $id . '" class="video_link" title="' . $description . '">
			<img src="http://www.metacafe.com/thumb/' . $id . '.jpg" class="video_thumb" />
			</a>';
			break;
	}
}

// *** Exibe a página de configuração do plugin
function laboreal_vg_page() {
	global $lvg_name, $lvg_id;
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
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
<script type="text/javascript">
$(document).ready(function () {
	$('#showhide_welcome').click(function() {
		$('#welcome_message').toggle();
	});
});
</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/style.css" media="screen" />

<h2>Laboreal Video Gallery</h2>

<div class="laboreal_wrap">
	<h3>Create a New Gallery</h3>
	<div id="create_new_gallery">
		<input type="text" name="gallery" placeholder="Gallery Name" />
		<button onclick="new_gallery();" class="button-primary">Create Gallery</button>
   </div>
   <div id="load_new_gallery" style="display:none;"> <!-- Loading DIV -->
   		<img src="../wp-content/plugins/laboreal-video-gallery/img/loading.gif" />
   </div>
	
	<script type="text/javascript">
	function confirm_del() {
		var ok = confirm("Are you sure? This will delete the videos too.");
		if (ok == false) {
			return false;
		}
	}
	</script>
	<h3>Galleries List</h3>
		<form method="post" onsubmit="return confirm_del();">
		<ul>
			<div id="list_galleries">
				<?php echo laboreal_vg_list_galleries('checkbox'); ?>
            <input type="submit" value="Delete Selected" class="button" />
			</div>
		</ul>
		</form>
	
	<h3>Add a New Video</h3>
   <div id="add_new_video">
		<b>Gallery</b><br />
		<select name='parent' id="galleries_select_list">
      <option value="">-</option>
		<?php echo laboreal_vg_list_galleries('selectbox'); ?>
      </select>
		<p><b>Video URL</b><br />
      <input type="text" name="url" /></p>
		<p><b>Title</b> <i>(optional)</i><br />
      <input type="text" name="description" maxlength="255" /></p>
		<p>
		<button onclick="new_video();" class="button-primary">Add Video</button>
		</p>
   </div>
   <div id="load_new_video" style="display:none;"> <!-- Loading DIV -->
   		<img src="../wp-content/plugins/laboreal-video-gallery/img/loading.gif" />
   </div>
	
	<?php
	// *** Executa a função criada anteriormente para gerar a listagem dos vídeos
	echo "<div id='show_all_videos'>";
		include_once('../wp-content/plugins/laboreal-video-gallery/load_videos.php');
	echo "</div>";
	?>
	<h3>Welcome to Laboreal Video Gallery! - <a href="#" id="showhide_welcome">Show/Hide</a></h3>
	<div id="welcome_message">
		<p>Thank you for using Laboreal Video Gallery plugin.</p>
		<p>Now you can easily create and manage video galleries in your WordPress blog / site.</p>
		<p>Supported video websites:</p>
		<p><a href="http://www.laboreal.net/" target="_blank"><img src="../wp-content/plugins/laboreal-video-gallery/img/supported_sites.png" border="0" /></a></p>
		<p>If you have any questions about the usage of this plugin, visit Laboreal's <a href="http://www.laboreal.net/" target="_blank">official website</a>.</p>
		<p>Again, thank you for using LVG and if you want to help in any way, please send us your opinion about what you think about the plugin or send us a report any bugs you find. You might even consider donating a small amount to support the plugin's website.</p>
		<p><a href="http://www.laboreal.net/" target="_blank">Visit Laboreal's Website</a></p>
	</div>
	
<?php
	}

// *** Exibe os vídeos em uma galeria
function laboreal_vg_gallery( $atts ) {
	global $wpdb, $table_name, $lvg_id;
	
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
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
<script type="text/javascript">
$(document).ready(function () {
	$('#showhide_welcome').click(function() {
		$('#welcome_message').toggle();
	});
});
</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/plugins/laboreal-video-gallery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<style type="text/css">
#laboreal_vg_list {
	display: inline-block;
}
#laboreal_vg_list ul {
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
	width: 100%;
}
#laboreal_vg_list ul li {
	float: left;
	margin: 0 10px 10px 0;
	padding: 5px;
}
</style>
<?php
echo "<div id=\"laboreal_vg_list\"><ul>";

if ( $id == '' ) {
	$qry = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'gallery' AND meta_key = 'name' ORDER BY meta_value DESC" );
	foreach ( $qry as $gallery ) {
		echo "<li>" . $gallery->meta_value . "</li>";
	}
} else {
	$qry = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'gallery' AND meta_key = 'name' AND uniq = '" . $id . "' ORDER BY meta_value DESC" );
	if ( $qry ) {
		foreach ( $qry as $gallery ) {
			$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'parent' AND meta_value = '" . $gallery->uniq . "'" );
			foreach ( $result as $video ) {
				$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'url' AND uniq = '" . $video->uniq . "'" );
				foreach ( $result as $url ) { }
				$result = $wpdb->get_results( "SELECT * FROM $table_name WHERE type = 'video' AND meta_key = 'description' AND uniq = '" . $video->uniq . "'" );
				foreach ( $result as $description ) { }
				parse_str(parse_url($url->meta_value, PHP_URL_QUERY));
	?>
			  <li>
				  <?php laboreal_vg_get_url($url->meta_value, $description->meta_value); ?>
			  </li>
			<?php
				}
			}
		}
			echo "</ul></div>";
		
		}
}

// *** Por fim, criamos o shortcode que chamará a galeria
add_shortcode('laboreal','laboreal_vg_gallery');
?>