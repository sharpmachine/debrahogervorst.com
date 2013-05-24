<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 lt-ie9 lt-ie8 lt-ie7" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 lt-ie9 lt-ie8" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 lt-ie9" <?php echo language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php echo language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">
		<title><?php brunelleschi_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<style type="text/css"> #wrapper { max-width: <?php echo brunelleschi_options('content-width'); ?>px !important;} </style>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			wp_head();
		?>
		<style><?php if(brunelleschi_options('extra-css')){ echo brunelleschi_options('extra-css'); }?></style>
	</head>
	<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed container">
		<header id="header" class="row clearfix">
			<?php if( (brunelleschi_options('header-order') === __('Text on Top','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || ! brunelleschi_options('header-order')) && !(brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi') && brunelleschi_options('header-order') === __('Text on the Left','brunelleschi')) ) : ?>
				<hgroup id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php endif; ?>
			<?php if(!brunelleschi_options('hide-navigation') && brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi')): ?>
				<div id="access" role="navigation" class="twelvecol last clearfix">
					<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'brunelleschi' ); ?>"><?php _e( 'Skip to content', 'brunelleschi' ); ?></a></div>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</div><!-- #access -->
			<?php endif; ?>
			<?php if( brunelleschi_options('navigation-position') === __('Nav Above Banner','brunelleschi') && ( brunelleschi_options('header-order') === __('Text on the Left','brunelleschi') || ! brunelleschi_options('header-order') )) : ?>
				<hgroup id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php endif; ?>
			<?php if(brunelleschi_options('use-featured-content')): ?>
				<?php get_template_part( 'featured', 'content' ); ?>
			<?php elseif(brunelleschi_options('use-header-image')) : ?>
				<?php
				// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT ), array( 'id' => 'headerimg') );
				elseif ( get_header_image() ) : ?>
					<a href="<?php echo home_url( '/' ); ?>" class="<?php brunelleschi_banner_class(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" alt="" id="headerimg" />
					</a>
				<?php endif; ?>	
			<?php endif; ?>
			<?php if(brunelleschi_options('header-order') === __('Text on the Bottom','brunelleschi') || brunelleschi_options('header-order') === __('Text on the Right','brunelleschi')) : ?>
				<hgroup id="branding" class="<?php brunelleschi_branding_class(); ?>">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php endif; ?>
			<?php if((brunelleschi_options('navigation-position')) == false || brunelleschi_options('navigation-position') === __('Nav Fixed to Top of Screen','brunelleschi') || !brunelleschi_options('hide-navigation') && brunelleschi_options('navigation-position') === __('Nav Below Banner','brunelleschi')): ?>
				<div id="access" role="navigation" class="twelvecol last clearfix">
					<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'brunelleschi' ); ?>"><?php _e( 'Skip to content', 'brunelleschi' ); ?></a></div>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</div><!-- #access -->
			<?php endif; ?>
		</header><!-- #header -->
		<div id="container" class="row clearfix">