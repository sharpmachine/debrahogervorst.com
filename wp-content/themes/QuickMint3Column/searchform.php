<?php
	//	To have styled form elements, please add class FormInputs for inputboxes and FormButton for buttons
?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" size="15" />
<input type="image" src="<?php echo get_bloginfo(template_directory); ?>/i/search.gif" id="searchsubmit" value="Go" />
</form>