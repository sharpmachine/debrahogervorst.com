<?php
if ( function_exists('register_sidebar') )
{
register_sidebar(array('name'=>'sidebar-alternate'));
register_sidebar(array('name'=>'sidebar-primary'));
}

// custom google adsense 
function widget_mytheme_adsense() {
?>
<li id="ads-adsense">
<h2>Sponsors</h2>
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
<?php
}
if ( function_exists('register_sidebar_widget') )
register_sidebar_widget(__('Lorem Ipsim - Google Adsense'), 'widget_mytheme_adsense');

function widget_mytheme_etcetera() {
?>
<li id="etcetera">
	<h2>Etcetera</h2>
	<p>
	<script src="http://widgets.technorati.com/t.js" type="text/javascript"></script><a href="http://technorati.com/blogs/<?php bloginfo('url'); ?>?sub=tr_authority_t_ns" class="tr_authority_t_js" style="color:#4261DF">Technorati blog authority</a>
	</p>
</li>
<?php
}
if ( function_exists('register_sidebar_widget') )
register_sidebar_widget(__('Lorem Ipsum - Etcetera'), 'widget_mytheme_etcetera');

?>