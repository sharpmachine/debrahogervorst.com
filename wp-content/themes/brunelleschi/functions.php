<?php
/*----------------------------------------
# 
# Theme Name: Brunelleschi
# Theme Author: Kit MacAllister
# 
----------------------------------------*/

/*----------------------------------------
# 
# BRUNELLESCHI SETUP
# 
----------------------------------------*/

/* Run Brunelleschi Theme Setup */
add_action( 'after_setup_theme','brunelleschi_custom_header_setup');
add_action( 'after_setup_theme', 'brunelleschi_setup' );

/* brunelleschi setup */
if ( ! function_exists( 'brunelleschi_setup' ) ):
	function brunelleschi_setup() {
		
		/* Load Theme TextDomain */
		load_theme_textdomain( 'brunelleschi', get_template_directory() . '/languages' );

		/* Add Automatic Feed Links */
		add_theme_support( 'automatic-feed-links' );
		
		/* Add Custom Background */
		add_theme_support( 'custom-background' );
		
		/* Add Theme Support for Aside and Gallery */
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
		
		/* Add Editor Style */
		add_editor_style();
		
		/* Register Navigation */
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'brunelleschi' ),
		) );
		
		/* Default Header Stuff */
		if ( ! defined( 'HEADER_TEXTCOLOR' ) ) { define( 'HEADER_TEXTCOLOR', '' ); }
		if ( ! defined( 'NO_HEADER_TEXT' ) ) { define( 'NO_HEADER_TEXT', true ); }
		
	}
endif;

/*----------------------------------------
# 
# REGISTER ASSETS
# 
----------------------------------------*/

if( ! function_exists( 'brunelleschi_register_assets') ):
	function brunelleschi_register_assets(){
		/*----------------------------------------
		# 
		# REGISTER SCRIPTS
		# 
		----------------------------------------*/
		
		/* Modernizr */
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.5.2.min.js' );
		if(!is_admin()) wp_enqueue_script('modernizr');
		
		/* Contains Media Queries Used by 1140px Grid */
		wp_register_script('respond', get_template_directory_uri() . '/js/respond.js', array());
		if( !is_admin() ){ wp_enqueue_script('respond'); }
		
		/* Register jQuery */
		if(!is_admin()) wp_enqueue_script('jquery');
		
		/* Additional Scripts */
		wp_register_script('brunelleschi-scripts', get_template_directory_uri() . '/js/brunelleschi-scripts.js', array());
		if( !is_admin() ){ wp_enqueue_script('brunelleschi-scripts'); }
		
		if(brunelleschi_options('use-featured-content') == '1'){
			/* Register Slider Scripts */
			wp_register_script('slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' );
			if(!is_admin()) wp_enqueue_script('slider');
		
			/* Register Slider Styles */
			wp_register_style('brunelleschi_flexslider', get_template_directory_uri() . '/inc/flexslider.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_flexslider');
			
			wp_register_style('brunelleschi_featured_content', get_template_directory_uri() . '/inc/featured-content.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_featured_content');
		}
		
		/* Register Style.css */
		wp_register_style('style.css', get_stylesheet_uri());
		if(!is_admin()) wp_enqueue_style('style.css');
	}
endif;
add_action('init','brunelleschi_register_assets');


/*----------------------------------------
# 
# SETUP FUNCTIONS
# 
----------------------------------------*/

/* Title Function */
if ( ! function_exists( 'brunelleschi_title' ) ):
	function brunelleschi_title(){
		global $page, $paged;
		wp_title( '&raquo;', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " &raquo; $site_description";
	
		if ( $paged >= 2 || $page >= 2 )
			echo ' &raquo; ' . sprintf( __( 'Page %s', 'brunelleschi' ), max( $paged, $page ) );
	}
endif;

/* Posted In Function */
if ( ! function_exists( 'brunelleschi_posted_in' ) ):
	function brunelleschi_posted_in() {
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'brunelleschi' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'brunelleschi' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'brunelleschi' );
		}
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
endif;

/* Posted On Function */
if ( ! function_exists( 'brunelleschi_posted_on' ) ):
	function brunelleschi_posted_on() {
		printf( __('<span class="meta-sep">by</span> %3$s <span class="%1$s">Posted on</span> %2$s', 'brunelleschi' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'brunelleschi' ), get_the_author() ),
				get_the_author()
			)
		);
		edit_post_link( __( 'Edit', 'brunelleschi' ), ' <small><span class="edit-link">[', ']</span></small>' );
	}
endif;


/* Theme Comments */
if ( ! function_exists( 'brunelleschi_comment' ) ):
	function brunelleschi_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'brunelleschi' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'brunelleschi' ); ?></em>
				<br />
			<?php endif; ?>
	
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					printf( __( '%1$s at %2$s', 'brunelleschi' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'brunelleschi' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
	
			<div class="comment-body"><?php comment_text(); ?></div>
	
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->
	
		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'brunelleschi' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'brunelleschi' ), ' ' ); ?></p>
		<?php
				break;
		endswitch;
	}
endif;

/* Remove Recent Comments Style */
if ( ! function_exists( 'brunelleschi_remove_recent_comments_style' ) ):
	function brunelleschi_remove_recent_comments_style() {
		add_filter( 'show_recent_comments_widget_style', '__return_false' );
	}
endif;

add_action( 'widgets_init', 'brunelleschi_remove_recent_comments_style' );

/* Remove Gallery CSS */
add_filter( 'use_default_gallery_style', '__return_false' );

if ( ! function_exists( 'brunelleschi_remove_gallery_css' ) ):
	function brunelleschi_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}
endif;

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) ) { add_filter( 'gallery_style', 'brunelleschi_remove_gallery_css' ); }

/* Custom Excerpt More */
if ( ! function_exists( 'brunelleschi_custom_excerpt_more' ) ):
	function brunelleschi_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= brunelleschi_continue_reading_link();
		}
		return $output;
	}
endif;
add_filter( 'get_the_excerpt', 'brunelleschi_custom_excerpt_more' );

/* Show the Home Page */
if ( ! function_exists( 'brunelleschi_page_menu_args' ) ):
	function brunelleschi_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
endif;
add_filter( 'wp_page_menu_args', 'brunelleschi_page_menu_args' );

/* Excerpt Length */
if ( ! function_exists( 'brunelleschi_excerpt_length' ) ):
	function brunelleschi_excerpt_length( $length ) {
		return 40;
	}
endif;
add_filter( 'excerpt_length', 'brunelleschi_excerpt_length' );

/* Continue Reading Link */
if ( ! function_exists( 'brunelleschi_continue_reading_link' ) ):
	function brunelleschi_continue_reading_link() {
		return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'brunelleschi' ) . '</a>';
	}
endif;

/* Auto Excerpt More */
if ( ! function_exists( 'brunelleschi_auto_excerpt_more' ) ):
	function brunelleschi_auto_excerpt_more( $more ) {
		return ' &hellip;' . brunelleschi_continue_reading_link();
	}
endif;
add_filter( 'excerpt_more', 'brunelleschi_auto_excerpt_more' );

/* Admin Header Style */
if ( ! function_exists( 'brunelleschi_admin_header_style' ) ):
	function brunelleschi_admin_header_style() { ?>
		<style type="text/css">
		#headerimg {
			display: block;
			margin: 0 auto;
			margin-bottom: 17px;
			border-top: 1px solid #aaa;
			border-bottom: 1px solid #aaa;
		}
		</style>
	<?php }
endif;

/*----------------------------------------
# 
# Theme Options
# 
----------------------------------------*/

/* Load Theme options Page from inc */
require( dirname( __FILE__ ) . '/inc/theme-options.php' );

/*----------------------------------------
# 
# OPTIONS DEPENDANT FUNCTIONS
# 
----------------------------------------*/
if ( ! function_exists( 'brunelleschi_options' ) ):
	function brunelleschi_options( $string ){
		$option = get_option('brunelleschi_options');
		if(isset($option[$string]) && $option[$string] !== ''){
			return $option[$string];
		} else {
			return false;
		}
	}
endif;

/*----------------------------------------
# 
# CUSTOM IMAGE HEADER
# 
----------------------------------------*/

/* REQUIRED! -- define content width */
if ( ! brunelleschi_options('content-width') ) { $content_width = 960; }
else { $content_width = brunelleschi_options('content-width'); }

define( 'HEADER_IMAGE_WIDTH', apply_filters( 'brunelleschi_header_image_width', $content_width ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'brunelleschi_header_image_height', 198 ) );

/* Add Post Thumbnails */
add_theme_support( 'post-thumbnails' );
	
set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

if ( ! function_exists( 'brunelleschi_admin_header_style' ) ) :

	/* Backend Header Style */
	function brunelleschi_admin_header_style() { ?>
		<style type="text/css">
		#headerimg {
			display: block;
			margin: 0 auto;
			margin-bottom: 17px;
			border-top: 1px solid #aaa;
			border-bottom: 1px solid #aaa;
		}
		</style>
	<?php }
endif;

function brunelleschi_admin_header_style() { ?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg {
		<?php if ( display_header_text() ) :?>height: 275px !important; <?php endif; ?>
		background: bottom center no-repeat;
		text-align: center;
	}
	#headimg h1,
	#headimg #desc {
		font-family: garamond;
		line-height: 1.6;
		margin: 0;
		padding: 0;
		margin-top: -100px;
	}
	#headimg h1 {
		display: block;
		margin: 0 auto;
		font-size: 30px;
		line-height: 36px;
		margin: 0 0 18px 0;
	}
	#headimg h1 a {
		color: #000;
		font-weight: normal;
		text-decoration: none;
		text-transform: uppercase;
		letter-spacing: .1em;
	}
	#headimg h1 a:hover {
		color: #21759b;
	}
	#headimg #desc {
		display: block;
		margin: 0 auto;
		letter-spacing: .1em;
		text-transform: uppercase;
		margin: .9em 0 2em;
		font-weight: normal;
		font-size: 100%;
	}
	#headimg img {
		display: block;
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
	<?php
}
function brunelleschi_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

function brunelleschi_custom_header_setup($content_width) {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '444',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => 198,
		'width'                  => $content_width,
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'brunelleschi_header_style',
		
		// Header Text
		'header-text'            => true,
		'admin-head-callback'    => 'brunelleschi_admin_header_style',
		//'admin-preview-callback' => 'brunelleschi_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}

/*----------------------------------------
# 
# THEME OPTIONS CSS SUPPORT
# 
----------------------------------------*/

add_action('after_setup_theme', 'brunelleschi_options_setup');

if ( ! function_exists( 'brunelleschi_options_setup' ) ):
	function brunelleschi_options_setup() {
	
		// Font Options
		if( brunelleschi_options('fonts') === __('Modern','brunelleschi') ) {
			wp_register_style('brunelleschi_modern', get_template_directory_uri() . '/css/modern.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_modern');		
		}
		
		// Center Navigation
		if( brunelleschi_options('center-navigation')) {
			wp_register_style('brunelleschi_center-navigation', get_template_directory_uri() . '/css/center-navigation.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_center-navigation');
		}
		
		// Left Aligned Heading Text
		if( brunelleschi_options('left-heading')) {
			wp_register_style('brunelleschi_left-heading', get_template_directory_uri() . '/css/left-heading.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_left-heading');
		}
		
		// Heading Position relative to Banner
		if( brunelleschi_options('left-heading') || brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')) {
			wp_register_style('brunelleschi_small-site-title', get_template_directory_uri() . '/css/small-site-title.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_small-site-title');
		}
		
		// Navigation Position
		if( brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi')) {
			wp_register_style('brunelleschi_nav-above-banner', get_template_directory_uri() . '/css/nav-above-banner.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_nav-above-banner');
		}elseif( brunelleschi_options('navigation-position') === __('Nav Fixed to Top of Screen','brunelleschi')) {
			wp_register_style('brunelleschi_fixed-navigation', get_template_directory_uri() . '/css/fixed-navigation.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_fixed-navigation');
		}
		
		// Sidebar Options
		if( brunelleschi_options('sidebar') === __('left','brunelleschi') ){
			wp_register_style('brunelleschi_left-sidebar', get_template_directory_uri() . '/css/left-sidebar.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_left-sidebar');
		}elseif( brunelleschi_options('sidebar') === __('both','brunelleschi') && brunelleschi_options('sidebar-width') === __('two','brunelleschi')){
			wp_register_style('brunelleschi_both-sidebars-two', get_template_directory_uri() . '/css/both-sidebars-two.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_both-sidebars-two');
		}elseif(brunelleschi_options('sidebar') === __('both','brunelleschi') && brunelleschi_options('sidebar-width') === __('four','brunelleschi')){
			wp_register_style('brunelleschi_both-sidebars-four', get_template_directory_uri() . '/css/both-sidebars-four.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_both-sidebars-four');
		}elseif(brunelleschi_options('sidebar') === __('both','brunelleschi')){
			wp_register_style('brunelleschi_both-sidebars', get_template_directory_uri() . '/css/both-sidebars.css' );
			if(!is_admin()) wp_enqueue_style('brunelleschi_both-sidebars');
		}
		
	}
endif;

/*----------------------------------------
# 
# REGISTER WIDGETS AND SIDEBARS
# 
----------------------------------------*/
		
if ( ! function_exists( 'brunelleschi_widgets_init' ) ):
	function brunelleschi_widgets_init( ) {
		if( brunelleschi_options('sidebar') !== __('none','brunelleschi') ){
			/* Widget Area 1, located at the top of the sidebar.*/
			register_sidebar( array(
				'name' => __( 'Primary Widget Area', 'brunelleschi' ),
				'id' => 'primary-widget-area',
				'description' => __( 'The first widget area', 'brunelleschi' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		
			/* Widget Area 2, located below the Primary Widget Area in the sidebar. */
			register_sidebar( array(
				'name' => __( 'Secondary Widget Area', 'brunelleschi' ),
				'id' => 'secondary-widget-area',
				'description' => __( 'The second widget area', 'brunelleschi' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
		
		if( brunelleschi_options('sidebar') === __('both','brunelleschi') ||
			brunelleschi_options('sidebar') === __('two left','brunelleschi') ||
			brunelleschi_options('sidebar') === __('two right','brunelleschi') ){
			
			/* Widget Area 1, located at the top of the second sidebar.*/
			register_sidebar( array(
				'name' => __( 'Ternary Widget Area', 'brunelleschi' ),
				'id' => 'ternary-widget-area',
				'description' => __( 'The third widget area', 'brunelleschi' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		
			/* Widget Area 2, located below the Ternary Widget Area in the sidebar. */
			register_sidebar( array(
				'name' => __( 'Quaternary Widget Area', 'brunelleschi' ),
				'id' => 'quaternary-widget-area',
				'description' => __( 'The fourth widget area', 'brunelleschi' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
		
		/* Widget Area 3, located in the footer. Empty by default. */
		register_sidebar( array(
			'name' => __( 'First Footer Widget Area', 'brunelleschi' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'brunelleschi' ),
			'before_widget' => '<li id="%1$s" class="widget-container threecol %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
		/* Widget Area 4, located in the footer. Empty by default. */
		register_sidebar( array(
			'name' => __( 'Second Footer Widget Area', 'brunelleschi' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'The second footer widget area', 'brunelleschi' ),
			'before_widget' => '<li id="%1$s" class="widget-container threecol %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
		/* Widget Area 5, located in the footer. Empty by default. */
		register_sidebar( array(
			'name' => __( 'Third Footer Widget Area', 'brunelleschi' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'The third footer widget area', 'brunelleschi' ),
			'before_widget' => '<li id="%1$s" class="widget-container threecol %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
		/* Area 6, located in the footer. Empty by default. */
		register_sidebar( array(
			'name' => __( 'Fourth Footer Widget Area', 'brunelleschi' ),
			'id' => 'fourth-footer-widget-area',
			'description' => __( 'The fourth footer widget area', 'brunelleschi' ),
			'before_widget' => '<li id="%1$s" class="widget-container threecol last %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}
endif;

add_action( 'widgets_init', 'brunelleschi_widgets_init' );

/* Brunelleschi Branding Class */
if ( ! function_exists( 'brunelleschi_branding_class' )) :
	function brunelleschi_branding_class($echo = true){
		if( brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')){
			if( brunelleschi_options('sidebar') === __('two left','brunelleschi') || brunelleschi_options('sidebar') === __('two right','brunelleschi')){
				switch(brunelleschi_options('sidebar-width')){
					case __('two','brunelleschi'):
						if($echo){ echo 'fourcol'; }else{
							if(brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')){
								echo ' last ';
							}
						};
						return 'four';
						break;
					case __('three','brunelleschi'):
						if($echo){ echo 'sixcol'; }else{
							if(brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')){
								echo ' last ';
							}
						};
						return 'six';
						break;
					case __('four','brunelleschi'):
						if($echo){ echo 'eightcol'; }else{
							if(brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')){
								echo ' last ';
							}
						};
						return 'eight';
						break;
				}
			}elseif(brunelleschi_options('sidebar') === __('left','brunelleschi') || brunelleschi_options('sidebar') === __('right','brunelleschi')){
				if($echo){ echo brunelleschi_options('sidebar-width').'col'; }
				return brunelleschi_options('sidebar-width');
			}else{
				if($echo){ echo 'threecol'; }
				return brunelleschi_options('sidebar-width');
			}
		}else{
			echo 'twelvecol last';
			return 'twelve';
		}
		if(brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')){
			echo ' last';
		}
	}
endif;

/* Brunelleschi Banner Class */
if ( ! function_exists( 'brunelleschi_banner' )) :
	function brunelleschi_banner_class() {
		switch(brunelleschi_branding_class(false)){
			case 'two':
				echo 'tencol ';
				break;
			case 'three':
				echo 'ninecol ';
				break;
			case 'four':
				echo 'eightcol ';
				break;
			case 'six':
				echo 'sixcol ';
				break;
			case 'eight':
				echo 'fourcol ';
				break;
			case 'twelve ':
				echo 'twelvecol ';
				break;
		}
		if(brunelleschi_options('header-order') !== __('Text on the Right','brunelleschi')){
			echo 'last';
		}
	}
endif;

/* Brunelleschi Sidebar Function */
if ( ! function_exists( 'brunelleschi_sidebar_class' ) ):
	function brunelleschi_sidebar_class(){
		if(!brunelleschi_options('sidebar-width')){
			echo 'threecol last ';
		} else { 
			echo brunelleschi_options('sidebar-width').'col ';
		}
		if( brunelleschi_options('sidebar') === __('right','brunelleschi') ||
			brunelleschi_options('sidebar') === __('both','brunelleschi') ||
			brunelleschi_options('sidebar') === __('two right','brunelleschi')){
			echo 'last ';
		}
	}
endif;

/* Brunelleschi Secondary Sidebar Function */
if ( ! function_exists( 'brunelleschi_secondary_sidebar_class' ) ):
	function brunelleschi_secondary_sidebar_class(){
		if(!brunelleschi_options('sidebar-width')){
			echo 'threecol';
		} else { 
			echo brunelleschi_options('sidebar-width').'col ';
		}
		if( brunelleschi_options('sidebar') === __('two right','brunelleschi')){
			echo 'right';
		}else{
			echo 'left';
		}
	}
endif;

/* Brunelleschi Content Function */
if ( ! function_exists( 'brunelleschi_content_class' ) ):
	function brunelleschi_content_class(){
		if( !brunelleschi_options('sidebar') ) {
			echo 'ninecol ';
		} elseif( brunelleschi_options('sidebar') === __('none','brunelleschi') ) {
			echo 'twelvecol last ';
		} elseif( brunelleschi_options('sidebar') === __('both','brunelleschi') ||
				brunelleschi_options('sidebar') === __('two left','brunelleschi') ||
				brunelleschi_options('sidebar') === __('two right','brunelleschi') ){
			switch( brunelleschi_options('sidebar-width') ) {
				case __('two','brunelleschi'):
					echo 'eightcol ';
					break;
				case __('three','brunelleschi'):
					echo 'sixcol ';
					break;
				case __('four','brunelleschi'):
					echo 'fourcol ';
					break;
				default:
					echo 'sixcol';
					break;
			}
		} else {
			switch( brunelleschi_options('sidebar-width') ) {
				case __('two','brunelleschi'):
					echo 'tencol ';
					break;
				case __('three','brunelleschi'):
					echo 'ninecol ';
					break;
				case __('four','brunelleschi'):
					echo 'eightcol ';
					break;
				default:
					echo 'ninecol';
					break;
			}
		}
		if( brunelleschi_options('sidebar') === __('left','brunelleschi') || brunelleschi_options('sidebar') === __('two left','brunelleschi') ) {
			echo ' last ';
		}
		if( brunelleschi_options('sidebar') === __('two left','brunelleschi')) {
			echo ' right ';
		}
	}
endif;

/* HTML5 Image Captions */
add_filter('img_caption_shortcode', 'brunelleschi_img_caption_shortcode_filter',10,3);

if ( ! function_exists( 'brunelleschi_img_caption_shortcode_filter' ) ):
	function brunelleschi_img_caption_shortcode_filter($val, $attr, $content = null) {
		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> '',
			'width'	=> '',
			'caption' => ''
		), $attr));
		
		if ( 1 > (int) $width || empty($caption) )
			return $val;
	
		$capid = '';
		if ( $id ) {
			$id = esc_attr($id);
			$capid = 'id="figcaption_'. $id . '" ';
			$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
		}
	
		return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
		. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
		. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
	}
endif;

/* Experimental Featured Post*/
if ( ! function_exists( 'brunelleschi_slider_meta_box' ) ):
	function brunelleschi_slider_meta_box() {
		/* Define the custom box */
		$prefix = 'brunelleschi_';
		
		$meta_box = array(
			'id' => 'featured-content-meta-box',
			'title' => __('Featured Content','brunelleschi'),
			'context' => 'side',
			'priority' => 'default',
			'fields' => array(
				array(
					'name' => __('Add to Featured Content?','brunelleschi'),
					'id' => $prefix . 'featured_post_checkbox',
					'type' => 'checkbox'
				),
				array(
					'name' => __('Image Only','brunelleschi'),
					'id' => $prefix . 'featured_post_image-only',
					'type' => 'checkbox'
				),
				array(
					'name' => __('Display Text on Right or Left?','brunelleschi'),
					'id' => $prefix . 'featured_post_position',
					'type' => 'select',
					'options' => array(
						__('left','brunelleschi'),
						__('right','brunelleschi')
					),
					'std' => __('left','brunelleschi')
				),
				array(
					'name' => __('Text Display Width?','brunelleschi'),
					'id' => $prefix . 'featured_post_width',
					'type' => 'select',
					'options' => array(
						__('1/4 Width','brunelleschi'),
						__('1/3 Width','brunelleschi'),
						__('1/2 Width','brunelleschi'),
						__('Full Width','brunelleschi')
					),
					'std' => __('1/4 Width','brunelleschi')
				),
				array(
		            'name' => __('Feature Description:','brunelleschi'),
		            'desc' => __('Add summary for the Feature Slider','brunelleschi'),
		            'id' => $prefix . 'featured_post_description',
		            'type' => 'textarea',
		            'std' => ''
		        )
			)
		);
		return $meta_box;
	}
	
endif;


/* Add meta box of option set */
if(brunelleschi_options('use-featured-content') == '1') {
	add_action('admin_menu', 'brunelleschi_add_meta_box');
}
if ( ! function_exists( 'brunelleschi_add_meta_box' ) ):
	function brunelleschi_add_meta_box() {
		$meta_box = brunelleschi_slider_meta_box();
		add_meta_box($meta_box['id'], $meta_box['title'], 'brunelleschi_show_meta_box', 'post', $meta_box['context'], $meta_box['priority']);
		add_meta_box($meta_box['id'], $meta_box['title'], 'brunelleschi_show_meta_box', 'page', $meta_box['context'], $meta_box['priority']);
	}
endif;

/* Callback function to show fields in meta box */
if ( ! function_exists( 'brunelleschi_show_meta_box' ) ):
	function brunelleschi_show_meta_box() {
		global $post;
		$meta_box = brunelleschi_slider_meta_box();
		
		echo '<input type="hidden" name="brunelleschi_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		echo '<table class="form-table">';
	
		foreach ($meta_box['fields'] as $field) {
			$meta = get_post_meta($post->ID, $field['id'], true);
			
			echo '<tr><td>';
			switch ($field['type']) {
				case 'checkbox':
					echo '<label for="', $field['id'], '" style="margin-right: 10px;">', $field['name'], '</label>',
						'<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', checked($meta, 'on'), ' />';
					break;
				case 'select':
					echo '<label for="', $field['id'], '" style="margin-right: 10px;">', $field['name'], '</label>',
						'<select name="', $field['id'], '" id="', $field['id'], '" />';
					foreach( $field['options'] as $option ){
						echo '<option name="',$option,'" value="',$option,'" ', selected($meta, $option),'>',ucfirst($option),'</option>';
					}
					echo '</select>';
					break;
				case 'textarea':
					echo '<label for="', $field['id'], '" style="margin-right: 10px;">', $field['name'], '</label>',
						'<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? esc_textarea(stripslashes($meta)) : esc_textarea( stripslashes($field['std']) ),
						'</textarea>', '<br /><span class="desc" style="float: right; color:#666;">', $field['desc'], '</span>';
	                break;
	
			}
			echo 	'</td></tr>';
		}
		
		echo '</table>';
	}
endif;

add_action('save_post', 'brunelleschi_save_metabox_data');

/* Save data from meta box */
if ( ! function_exists( 'brunelleschi_save_metabox_data' ) ):
	function brunelleschi_save_metabox_data($post_id) {
		$meta_box = brunelleschi_slider_meta_box();
		
		if (!wp_verify_nonce($_POST['brunelleschi_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		foreach ($meta_box['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				/* Sanitize Textarea */
				if($field['type'] === 'textarea'){
					$new = addslashes($new);
				}
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
endif;

/* Replaces anchor tags with spans to prevent nested links, essentially it creates fake links */
if ( ! function_exists( 'brunelleschi_featured_content_link_filter' )) :
	function brunelleschi_featured_content_link_filter($string){
		$find = array(
			'/<a /',
			'/href="(.*?)"/',
			'/<\/a>/'
		);
		$replace = array(
			'<span class="fake-link" ',
			'onclick="window.open(\'$1\'); event.stopPropagation()"',
			'</span>'
		);
		$string = preg_replace ( $find , $replace , $string );
		return $string;
	}
endif;