<!-- START: sidebar -->
<div id="sidebar">

<!-- START: sidebar-widget -->
<ul id="sidebar-widget">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-primary') ) : else : ?>

<li id="search">
<h2><?php _e('Search'); ?></h2>
<?php include(TEMPLATEPATH."/searchform.php");?>
</li>

<li id="rss-random">
<p class="rss-random">
<span class="icon-rss"><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to RSS Feed"><img src="<?php bloginfo('template_directory'); ?>/i/icon-rss.gif" width="72" height="72" alt="Subscribe to RSS Feed" /></a></span>
<?php if (function_exists('matt_random_redirect')) { ?>
<span class="randompost"><img src="<?php bloginfo('template_directory'); ?>/i/random.png" width="32" height="32" alt="Stumble on a Random Article" />
Do you know that you can <a href="<?php bloginfo('url'); ?>/?random" title="Stumble on a Random Article">Stumble on a Random Article</a>!</span>
<?php } ?>
</p>
<p class="clearall"></p>
</li>

<?php /* START: letsmint.com module */ /* This portion is only for  letsmint.com domain. You can remove this module if you wish. */ if ($_SERVER['HTTP_HOST']=="www.letsmint.com") { ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/themesdownloads.inc.php"; ?>

<li id="donate-paypal">
<h2><?php _e('Help Lets Mint'); ?></h2>
<p>Donating generously will help our team create more graciously beautiful, sleek and stunning Open Source Wordpress Themes.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHXwYJKoZIhvcNAQcEoIIHUDCCB0wCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCQDkW800mUyelJJ+P2xOy/YglZFzEbGVUN0WLAdwVJmYF9ZO/0pGD1hD2NTLaa6qi84MF7zh19x8yuKcLn1BXKoPQSVAU0s9po8U+3DG2PHz3sWfJpGnVhMk41nFX/jbkIoH35skAlkt7m1YiOZoFb3sNe6vxD8WxylsQ75P3BOTELMAkGBSsOAwIaBQAwgdwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIrrGVLX89Pe+Agbh/GZ5BE6RXexffb1r/c2NrRmC/6k1cEwYlOdVPiZHZMIUb7pVBami9seU+2/MQumnIK0P5hqfOUg1UUHcpxDX+ch2CahbNbX5Ab2/loPh9Y0TuU4Zn13WpW5O47F+1xY3Bf6HtPWdIqo8guthw/LmaSY+SEL87AZF1WTR4UGDwrQ+3FoJGSTIoP4X/egqd9DQx6IWPgoMJenHrDHddLj7fik1yqk1UwM9W2xOMbwiUjXcr5wVRQ2NSoIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMDcwNDAxMjExMDM0WjAjBgkqhkiG9w0BCQQxFgQUVIR3mxDJsKbOIxOFeCFstozNkDwwDQYJKoZIhvcNAQEBBQAEgYCjWBi7WqMJ0hQcUGH0fp3ukcRuAF326mA4VR7kM4Nq8IpPNyS3CiwrAylebo4ztewCPGBrFapqDUOhK3kjym7HsmjVmviBHoGsOOEapucW0/HV21FamQpldi0/qCRqOZR4HiNoHsKD9iLBcEjZte5aYyzZIaYK/ABYSh6bhCpJZw==-----END PKCS7-----
">
</form>
</li>
<?php } /* END: letsmint.com module */ ?>

<!-- uncomment this module to display a yearly archive list
<li id="archives-yearly">
<h2><?php _e('Archives - Yearly'); ?></h2>
<ul>
<?php
$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
foreach($years as $year) : 
?>
<li><a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a></li>
<?php endforeach; ?>
</ul>
</li>
-->

<li id="archives-monthly">
<h2><?php _e('Archives - Monthly'); ?></h2>

<form id="archiveform" action="">
<select name="archive_list" onchange="window.location = (document.forms.archiveform.archive_list[document.forms.archiveform.archive_list.selectedIndex].value);">
<option value=''>Select a Month</option>
<?php get_archives('monthly', '', 'option', '', '', show_post_count); ?>
</select>
</form>

<!-- // uncomment this section to get a monthly list archives instead of the drop down
<ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul>
-->
</li>

<li id="categories">
<h2><?php _e('Categories'); ?></h2>
<ul><?php wp_list_categories('orderby=name&show_count=1&hide_empty=1&title_li'); ?></ul>
<li>
	
<?php if ( is_home() ) { ?>
<?php wp_list_bookmarks("categorize=1&orderby=name&show_images=0&show_description=0&title_li"); ?>
<?php } ?>

<li id="meta">
<h2><?php _e('Meta'); ?></h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>
</li>	

<li id="etcetera">
	<h2><?php _e('Etcetera'); ?></h2>
	<p><script src="http://widgets.technorati.com/t.js" type="text/javascript"></script><a href="http://technorati.com/blogs/<?php bloginfo('url'); ?>?sub=tr_authority_t_ns" class="tr_authority_t_js" style="color:#4261DF">Technorati blog authority</a></p>
	<!-- SPOTPLEX: remember to change the spotplex number to yours from http://www.spotplex.com/ -->
	<p><img src="http://www.spotplex.com/send/249163/regular-image.gif"></p>
</li>

<?php endif; ?>
</ul>
<!-- START: sidebar-widget -->

</div>
<!-- END: sidebar -->
<div class="clearall"><!-- let me try and pull down the content div --></div>