<?php
/*
Template Name: Authors
*/
?>

<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">

	<div class="post">
		<h2>Authors, Editors &amp; Contributors</h2>
		<p>We have some good writers who knows their words. Here we introduce you to our authors, editors and contributors!</p>
		<ul><?php wp_list_authors('optioncount=1&exclude_admin=0&show_fullname=0&hide_empty=1'); ?></ul>
	</div>
	
	<div class="post">
		<!-- This sets the $curauth variable -->
		<?php
		if(isset($_GET['author_name'])) :
		$curauth = get_userdatabylogin($author_name);
		else :
		$curauth = get_userdata(intval($author));
		endif;
		?>

		<h2>Articles from <?php echo $curauth->nickname; ?></h2>

		<ol>
		<!-- The Loop -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><br />
		&mdash; <?php the_time('d M Y'); ?> in <?php the_category('&');?></li>

		<?php endwhile; else: ?>
		<p><?php _e('No articles from this Author, Editor, Contributor yet!'); ?></p>
		<?php endif; ?>
		<!-- End Loop -->
		</ol>
	</div>

</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>
