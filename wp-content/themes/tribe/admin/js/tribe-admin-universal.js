jQuery(document).ready(function( $ )
{
	// on pages, comments should be turned off by default.
	$('body.post-type-page.post-new-php #commentstatusdiv input[type="checkbox"]').removeAttr('checked');

	/**
	 * Before they go off and update the theme, let's make sure that's actually
	 * what they want to do. 99% of the time folks will click continue, but it's
	 * nice to have this safeguard in place
	 */
	$('a.update-url').click(function()
	{
		if ( confirm("Updating Tribe will lose any core file customizations you have made (custom CSS and functions will continue to be preserved). Sure you want to continue? Click 'Cancel' to stop, or 'OK' to continue.") )
		{
			return true;
		}
		return false;
	});

	/**
	 * This conditional will return true when people click the "Upload favicon"
	 * button on the favicon page.
	 */
	if ( $('input[name="tribe-settings[favicon]"]', parent.document).length == 1 )
	{
		$('input[value="Insert into Post"]').val('Use This Image');
		$('.post_title,.image_alt,.post_excerpt,.post_content,.url,.align,.simage-size-item').hide();
	}

	$('#feature-box > div').first().addClass('first').find('.widget-top').click(function()
	{
		if ( $(this).closest('.first').is('.visible') )
		{
			$(this).closest('.first').removeClass('visible');
		}
		else
		{
			$(this).closest('.first').addClass('visible');
		}
	});


	$('.upload-feature-image').live('click', function()
	{
		var current_widget = $(this).closest('.widget');

		tb_show('Choose FeatureBox Image', 'media-upload.php?type=image&TB_iframe=true&referer=favicon');
		window.send_to_editor = function (html1)
		{
			var html = $('<div>' + html1 + '</div>').find('img');
   		var image_url = jQuery(html).attr('src');
 			$(current_widget).find('input.img').val( image_url );
			$(current_widget).find('img').attr('src', image_url);

   		//Hide media library popup.
   		tb_remove();
		};

		return false;
	});

	/* Feature Box Widget Toggle Fields Options */

	if($('#feature-box').length>0){
		function showMcListFieldOptions(){
			$('.mc-list-fields-options').hide();
			$('.mc-list-fields-options-' + $('#feature-box .mailchimp-select').val()).show();
		}

		showMcListFieldOptions();

		$('#feature-box').on('change','.mailchimp-select',function(){
			showMcListFieldOptions();
		});

		$(document).ajaxSuccess(function(e, xhr, settings) {
			showMcListFieldOptions();
		});
	}

	/* Squeeze Page Toggle Field Options */
	showToggleField();

	$('#_tribe_newsletter_list').on('change',function(){
		showToggleField();
	})

	function showToggleField(){
		$('#cmb2-metabox-mailchimp_newsletter_list_metabox .cmb-type-multicheck').hide();
		$('.cmb2-id--tribe-newsletter-list-fields-' + $('#_tribe_newsletter_list').val()).show();
	}
});