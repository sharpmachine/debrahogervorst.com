<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$did = isset($_GET['did']) ? $_GET['did'] : '0';
if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }

// First check if ID exist with requested ID
$sSql = $wpdb->prepare(
	"SELECT COUNT(*) AS `count` FROM ".WP_G_YWFZ_TABLE."
	WHERE `ywfz_id` = %d",
	array($did)
);
$result = '0';
$result = $wpdb->get_var($sSql);

if ($result != '1')
{
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'youtube-with-fancy-zoom'); ?></strong></p></div><?php
}
else
{
	$ywfz_errors = array();
	$ywfz_success = '';
	$ywfz_error_found = FALSE;
	
	$sSql = $wpdb->prepare("
		SELECT *
		FROM `".WP_G_YWFZ_TABLE."`
		WHERE `ywfz_id` = %d
		LIMIT 1
		",
		array($did)
	);
	$data = array();
	$data = $wpdb->get_row($sSql, ARRAY_A);
	
	// Preset the form fields
	$form = array(
		'ywfz_title' => $data['ywfz_title'],
		'ywfz_watch' => $data['ywfz_watch'],
		'ywfz_code' => $data['ywfz_code'],
		'ywfz_img' => $data['ywfz_img'],
		'ywfz_size' => $data['ywfz_size'],
		'ywfz_imglink' => $data['ywfz_imglink'],
		'ywfz_status' => $data['ywfz_status'],
		'ywfz_sidebar' => $data['ywfz_sidebar'],
		'ywfz_expire' => $data['ywfz_expire'],
		'ywfz_id' => $data['ywfz_id']
	);
}
// Form submitted, check the data
if (isset($_POST['ywfz_form_submit']) && $_POST['ywfz_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('ywfz_form_edit');
	
	$form['ywfz_title'] = isset($_POST['ywfz_title']) ? $_POST['ywfz_title'] : '';
	if ($form['ywfz_title'] == '')
	{
		$ywfz_errors[] = __('Please enter the title', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}	
	$form['ywfz_watch'] = isset($_POST['ywfz_watch']) ? $_POST['ywfz_watch'] : '';
	if ($form['ywfz_watch'] == '')
	{
		$ywfz_errors[] = __('Please enter the video link.', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}
	$form['ywfz_code'] = isset($_POST['ywfz_code']) ? $_POST['ywfz_code'] : '';
	if ($form['ywfz_code'] == '')
	{
		$ywfz_errors[] = __('Please enter the video code.', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}
	$form['ywfz_img'] = isset($_POST['ywfz_img']) ? $_POST['ywfz_img'] : '';
	if ($form['ywfz_img'] == '')
	{
		$ywfz_errors[] = __('Please select the display image.', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}
	$form['ywfz_size'] = isset($_POST['ywfz_size']) ? $_POST['ywfz_size'] : '';
	$form['ywfz_imglink'] = isset($_POST['ywfz_imglink']) ? $_POST['ywfz_imglink'] : '';
	$form['ywfz_status'] = isset($_POST['ywfz_status']) ? $_POST['ywfz_status'] : '';
	if ($form['ywfz_status'] == '')
	{
		$ywfz_errors[] = __('Please select the display status.', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}
	$form['ywfz_sidebar'] = isset($_POST['ywfz_sidebar']) ? $_POST['ywfz_sidebar'] : '';
	if ($form['ywfz_sidebar'] == '')
	{
		$ywfz_errors[] = __('Please select the sidebar display.', 'youtube-with-fancy-zoom');
		$ywfz_error_found = TRUE;
	}
	//$form['ywfz_expire'] = isset($_POST['ywfz_expire']) ? $_POST['ywfz_expire'] : '';
	
	//	No errors found, we can add this Group to the table
	if ($ywfz_error_found == FALSE)
	{	
		$sSql = $wpdb->prepare(
				"UPDATE `".WP_G_YWFZ_TABLE."`
				SET `ywfz_title` = %s,
				`ywfz_watch` = %s,
				`ywfz_code` = %s,
				`ywfz_img` = %s,
				`ywfz_size` = %s,
				`ywfz_imglink` = %s,
				`ywfz_status` = %s,
				`ywfz_sidebar` = %s
				WHERE ywfz_id = %d
				LIMIT 1",
				array($form['ywfz_title'], $form['ywfz_watch'], $form['ywfz_code'], $form['ywfz_img'], 
						$form['ywfz_size'], $form['ywfz_imglink'], $form['ywfz_status'], $form['ywfz_sidebar'], $did)
			);
		$wpdb->query($sSql);
		
		$ywfz_success = __('Details was successfully updated.', 'youtube-with-fancy-zoom');
	}
}

if ($ywfz_error_found == TRUE && isset($ywfz_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $ywfz_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($ywfz_error_found == FALSE && strlen($ywfz_success) > 0)
{
	?>
	<div class="updated fade">
		<p><strong><?php echo $ywfz_success; ?> 
		<a href="<?php echo WP_G_YWFZ_ADMIN_URL; ?>"><?php _e('Click here to view the details', 'youtube-with-fancy-zoom'); ?></a></strong></p>
	</div>
	<?php
}
?>
<script language="JavaScript" src="<?php echo WP_G_YWFZ_PLUGIN_URL; ?>/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('Youtube with fancy zoom', 'youtube-with-fancy-zoom'); ?></h2>
	<form name="ywfz_form" method="post" action="#" onsubmit="return ywfz_submit()"  >
      <h3><?php _e('Update Details', 'youtube-with-fancy-zoom'); ?></h3>
	  
	  	<label for="tag-title"><?php _e('Title:', 'youtube-with-fancy-zoom'); ?></label>
		<input name="ywfz_title" type="text" id="ywfz_title" value="<?php echo $form['ywfz_title']; ?>" size="50" maxlength="150" /></td>
		<p><?php _e('Please enter the title', 'youtube-with-fancy-zoom'); ?></p>
		
		<label for="tag-title"><?php _e('Youtube watch link:', 'youtube-with-fancy-zoom'); ?></label>
		<input name="ywfz_watch" type="text" id="ywfz_watch" value="<?php echo $form['ywfz_watch']; ?>" size="70" maxlength="1000" />
		<p><?php _e('Please enter the video link.', 'youtube-with-fancy-zoom'); ?> (Ex: http://www.youtube.com/watch?v=5TSPlykcdYk)</p>
		
		<label for="tag-title"><?php _e('Youtube code:', 'youtube-with-fancy-zoom'); ?></label>
		<input name="ywfz_code" type="text" id="ywfz_code" value="<?php echo $form['ywfz_code']; ?>"  size="30" maxlength="70" />
		<p><?php _e('If (http://www.youtube.com/watch?v=5TSPlykcdYk) this is your youtube video, then &ldquo;5TSPlykcdYk&rdquo; is your youtube code.', 'youtube-with-fancy-zoom'); ?></p>
		
		<label for="tag-title"><?php _e('Youtube thumbnail size:', 'youtube-with-fancy-zoom'); ?></label>
		<select name="ywfz_size" id="ywfz_size">
            <option value='0' <?php if($form['ywfz_size'] == '0') { echo "selected='selected'" ; } ?>>Big</option>
            <option value='1' <?php if($form['ywfz_size'] == '1') { echo "selected='selected'" ; } ?>>Small</option>
          </select>
		 <p><?php _e('Select thumbnail size.', 'youtube-with-fancy-zoom'); ?></p>
		 
		<label for="tag-title"><?php _e('Display Image:', 'youtube-with-fancy-zoom'); ?></label>
		<select name="ywfz_img" id="ywfz_img">
            <option value='Youtube Thumbnail' <?php if($form['ywfz_img'] == 'Youtube Thumbnail') { echo "selected='selected'" ; } ?>>Youtube Thumbnail</option>
			<option value='My Thumbnail' <?php if($form['ywfz_img'] == 'My Thumbnail') { echo "selected='selected'" ; } ?>>My Thumbnail</option>
         </select>
		 <p><?php _e('Which image you want to display?', 'youtube-with-fancy-zoom'); ?></p>
		 
		<label for="tag-title"><?php _e('Thumbnail Image link (My Thumbnail):', 'youtube-with-fancy-zoom'); ?></label>
		<input name="ywfz_imglink" type="text" id="ywfz_imglink" value="<?php echo $form['ywfz_imglink']; ?>"  size="70" maxlength="1000" />
		<p><?php _e('Please enter your image link.', 'youtube-with-fancy-zoom'); ?></p>
		 
		<label for="tag-title"><?php _e('Display Status:', 'youtube-with-fancy-zoom'); ?></label>
		<select name="ywfz_status" id="ywfz_status">
            <option value='Yes' <?php if($form['ywfz_status'] == 'Yes') { echo "selected='selected'" ; } ?>>Yes</option>
            <option value='No' <?php if($form['ywfz_status'] == 'No') { echo "selected='selected'" ; } ?>>No</option>
         </select>
		 <p><?php _e('Do you want the viceo to show in front end?', 'youtube-with-fancy-zoom'); ?></p>
		 
		<label for="tag-title"><?php _e('Sidebar Display:', 'youtube-with-fancy-zoom'); ?></label>
		<select name="ywfz_sidebar" id="ywfz_sidebar">
            <option value='Yes' <?php if($form['ywfz_sidebar'] == 'Yes') { echo "selected='selected'" ; } ?>>Yes</option>
            <option value='No' <?php if($form['ywfz_sidebar'] == 'No') { echo "selected='selected'" ; } ?>>No</option>
         </select>
		 <p><?php _e('Do you want the viceo to show in sidebar widget?', 'youtube-with-fancy-zoom'); ?></p>
	  	  
      <input name="ywfz_id" id="ywfz_id" type="hidden" value="<?php echo $form['ywfz_id']; ?>">
      <input type="hidden" name="ywfz_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Update Details', 'youtube-with-fancy-zoom'); ?>" type="submit" />&nbsp;
        <input name="publish" lang="publish" class="button add-new-h2" onclick="ywfz_redirect()" value="<?php _e('Cancel', 'youtube-with-fancy-zoom'); ?>" type="button" />&nbsp;
        <input name="Help" lang="publish" class="button add-new-h2" onclick="ywfz_help()" value="<?php _e('Help', 'youtube-with-fancy-zoom'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('ywfz_form_edit'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'youtube-with-fancy-zoom'); ?>
	<a target="_blank" href="<?php echo WP_G_YWFZ_FAV; ?>"><?php _e('click here', 'youtube-with-fancy-zoom'); ?></a>
</p>
</div>