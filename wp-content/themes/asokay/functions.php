<?php
/* Theme: Asokay by andreasviklund.com - Based on Toolbox by Automattic */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on toolbox, use a find and replace
 * to change 'asokay' to the name of your theme in all the template files
 */
load_theme_textdomain( 'asokay', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'asokay' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add support for the Aside and Gallery Post Formats
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function asokay_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'asokay_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function asokay_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar 1', 'asokay' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array (
		'name' => __( 'Sidebar 2', 'asokay' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'asokay' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
}
add_action( 'widgets_init', 'asokay_widgets_init' );

/*
 * Custom header image
 */

define('HEADER_TEXTCOLOR', '333333');
define('HEADER_IMAGE', '%s/images/header.jpg');
define('HEADER_IMAGE_WIDTH', 940);
define('HEADER_IMAGE_HEIGHT', 240);
 
function asokay_header_style() {
    ?><style type="text/css">
        #headerimage {
            background: url(<?php header_image(); ?>);
        }
    </style><?php
}

function asokay_admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            background: no-repeat;
        }
    </style><?php
}

add_custom_image_header('asokay_header_style', 'asokay_admin_header_style');

/*
 * Asokay comments
 */

function asokay_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'asokay' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'asokay' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'asokay' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'asokay' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'asokay' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'asokay'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
