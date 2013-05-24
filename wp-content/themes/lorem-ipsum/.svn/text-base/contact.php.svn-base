<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style-wp-gbcf.css" type="text/css" media="screen" />

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post">
	<h2><?php the_title(); ?></h2>
	<?php
	// WILL BE PAGE CONTENT
	$post_data=get_post($post->ID); echo $post_data->post_content;

	// FORM SHOWS NEXT
	if (function_exists('wp_gb_contact_form')) {
		gbcf_show();
	} else {
		echo '
		<p>This contact template is best used with
		<a href="http://green-beast.com/blog/?page_id=136">Secure and Accessible PHP Contact Form</a> for WordPress.
		</p>
		';
	}
?>
<p><?php edit_post_link('&uarr; edit this page'); ?></p>

</div>

<?php endwhile; else : ?>

<div class="post">
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
</div>

<?php endif; ?>
</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>