<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo tribe_format_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php do_action( 'tribe_header_scripts' ); ?>
<?php wp_head(); ?>
<?php do_action( 'tribe_head' ); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( nc_tribe_get_option( 'header-contains' ) == 'logo' )
{
	echo '<input type="hidden" name="logo-height" value="' . nc_tribe_get_option( 'logo-height' ) . '"><input type="hidden" name="logo-width" value="' . nc_tribe_get_option( 'logo-width' ) . '">';
}?>
<div id="wrap">
<?php do_action('tribe_before_header'); ?>
<header class="tribe-header">
<?php do_action('tribe_header'); ?>
</header>
<?php do_action('tribe_after_header'); ?>
<div id="inner">
<div id="content-sidebar-wrap">
