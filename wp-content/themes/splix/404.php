<?php get_header(); ?>
<div id="wrapper">
	<div id="content">

		<div class="msgerror"><?php _e('Error 404 - Page not found','splix') ?></div>
        <div class="msgbox">
		<?php 	_e('Sorry but the page you are trying to view does not exist. As a solution to this problem, you can try these tips:','splix') ?>
        	<ul>
            	<li><?php _e('refresh this page in a few seconds','splix') ?></li>
            	<li><?php _e('check if the URL address is correct','splix') ?></li>
                <li><?php _e('use the field in the sidebar to perform a quick search in this weblog','splix') ?></li>
                <li><a href="<?php echo get_settings('home'); ?>"><?php _e('return to the homepage','splix') ?></a></li>
            </ul>
      <?php _e('Otherwise you can visit the last posts:','splix');
            $posts = get_posts('numberposts=5&orderby=post_date');
			foreach($posts as $post) {
				setup_postdata($post);
				echo '<br/><a href="' . get_permalink() . '">' . get_the_title() . '</a>';
			} ?>
        </div>

	</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>