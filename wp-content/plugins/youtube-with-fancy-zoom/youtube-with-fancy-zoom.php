<?php
/*
Plugin Name: Youtube with fancy zoom
Plugin URI: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
Description: Youtube with fancy zoom plugin is a media viewing application that supports webs most popular youtube video. This is a jQuery based fancy zoom.  
Author: Gopi Ramasamy
Version: 10.7
Author URI: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
Donate link: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
Text Domain: youtube-with-fancy-zoom
Domain Path: /languages
*/

global $wpdb, $wp_version;
define("WP_G_YWFZ_TABLE", $wpdb->prefix . "g_ywfz");
define('WP_G_YWFZ_FAV', 'http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/');

if ( ! defined( 'WP_G_YWFZ_BASENAME' ) )
	define( 'WP_G_YWFZ_BASENAME', plugin_basename( __FILE__ ) );
	
if ( ! defined( 'WP_G_YWFZ_PLUGIN_NAME' ) )
	define( 'WP_G_YWFZ_PLUGIN_NAME', trim( dirname( WP_G_YWFZ_BASENAME ), '/' ) );
	
if ( ! defined( 'WP_G_YWFZ_PLUGIN_URL' ) )
	define( 'WP_G_YWFZ_PLUGIN_URL', WP_PLUGIN_URL . '/' . WP_G_YWFZ_PLUGIN_NAME );
	
if ( ! defined( 'WP_G_YWFZ_ADMIN_URL' ) )
	define( 'WP_G_YWFZ_ADMIN_URL', get_option('siteurl') . '/wp-admin/options-general.php?page=youtube-with-fancy-zoom' );
	
function g_ywfz_show($arr) 
{
	$ArrInput 			= array();
	$ArrInput["videoid"] 	= $arr["g_ywfz_id"];
	echo g_ywfz_shortcode( $ArrInput );
}

function ywfz_show( $videoid = 0 )
{
	global $wpdb;
	$ArrInput = array();
	$ArrInput["videoid"] = $videoid;
	echo g_ywfz_shortcode( $ArrInput );
}

function g_ywfz_install() 
{
	global $wpdb;
	if($wpdb->get_var("show tables like '". WP_G_YWFZ_TABLE . "'") != WP_G_YWFZ_TABLE) 
	{
		$wpdb->query("
			CREATE TABLE `". WP_G_YWFZ_TABLE . "` (
				`ywfz_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`ywfz_title` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_watch` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_code` VARCHAR( 100 ) NOT NULL ,
				`ywfz_img` VARCHAR( 200 ) NOT NULL ,
				`ywfz_size` VARCHAR( 10 ) NOT NULL ,
				`ywfz_imglink` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_status` VARCHAR( 10 ) NOT NULL ,
				`ywfz_sidebar` VARCHAR( 10 ) NOT NULL ,
				`ywfz_expire` DATE NOT NULL
				)  ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			");
		$sSql = "insert into `". WP_G_YWFZ_TABLE . "` set `ywfz_title`='Continuous rss scrolling drupal module', ";
		$sSql = $sSql . "`ywfz_watch`='http://www.youtube.com/watch?v=5TSPlykcdYk', ";
		$sSql = $sSql . "`ywfz_code`='5TSPlykcdYk', ";
		$sSql = $sSql . "`ywfz_img`='Youtube Thumbnail', ";
		$sSql = $sSql . "`ywfz_size`='0', `ywfz_imglink`='', ";
		$sSql = $sSql . "`ywfz_status`='Yes', `ywfz_sidebar`='Yes';";
		$wpdb->query($sSql);
		$sSql = "insert into `". WP_G_YWFZ_TABLE . "` set";
		$sSql = $sSql . " `ywfz_title`='Email newsletter wordpress plugin',";
		$sSql = $sSql . "`ywfz_watch`='http://www.youtube.com/watch?v=m0kWQOI8HOg',";
		$sSql = $sSql . "`ywfz_code`='m0kWQOI8HOg',";
		$sSql = $sSql . "`ywfz_img`='Youtube Thumbnail', ";
		$sSql = $sSql . "`ywfz_size`='0', `ywfz_imglink`='', ";
		$sSql = $sSql . "`ywfz_status`='Yes', `ywfz_sidebar`='Yes';";
		$wpdb->query($sSql);
	}
}

function g_ywfz_admin_option() 
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	switch($current_page)
	{
		case 'edit':
			include('pages/content-edit.php');
			break;
		case 'add':
			include('pages/content-add.php');
			break;
		case 'set':
			include('pages/content-setting.php');
			break;
		default:
			include('pages/content-show.php');
			break;
	}
}

class g_ywfz_widget_register extends WP_Widget 
{
	function __construct() 
	{
		$widget_ops = array('classname' => 'widget_text youtube-fancy-zoom-widget', 'description' => __('Youtube fancy zoom', 'youtube-with-fancy-zoom'), 'youtube-fancy-zoom');
		parent::__construct('youtube-fancy-zoom', __('Youtube fancy zoom', 'youtube-with-fancy-zoom'), $widget_ops);
	}
	
	function widget( $args, $instance ) 
	{
		extract( $args, EXTR_SKIP );

		$title 				= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$g_ywfz_id			= $instance['g_ywfz_id'];

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}
		// Call widget method
		$arr = array();
		$arr["g_ywfz_id"] 	  = $g_ywfz_id;
		g_ywfz_show($arr);
		
		// Call widget method
		echo $args['after_widget'];
	}
	
	function update( $new_instance, $old_instance ) 
	{
		$instance 					= $old_instance;
		$instance['title'] 			= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['g_ywfz_id'] 		= ( ! empty( $new_instance['g_ywfz_id'] ) ) ? strip_tags( $new_instance['g_ywfz_id'] ) : '';
		return $instance;
	}
	
	function form( $instance ) 
	{
		$defaults = array(
			'title' 			=> '',
			'g_ywfz_id' 		=> ''
        );
		
		$instance 		= wp_parse_args( (array) $instance, $defaults);
        $title 			= $instance['title'];
		$g_ywfz_id 		= $instance['g_ywfz_id'];
	
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'youtube-with-fancy-zoom'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
            <label for="<?php echo $this->get_field_id('g_ywfz_id'); ?>"><?php _e('Video ID (Enter 0 to display random one)', 'youtube-with-fancy-zoom'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('g_ywfz_id'); ?>" name="<?php echo $this->get_field_name('g_ywfz_id'); ?>" type="text" value="<?php echo $g_ywfz_id; ?>" />
        </p>
		<?php
	}
	
	function g_ywfz_render_selected($var) 
	{
		if ($var==1 || $var==true) 
		{
			echo 'selected="selected"';
		}
	}
}

function g_ywfz_widget_loading()
{
	register_widget( 'g_ywfz_widget_register' );
}

function g_ywfz_add_to_menu() 
{
	if (is_admin()) 
	{
		add_options_page( __('Youtube fancy zoom', 'youtube-with-fancy-zoom'), 
				__('Youtube fancy zoom', 'youtube-with-fancy-zoom'), 'manage_options', 'youtube-with-fancy-zoom', 'g_ywfz_admin_option' );
	}
}

function g_ywfz_shortcode( $atts ) 
{
	global $wpdb;
	global $ScriptInserted;
	global $JsScriptInserted;
	$videoid = 0;
	$g_ywfz_pp = "";
	
	//[youtube-fancy-zoom videoid="1"]	 // Thuis is plugin short code.
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	$videoid = $atts['videoid'];
	if(!is_numeric($videoid)){ $videoid = 0; } 
	
	$sSql = "select * from ". WP_G_YWFZ_TABLE . " where 1=1";
	if($videoid > 0)
	{
		 $sSql = $sSql. " and ywfz_id=".$videoid;
	}
	else
	{
		$sSql = $sSql. " and ywfz_status='YES'";
	}
	$sSql = $sSql. " ORDER BY rand() limit 0,1";
	
	$data = $wpdb->get_results($sSql);
	
	if ( ! empty($data) ) 
	{
		if (!isset($ScriptInserted) || $ScriptInserted !== true)
		{
			$ScriptInserted = true;
			$g_ywfz_pp = $g_ywfz_pp . '<script type="text/javascript" src="'.WP_G_YWFZ_PLUGIN_URL.'/includes/jquery.min.js"></script>';
			$g_ywfz_pp = $g_ywfz_pp . '<link rel="stylesheet" href="'.WP_G_YWFZ_PLUGIN_URL.'/includes/youtube-with-fancy-zoom.css" type="text/css" media="screen" charset="utf-8" />';
			$g_ywfz_pp = $g_ywfz_pp . '<script src="'.WP_G_YWFZ_PLUGIN_URL.'/includes/youtube-with-fancy-zoom.js" type="text/javascript" charset="utf-8"></script>';
		}
		foreach ( $data as $data ) 
		{ 
			if($data->ywfz_img == 'Youtube Thumbnail')
			{
				$imgsource = '<img src="http://img.youtube.com/vi/'.$data->ywfz_code.'/'.$data->ywfz_size.'.jpg" alt="'.$data->ywfz_title.'" />';
			}
			else
			{
				$imgsource = '<img src="'.$data->ywfz_imglink.'" alt="'.$data->ywfz_title.'" />';
			}	

			$g_ywfz_pp = $g_ywfz_pp . '<div class="gallery ywfz">'; 
				$g_ywfz_pp = $g_ywfz_pp . '<a href="'.$data->ywfz_watch.'" rel="g_ywfz[post]" title="'.$data->ywfz_title.'">';
				$g_ywfz_pp = $g_ywfz_pp . $imgsource;
				$g_ywfz_pp = $g_ywfz_pp . '</a>';
			$g_ywfz_pp = $g_ywfz_pp . '</div>';

		}
		if (!isset($JsScriptInserted) || $JsScriptInserted !== true)
		{
			$JsScriptInserted = true;
			$g_ywfz = "'g_ywfz'";
			$g_ywfz_theme = "'g_ywfz_theme'";
			$g_ywfz_pp = $g_ywfz_pp . '<script type="text/javascript" charset="utf-8">';
			$g_ywfz_pp = $g_ywfz_pp . '$(document).ready(function(){$(".gallery a[rel^='.$g_ywfz.']").g_ywfz({theme:'.$g_ywfz_theme.'});});';
			$g_ywfz_pp = $g_ywfz_pp . '</script>';
		}
	}
	else
	{
		$g_ywfz_pp = __('No data found.', 'youtube-with-fancy-zoom');
	}
	return $g_ywfz_pp;
}

function g_ywfz_textdomain() 
{
	  load_plugin_textdomain( 'youtube-with-fancy-zoom', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_shortcode( 'youtube-fancy-zoom', 'g_ywfz_shortcode' );
add_action('plugins_loaded', 'g_ywfz_textdomain');
add_action('admin_menu', 'g_ywfz_add_to_menu');
register_activation_hook(__FILE__, 'g_ywfz_install');
register_deactivation_hook(__FILE__, 'g_ywfz_deactivation');
add_action( 'widgets_init', 'g_ywfz_widget_loading');
?>