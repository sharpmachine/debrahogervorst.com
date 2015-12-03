<?php

/**
 * Template Name: Squeeze
 *
 */

 get_header();

 do_action('tribe_before_content');
 while ( have_posts() ) {
   the_post();
   $quotes = get_post_meta( get_the_id(), '_tribe_quotes_group', true );
   $boxColor = get_post_meta( get_the_id(), '_tribe_box_color', true );
   $twitterSrc = get_post_meta( get_the_ID(), '_tribe_twitter', true );
   $facebookSrc = get_post_meta( get_the_ID(), '_tribe_facebook', true );
   $googleSrc = get_post_meta( get_the_ID(), '_tribe_google', true );
   $mcListId = get_post_meta( get_the_ID(),'_tribe_newsletter_list',true);
   $mcFields = get_post_meta( get_the_ID(),'_tribe_newsletter_list_fields_' . $mcListId,true);
   $profilePhoto = get_post_meta( get_the_ID(), '_tribe_profile_photo', 1 );
   $showFirst = false;
   if ($mcFields!="" && in_array("FNAME",$mcFields)){
     $showFirst = true;
   }
   $showLast = false;
   if($mcFields!="" && in_array("LNAME",$mcFields)){
     $showLast = true;
   }
  ?>

<div class="squeeze-banner-wrap" style="background-color:<?php echo $boxColor; ?>">
  <div class="squeeze-inner-wrap">
    <img class="squeeze-avatar" src="<?php echo $profilePhoto ?>" width="300" />
    <div class="squeeze-info">
      <h1><?php the_title(); ?></h1>
      <?php
        echo tribe_mc_signup($mcListId,$showFirst,$showLast);
      ?>
      <?php the_content(); ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php if ($quotes!=""){ ?>
<div class="squeeze-quotes">
  <h3>What Others Are Saying</h3>
  <?php foreach ($quotes as $quote){ ?>
    <blockquote><em><?php echo $quote["quote"]; ?></em>
      <strong>—<?php echo $quote["quote_author"]; ?></strong>, <?php echo $quote["quote_author_title"]; ?></blockquote>
  <?php } ?>
</div>
<?php } ?>
<center>
  <a class="btn homepage" href="<?php if( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) );
else echo bloginfo('url');?>">Read the Blog</a>
</center>
<?php if ($twitterSrc!="" || $facebookSrc!="" || $googleSrc!=""){ ?>
<div class="squeeze-social-wrap">
  <?php if ($twitterSrc!=""){ ?>
    <a class="twitter" href="<?php echo $twitterSrc; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter.png" alt="" /></a>
  <?php } ?>
  <?php if ($facebookSrc!=""){ ?>
  <a class="facebook" href="<?php echo $facebookSrc; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook.png" alt="" /></a>
  <?php } ?>
  <?php if ($googleSrc!=""){ ?>
  <a class="google Plus" href="<?php echo $googleSrc; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/google plus.png" alt="" /></a>
  <?php } ?>
</div>
<?php } ?>
 <?php
 }
 do_action('tribe_after_content');

 get_footer();

?>