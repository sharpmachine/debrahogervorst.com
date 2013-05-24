			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'brunelleschi' ); ?></p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'brunelleschi' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="navigation">
				<?php paginate_comments_links(); ?>
			</nav> <!-- .navigation -->
	<?php endif; ?>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'brunelleschi_comment' ) ); ?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="navigation">
				<?php paginate_comments_links(); ?>
			</nav><!-- .navigation -->
	<?php endif; ?>

<?php else : if ( ! comments_open() ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'brunelleschi' ); ?></p>
	<?php endif; ?>

<?php endif; ?>

<?php if ( have_comments() && !comments_open() ) :?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'brunelleschi' ); ?></p>
<?php endif; ?>

<?php comment_form(); ?>

</div><!-- #comments -->
