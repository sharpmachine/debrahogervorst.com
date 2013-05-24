<a name="content"></a>
<div id="content-wrap">
	<div id="right">
		<div id="right-in">
			<div id="feed"><br /><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_bloginfo(template_directory); ?>/i/ico_feed_shadow.gif" width="72" height="109" alt="Subscribe to RSS Feeds" border="0" /></a></div>

			<h2>Search</h2>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			
			<div id="nav-left">
			
			<?php /* This is only for letsmint.com domain to show the theme switcher and the theme downloads. You can remove this line if you wish. */ if ($_SERVER['HTTP_HOST']=="letsmint.com") {include $_SERVER['DOCUMENT_ROOT']."/themesdownloads.inc.php";} ?>
				
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>				
				<h2><?php _e('Categories'); ?></h2>
				<ul>
					<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>					
				</ul>
				<h2><?php _e('Archives'); ?></h2>				
				<ul><?php wp_get_archives('type=monthly'); ?></ul>				
				<!-- replace the above line with this form if you have lots of archives, to display a drop down of your monthly archives
				<form id="archiveform" action="">
				<select name="archive_chrono" onchange="window.location =
				(document.forms.archiveform.archive_chrono[document.forms.archiveform.archive_chrono.selectedIndex].value);">
				<option value=''>Select Month</option>
				<?php get_archives('monthly','','option'); ?>
				</select>
				</form>
				-->
				<h2>Links</h2>
				<ul>
					<?php 
						get_links(-1, '<li>', '</li>', '', TRUE, 'url', FALSE); 
						// replace -1 with the category ID you want to display
						// Check http://codex.wordpress.org/Template_Tags/get_links for more info on this tag
					?>
				</ul>
				<h2>Meta</h2>						
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
				<?php endif; ?>
			</div>
		</div> <!-- end #right -->
	</div> <!-- end #right-in -->