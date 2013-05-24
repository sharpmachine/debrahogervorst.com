<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>


    <div id="comments">
        <h3 class="noonemore"><?php comments_number(__('No comments','splix'), __('1 comment','splix'), __('% comments','splix'));?></h3> 
<?php	if ($comments) { ?>           
        	<ol class="commentlist">
    <?php		foreach ($comments as $comment) {
					if (($comment->comment_type == 'trackback')||($comment->comment_type == 'pingback')) { ?>
                    	<!-- TRACKBACK & PINGBACK-->
    					<li class="<?php echo $comment->comment_type; ?>" id="comment-<?php comment_ID() ?>">
                            <div class="info">
                                <div class="commentmeta">
                                    <span class="<?php echo $comment->comment_type; ?>"><a href="<?php comment_author_url() ?>" title="<?php comment_author() ?>"><?php echo $comment->comment_type; ?></a></span>
                                    <span class="date"><?php comment_date(__('F jS, Y','splix'));?></span>
                                    <span class="time"><?php comment_time(__('g:i a','splix')); ?></span>
        <?php						edit_comment_link(__('Edit','splix'),'<span class="comment_edit">','</span>'); ?>
                                </div>
    <?php						if ($comment->comment_approved == '0') { ?>
                                    <div class="mods"><?php _e('Not<br/>approved<br/>yet','splix'); ?></div>
    <?php						}else{ ?>
                                    <div class="id">
            <?php						global $commentcount;
                                        if(!$commentcount) {
                                            $commentcount = 0;
                                        }
                                        if ($comment->comment_approved != '0') { ?>
                                            <a href="#comment-<?php comment_ID() ?>" title="">#<?php echo ++$commentcount ?></a>
            <?php						} ?>
                                    </div>
            <?php				} ?>
                            </div>
                            <div class="comment">
        <?php					comment_text() ?>
                            </div>
                        </li>
	<?php			} else { ?>
                        <!-- COMMENT -->
                        <li class="<?php $author_info = get_userdata($comment->user_id);
                            if($author_info->user_level == 10) echo "authcomment";
                            echo " " . $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
                            <div class="avatar">
                                <a href="http://gravatar.com"><?php	echo get_avatar($comment,'36','',false ); ?></a>
                            </div>
                            <div class="info">
                                <div class="commentmeta">
                                    <span class="author_comment"><?php comment_author_link() ?></span>
                                    <span class="date"><?php comment_date(__('F jS, Y','splix'));?></span>
                                    <span class="time"><?php comment_time(__('g:i a','splix')); ?></span>
        <?php						if ($comment->comment_approved != '0') { ?>
                                        <span class="reply"><a href="javascript:void(0);" onclick="reply('<?php comment_ID() ?>','<?php comment_author() ?>');"><?php _e('Reply','splix') ?></a></span>
        <?php 						}
                                    edit_comment_link(__('Edit','splix'),'<span class="comment_edit">','</span>'); ?>
                                </div>
    <?php						if ($comment->comment_approved == '0') { ?>
                                    <div class="mods"><?php _e('Not<br/>approved<br/>yet','splix'); ?></div>
    <?php						}else{ ?>
                                    <div class="id">
            <?php						global $commentcount;
                                        if(!$commentcount) {
                                            $commentcount = 0;
                                        }
                                        if ($comment->comment_approved != '0') { ?>
                                            <a href="#comment-<?php comment_ID() ?>" title="">#<?php echo ++$commentcount ?></a>
            <?php						} ?>
                                    </div>
            <?php				} ?>
                            </div>
                            <div class="comment">
        <?php					comment_text() ?>
                            </div>
                        </li>
    <?php			}
					/* Changes every other comment to a different class */	
                    if ('alt' == $oddcomment) $oddcomment = '';
                    else $oddcomment = 'alt'; ?>
        
    <?php		} /* end for each comment */ ?>
        
            </ol>
<?php	} else { // this is displayed if there are no comments so far ?>
	<?php	if (comments_open()) { ?> 
			<!-- If comments are open, but there are no comments. -->
            <div class="msgbox"><?php _e('No comments yet.','splix') ?></div>
	<?php	} else { // comments are closed ?>
				<!-- If comments are closed. -->
				<div class="msgbox"><?php _e('Comments are closed.','splix'); ?></div>
	<?php 	} ?>
<?php	} ?>
	</div>


<?php	if (comments_open()) { ?>

            <h3 class="noonemore"><?php _e('Leave a comment', 'splix'); ?></h3>
            
<?php		if ( get_option('comment_registration') && !$user_ID ) { ?>
                <div class="msgbox"><?php echo __('You must be','splix') . " <a href='" . get_option('siteurl') . "/wp-login.php?redirect_to=" . urlencode(get_permalink()) . "'>" . __('logged in','splix') . "</a> " . __('to post a comment.','splix'); ?></div>
<?php 		} else { ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"> 
                	<a href="" id="respond"></a>
<?php				if ( $user_ID ) { ?>
        	        	<p><?php _e('Logged in as','splix'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.<span class="logout"><a href="<?php echo wp_logout_url('$index.php'); ?>"><?php _e('Logout', 'splix'); ?></a></span></p>
<?php				} else { ?>
                        <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
                        <label for="author"><small><?php _e('Name','splix'); ?> <?php if ($req) _e('(required)','splix'); ?></small></label></p>
                        
                        <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
                        <label for="email"><small><?php _e('Mail (will not be published)','splix'); ?> <?php if ($req) _e('(required)','splix'); ?></small></label></p>
                        
                        <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                        <label for="url"><small><?php _e('Website','splix'); ?></small></label></p>
                                         
<?php				} ?>
                 
                    <!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->
                    
                    <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
                    <div id="undercomment">
                    	<div class="left"><small style="font-weight:normal;"><?php _e('HTML enabled', 'splix'); ?></small></div>
				<?php	if (function_exists('highslide_emoticons')) { ?>
                            <div id="emoticon" class="right"><?php highslide_emoticons(); ?></div>
                <?php	} ?>
                	</div>
                    <input name="submit" type="submit" id="submit" value="<?php _e('Send','splix'); ?>" />
                    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                    
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
                
<?php		} // If registration required and not logged in ?>

<?php	} // if you delete this the sky will fall on your head ?>