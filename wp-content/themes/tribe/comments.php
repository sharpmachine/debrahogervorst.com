<?php

function tribe_format_comment( $comment, $args, $depth )
{
	?> <li <?php comment_class(); ?>><div class="comment-body" id="comment-<?php comment_ID() ?>">
		<div class="left"><?php echo get_avatar( $comment, $size = $args['avatar_size'] ); ?></div>
		<div class="right"><div class="comment-author"><?php echo get_comment_author_link(); ?></div>
	 <div class="publish_date"><a href="#comment-<?php comment_ID(); ?>"><?php comment_date('F j, Y \a\t g:i a'); ?></a> <?php edit_comment_link('Edit', ' &bull; <span class="edit_comment">', '</span>'); ?></div>
	<div class="comment-content">
      <?php if ( $comment->comment_approved == '0' ) { ?>
             <p class="alert"><?php echo 'Your comment is awaiting moderation.'; ?></p>
       <?php } ?>

            <?php comment_text(); ?>
        </div>
				
				<div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
				
				</div></div>

	<?php
}
	global $post;
if ( post_password_required() || 'closed' == $post->comment_status && ! have_comments() )
	return;
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) { ?>
		<h2 class="comments-title">
			<?php
				echo '<h2 class="reply-headline">';
				if ( get_comments_number() == 1 )	
				{
					echo 'One Reply';
				}
				else
				{
					echo get_comments_number() . " Replies";
				}
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'tribe_format_comment', 'avatar_size' => 64, 'style' => 'ol', 'type' => 'comment' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
		</nav>
		<?php } // check for comment navigation 

		if ( ! comments_open() && get_comments_number() ) {
	 		// 'sorry, comments are closed'
		} 
	}// have_comments() 
	
	$args = array(
		'comment_notes_before' => '',
		//'logged_in_as' => '',
		'comment_notes_after' => '',
		  'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		);
		$args = apply_filters('tribe_comment_form', $args );
		// We let 3rd party developers optionally require logging in on 
		// a page-by-page basis.
		if ( isset( $args['tribe_require_login'] ) && $args['tribe_require_login'] === true )
		{
			echo $args['tribe_sorry_message'];
		}
		else
		{
	 	comment_form( $args ); 
		}
		
echo '</div><!-- #comments .comments-area -->';