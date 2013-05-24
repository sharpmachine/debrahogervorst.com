<!-- START: sidebar-alt -->
<div id="sidebar-alt">

<!-- START: sidebar-widget -->
<ul id="sidebar-alt-widget">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-alternate') ) : else : ?>

<li id="tags">
<h2><?php _e('Popular Tags'); ?></h2>
<?php wp_tag_cloud('smallest=10&largest=20&number=20'); ?>
<li>

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