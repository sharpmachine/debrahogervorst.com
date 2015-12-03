<?php

/**
 * This is a "blind" function. All it does is write data to a file.
 * It assumes that the data has been sanitized and ready for production
 */
function tribe_print_css()
{
	$tribe_settings = tribe_get_options();
	$css = "";
	$data = $tribe_settings;

	$first_paragraph_larger = "";
	if ( nc_tribe_get_option( 'first-paragraph-larger-single' ) == 'yes' )
	{
		$first_paragraph_larger .= '.single .entry-content > p:first-of-type';
	}

	if ( nc_tribe_get_option( 'first-paragraph-larger-pages' ) == 'yes' )
	{
		if ( ! empty( $first_paragraph_larger ) )
		{
			$first_paragraph_larger .= ', ';
		}
		$first_paragraph_larger .= '.page.page-template-default .entry-content p:first-of-type';
	}

	if ( nc_tribe_get_option( 'first-paragraph-larger-archives' ) == 'yes' )
	{
		if ( ! empty( $first_paragraph_larger ) )
		{
			$first_paragraph_larger .= ', ';
		}
		$first_paragraph_larger .= 'body.archive .entry-content > p:first-of-type';
	}

	if ( ! empty( $first_paragraph_larger ) )
	{
		$css .= $first_paragraph_larger . ' { 
			font-size: ' . $data['body-font-size'] * 1.3 . 'px;
			line-height: ' . round( $data['body-font-size'] * 1.825 ) . 'px;
	}';
	}
	$logo_height = $data['logo-height'];
	$logo_width = $data['logo-width'];
	if ( $logo_width > 960 ) 
	{
		$logo_width = 960;
		$logo_height = ceil( $logo_height * 960 / $logo_width );
	}
	$css .= 'body, input, textarea {
	' . font_family_for( 'body' ) . '
	font-size: ' . $data['body-font-size'] . 'px' . ';
	line-height: ' . round( $data['body-font-size'] * 1.5 ) . 'px;
	color: ' . $data['body-color'] . ';
}
.tribe_text .header-wrap a, body.tribe_text .tagline {
	color: ' . $data['header-text-color'] . ';
}
h1, h2, h3, h4 {
		' . font_family_for( 'headline' ) . '
	font-weight: ' . $data['headline-font-weight'] . ';
}

h1, h2 {
	font-size: ' . $data['headline-font-size'] . 'px;
	line-height: ' . round( $data['headline-font-size'] * 1.1 ) . 'px;
}

.more-link, .read-more, input[type="submit"], button, .navigation li a, .pagination, .btn {
	' . font_family_for( 'headline' ) . '
}

blockquote {
	font-size: ' . round( $data['body-font-size'] * 1.14 ). 'px' . ';
	line-height: ' . round( $data['body-font-size'] * 1.6 ) . 'px;
}

#sidebar {
	font-size: ' . round( $data['body-font-size'] * .75 ) . 'px;
	line-height: ' . round( $data['body-font-size'] * 1.22 ) . 'px;
}

h3 {
	font-size: ' . round( $data['headline-font-size'] * .8 ) . 'px;
	line-height: ' . round( $data['headline-font-size'] * .8 * 1.3 ) . 'px;
}

h4 {
	font-size: ' . round( $data['headline-font-size'] * .65 ) . 'px;
	line-height: ' . round( $data['headline-font-size'] * .65 * 1.3 ) . 'px;
}
.navigation.dropdown li li a:hover {
	background:  ' . $data['button-color'] . ';
}
 ::selection {
	background:' . $data['link-color'] . ';
	color: white;
}
 ::-moz-selection {
	background:' . $data['link-color'] . ';
	color: white;
}
 input::-webkit-input-placeholder { /* WebKit browsers */
 color: ' . $data['body-color'] . ';
}
 input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
 color: ' . $data['body-color'] . ';
}
 input::-moz-placeholder { /* Mozilla Firefox 19+ */
 color: ' . $data['body-color'] . ';
}
 input:-ms-input-placeholder { /* Internet Explorer 10+ */
 color: ' . $data['body-color'] . ';
}
a {
	color: ' . $data['link-color'] . ';
}
input[type="submit"], button, a.more-link, .pagination a {
	color: ' . $data['button-color'] . ';
}
input[type="submit"]:hover, button:hover, a.more-link:hover, .pagination a:hover, .comment-reply-link:hover, .btn:hover, .sticky-bar input[type="submit"] {
	border-color: ' . $data['button-color'] . ';
	background-color: ' . $data['button-color'] . ';
}
.tribe-header {
	background: ' . $data['header-background-color'] . ';
}
.special {
	background: ' . $data['special-background-color'] . ';
}
body.tribe_logo header.tribe-header a {
	display:block;
	margin: 0 auto;
	height: ' . $logo_height .'px;
	width: ' . $logo_width . 'px;
	background: url(' . nc_tribe_get_option( 'logo' ) . ') no-repeat center;
}
.sticky-bar, .sticky-bar a {
	background: ' . nc_tribe_get_option( 'sticky-bar-background' ) . ';
	color: ' . nc_tribe_get_option( 'sticky-bar-font-color' ) . ';
}
.sticky-bar a {
	text-decoration: underline;
}
';

	$css .= nc_tribe_get_option( 'custom-css' );
	return str_replace(array("\r", "\n", "\t"), '', $css);
}

function font_family_for( $area ) {

	$font = nc_tribe_get_option( $area . '-font-family' );

	// If user has entered a custom font family
	if ( strpos($font, "'") !== false || strpos($font, '"') !== false )
	{
		$quote = "";
	}
	else
	{
		$quote = '"';
	}

	return 'font-family: ' . $quote . $font . $quote . '; ';
}

