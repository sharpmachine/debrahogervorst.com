jQuery(document).ready(function( $ )
{
	var families_served = [];
	function family_has_been_served( family )
	{
		return $.inArray( family, families_served ) == -1 ? false : true;
	}

	function check_for_custom_selection( val, type )
	{
		if ( val == "Custom" )
		{
			$('.fake.' + type + '-font-family').removeAttr('disabled');
			$('.fake.' + type + '-font-family').show('slow');

			// Weird this only works with a timeout. Hmm.
			setTimeout(function() {
				$('.fake.' + type + '-font-family').focus();
			}, 200 );

		}
		else
		{
			$('.fake.' + type + '-font-family').attr('disabled', 'disabled');
			$('.fake.' + type + '-font-family').hide('slow');
		}
	}

	function update_family( type, div, family, size, weight )
	{
		if ( type == 'headline' )
		{
			var line_height = Math.round( size * 1.1 );
		}
		else if ( type == 'body' )
		{
			var line_height = Math.round( size * 1.625 );
		}

		if ( ! family_has_been_served( family ) )
		{
			// Check to see if the font is a Google font
			if ( family == 'ABeeZee' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=ABeeZee:400,400italic' rel='stylesheet' type='text/css'>");
			}

			else if ( family == 'Bree Serif' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Cabin' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Cabin:400,700,400italic,700italic' rel='stylesheet' type='text/css'>'");
			}
			else if ( family == 'Cabin Sketch' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:400,700' rel='stylesheet' type='text/css'>'");
			}

			else if ( family == 'Crimson Text' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Crimson+Text:400,700,400italic' rel='stylesheet' type='text/css'>'");
			}

			else if ( family == 'Droid Sans' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Lobster' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Lora' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>");
			}

			else if ( family == 'Merriweather' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Merriweather:400,700,400italic' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Monda' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Oxygen' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Playfair Display' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Roboto' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,700italic,400italic' rel='stylesheet' type='text/css'>");
			}

			else if ( family == 'Ubuntu' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic' rel='stylesheet' type='text/css'>");
			}
			else if ( family == 'Vollkorn' )
			{
				$('head').append("<link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700' rel='stylesheet' type='text/css'>");
			}
			/**
			 * Update our array so we know we've now served this family
			 * to the DOM
			*/
			families_served[ families_served.length] = family;
		}

		$(div).css({
			'font-family': family,
			'font-weight': weight,
			'font-size': size + 'px',
			'line-height': line_height + 'px'
		});
		$('textarea').autosize();
	}

	$('.tribe-font-selects.headlines select').change(function()
	{
		update_family( 'headline', $(this).closest('td').find('.tribe-preview.headline-font'), $('#headline-font-family').val(), $('#headline-font-size').val(), $('#headline-font-weight').val() );
		check_for_custom_selection( $("#headline-font-family option:selected").text(), 'headline' );
	});

	$('.tribe-font-selects.body select').change(function()
	{
		update_family( 'body', $('.tribe-preview.body-font'), $('#body-font-family').val(), $('#body-font-size').val(), 'normal' );
		check_for_custom_selection( $("#body-font-family option:selected").text(), 'body' );
	});

	update_family( 'headline', $('.tribe-preview.headline-font'), $('#headline-font-family').val(), $('#headline-font-size').val(), $('#headline-font-weight').val() );

	update_family( 'body', $('.tribe-preview.body-font'), $('#body-font-family').val(), $('#body-font-size').val(), 'normal' );


	$('a.toggle').click(function()
	{
		var toggle = $(this).closest('p').find('.hidden');
		if ( $(toggle).is('.hiding') )
		{
			$(toggle).removeClass('hiding').fadeIn('slow');
		}
		else
		{
			$(toggle).addClass('hiding').hide();
		}
		return false;
	});


	$('#archive_pages_show').change(function()
	{
		if ( $(this).val() == 'excerpt' )
		{
			$('.excerpt-limit-wrap').fadeIn('slow');
		}
		else
		{
			$('.excerpt-limit-wrap').hide();
		}
	});


	/**
	 * Handles the logo uploading
	 */
	$('.logo-upload-button').click(function()
	{
		tb_show('Choose Logo Image', 'media-upload.php?type=image&TB_iframe=true&referer=logo');
		window.send_to_editor = function(html1)
		{
			/**
			 * @html1 is typeof string.
			 * In some installations of WordPress, the html1 will have
			 * a surrounding anchor element, in which .find('img') would work
			 * on it. In other installations, it will not have a surrounding
			 * anchor, and since .find() is not inclusive of current node,
			 * we create a surrounding node (<div> in this case) so that
			 * .find() works every time. Redneck but works.
			 */
			var html = $('<div>' + html1 + '</div>').find('img');
   		var image_url = $(html).attr('src');
 			$('input[name="tribe-settings[logo]"]').val( image_url );
			$('img.logo').attr('src', image_url);
			update_dimensions( $(html).attr('width'), $(html).attr('height') );
   		tb_remove();
		};
		return false;
	});

	$('input[name="tribe-settings[logo]"]').change(function()
	{
		$('img.logo').attr('src', $(this).val() );
		/**
		 * They're pasting in an external resource, so we need to use
		 * our own Ajax to grab the image dimensions in this case
		 */
		$("<img/>").attr( "src", $(this).val() ).load(function()
		{
			s = {w:this.width, h:this.height};
			update_dimensions( s.w, s.h );
		});
	});

	function update_dimensions( width, height )
	{
		$('input[name="tribe-settings[logo-width]"]').val( width );
		$('input[name="tribe-settings[logo-height]"]').val( height );
	}


	/**
	 * These next 3 functions handle the favicon uploading
	 */
	function is_valid_favicon( file )
	{
		if( ['png', 'jpg', 'jpeg', 'gif', 'ico'].indexOf( file.split('.').pop().toLowerCase()) !== -1 )
		{
			$('input[name="sanitized_favicon"]').val( file );
			return true;
		}
		else
		{
			if ( file === "" )
			{
				alert( 'Favicon field must not be empty' );
				return false;
			}
			alert('Please only select a file of the following types: png, jpg, gif, ico');
			return false;
		}
	}

	/**
	 * This function complements of
	 * http://www.kylethielk.com/blog/wordpress-plugin-development-using-media-library/
	 */
	$('.favicon-upload-button').click(function()
	{
		tb_show('Choose Favicon Image', 'media-upload.php?type=image&TB_iframe=true&referer=favicon');
		window.send_to_editor = function(html1)
		{
			var html = $('<div>' + html1 + '</div>').find('img');
   		var image_url = jQuery(html).attr('src');
			if ( is_valid_favicon( image_url ) )
			{
 				$('input[name="tribe-settings[favicon]"]').val( image_url );
				$('img.favicon').attr('src', image_url);
			}
   		//Hide media library popup.
   		tb_remove();
		};
		return false;
	});

	$('input[name="tribe-settings[favicon]"]').change(function()
	{
		if ( is_valid_favicon( $(this).val() ) )
		{
			$('img.favicon').attr('src', $(this).val() );
		}
		else
		{
			$('input[name="tribe-settings[favicon]"]').val( $('input[name="sanitized_favicon"]').val() );
		}
	});








	/**
	 * Really wish I could get this working... way cooler than the method above.
	 * WordPress needs to make the new Media Upload manager more user friendly.
	 * Idea taken from http://www.blazersix.com/blog/wordpress-image-widget/
	 *
	mediaControl = {
		// Initializes a new media manager or returns an existing frame.
		// @see wp.media.featuredImage.frame()
		frame: function() {
			if ( this._frame )
				return this._frame;

			this._frame = wp.media({
				title: 'Frame Title',
				library: {
					type: 'image'
				},
				button: {
					text: 'Button Text'
				},
				multiple: false
			});

			this._frame.on( 'open', this.updateFrame ).state('library').on( 'select', this.select );

			return this._frame;
		},

		select: function() {
			// Do something when the "update" button is clicked after a selection is made.
		},

		updateFrame: function() {
			// Do something when the media frame is opened.
		},

		init: function() {
			$('#wpbody').on('click', '.favicon-upload-button', function(e) {
				e.preventDefault();

				mediaControl.frame().open();
			});
		}
	};

	mediaControl.init();
	*/

	function tribe_hide_logo_dimensions( speed )
	{
		$('input[name="tribe-settings[logo-width]"]').closest('tr').hide( speed );
		$('input[name="tribe-settings[logo-height]"]').closest('tr').hide( speed );
	}

	function tribe_show_logo_dimensions( speed )
	{
		$('input[name="tribe-settings[logo-width]"]').closest('tr').show( speed );
		$('input[name="tribe-settings[logo-height]"]').closest('tr').show( speed );
	}

	if ( $('select[name="tribe-settings[header-contains]"]').val() == 'text' )
	{
		tribe_hide_logo_dimensions( 0 );
	}

	$('select[name="tribe-settings[header-contains]"]').change(function()
	{
		if ( $(this).val() == 'text' )
		{
			tribe_hide_logo_dimensions( 50 );
		}
		else
		{
			tribe_show_logo_dimensions( 500 );
		}
	});

	function tribe_hide_mailchimp_integration( speed )
	{
		$('input[name="tribe-settings[mailchimp-api-key]"]').val('');
		$('input[name="tribe-settings[mailchimp-api-key]"]').closest('tr').hide( speed );
	}

	function tribe_show_mailchimp_integration( speed )
	{
		$('input[name="tribe-settings[mailchimp-api-key]"]').closest('tr').show( speed );
	}

	if ( $('select[name="tribe-settings[external-service]"]').val() == '' )
	{
		tribe_hide_mailchimp_integration( 0 );
	}

	$('select[name="tribe-settings[external-service]"]').change(function()
	{
		if ( $(this).val() == '' )
		{
			tribe_hide_mailchimp_integration( 50 );
		}
		else
		{
			tribe_show_mailchimp_integration( 500 );
		}
	});

	$('.color').wpColorPicker();

	$('.export-import a.delete').click(function()
	{
		var yes = window.confirm("This is a permanent action! Sure you want to delete this design?");
		return yes;
	});
	$('textarea').autosize();
	$('textarea').tabby();

	$('input[name="reset"]').click(function()
	{
		// If they are disabling their license, then
		// resetting their stuff should mean nothing.
		// And so they don't get double alerts messages,
		// make sure that they aren't disabling their
		// license before executing anything.
		if ( ! $('#disable-license:checked').length > 0 )
		{
			var yes = window.confirm("Do you seriously want to restore all Tribe settings, including custom CSS and functions? This cannot be undone.");
			if (yes === true)
			{
				$('input[type="hidden"][name="tribe-settings[reset]"]').val('true');
			}
			else
			{
				return false;
			}
		}
	});

	$('#tribe_settings_form').submit(function()
	{
		if ( $('#disable-license:checked').length > 0 )
		{
			var yes = window.confirm("Disabling your license will cause all your customizations for this site to be lost. We strongly recommend you have a backup of your stuff before doing this. Are you sure you want to continue?");
			return yes;
		}
	});
});

/*
 * This next block compliments of
 * http://wp.tutsplus.com/tutorials/theme-development/adding-a-custom-css-editor-to-your-theme-using-ace/
 */
( function( global, $ ) {
	if ( $( '#custom_css_textarea' ).length > 0 )
	{
    var editor,
        syncCSS = function() {
            $( '#custom_css_textarea' ).val( editor.getSession().getValue() );
        },
        loadAce = function() {
            editor = ace.edit( 'custom_css' );
            global.safecss_editor = editor;
            editor.getSession().setUseWrapMode( true );
            editor.setShowPrintMargin( false );
            editor.getSession().setValue( $( '#custom_css_textarea' ).val() );
            editor.getSession().setMode( "ace/mode/css" );
            jQuery.fn.spin&&$( '#custom_css_container' ).spin( false );
            $( '#custom_css_form' ).submit( syncCSS );
        };
    if ( $.browser.msie&&parseInt( $.browser.version, 10 ) <= 7 ) {
        $( '#custom_css_container' ).hide();
        $( '#custom_css_textarea' ).show();
        return false;
    } else {
        $( global ).load( loadAce );
    }
    global.aceSyncCSS = syncCSS;
	}
} )( this, jQuery );

( function( global, $ ) {
	if ( $( '#custom_php_textarea' ).length > 0 )
 	{
	var editor,
		syncphp = function() {
			$( '#custom_php_textarea' ).val( editor.getSession().getValue() );
		},
		loadAce = function() {
			editor = ace.edit( 'custom_php' );
			global.safephp_editor = editor;
			editor.getSession().setUseWrapMode( true );
			editor.setShowPrintMargin( false );
			editor.getSession().setValue( $( '#custom_php_textarea' ).val() );
			editor.getSession().setMode("ace/mode/php");
			jQuery.fn.spin&&$( '#custom_php_container' ).spin( false );
			$( '#custom_php_form' ).submit( syncphp );
		};
	if ( $.browser.msie&&parseInt( $.browser.version, 10 ) <= 7 ) {
		$( '#custom_php_container' ).hide();
		$( '#custom_php_textarea' ).show();
		return false;
	} else {
		$( global ).load( loadAce );
	}
	global.aceSyncphp = syncphp;
	}
} )( this, jQuery );

