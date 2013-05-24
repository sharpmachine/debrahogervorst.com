<!-- START: sidebar-alt -->
<div id="sidebar-alt">

<!-- START: sidebar-widget -->
<ul id="sidebar-alt-widget">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-alternate') ) : else : ?>

<?php /* This portion is only for  letsmint.com domain. You can remove this module if you wish. */ if ($_SERVER['HTTP_HOST']=="www.letsmint.com") { ?>

<li id="affiliate-tla">
<h2><?php _e('Earn Money'); ?></h2>
<p>Sign up for a <a href="http://www.text-link-ads.com/?ref=23717" title="Text-Link-Ads account">Text-Link-Ads account</a> and start earning money from your blog. If you sign up through us, you'll be helping us earn too.</p>
<p><a href="http://www.text-link-ads.com/?ref=23717"><img src="http://www.text-link-ads.com/images/text_link_ads_A_180x60.gif" border="0" alt="Text Link Ads"></a></p>
</li>
<?php } ?>

<li id="articles-latest">
<h2><?php _e('Latest Articles'); ?></h2>
<ol>
<?php /* If this is home or a page */ if ( is_single() || is_page() ) {
	wp_get_archives('type=postbypost&limit=5&format=html');
} else {
	wp_get_archives('type=postbypost&limit=10&format=html');
} ?>
</ol></li>

<li id="ads-adsense">
<script type="text/javascript"><!--
google_ad_client = "pub-4468481779445136"; //change this to your Publisher ID
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text";
//2007-04-01: wp-theme-lorem-ipsum
google_ad_channel = "2784874737"; //change this to your appropriate channel
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "333333";
google_color_text = "666666";
google_color_url = "000000";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</li>

<?php endif; ?>
</ul>
<!-- END: sidebar-widget -->

</div>
<!-- END: sidebar-alt -->