jQuery(document).ready(function( $ )
{
	$('a.more-link').closest('p').addClass('center-me');

  $('blockquote').each(function() {
    if ( $(this).outerHeight() < 80 )
    {
      $(this).addClass('one-liner');
    }
  });

	if ( $('.pagination').length < 1 )
	{
		$('.archive .post').last().addClass('last');
	}

	$('textarea').autosize().tabby();

	function resize_header_height()
	{
		if ( $('body').is('.tribe_logo') )
		{
			var new_height = Math.ceil( $('input[name="logo-height"]').val() / $('input[name="logo-width"]').val() * $('header a').width() );
			$('header a').css('height', new_height + 'px' );
		}
	}

	function adjust_DOM_for_sticky_bar()
	{
		/**
	 	 * Making it so that the sticky bar is not underneath the #wpadminbar
		 * in the Z direction, but that it *is* underneath it in the Y
		 * direction instead.
		 */
		 var height = 0;
		if ( $('#wpadminbar').length > 0 && $('.sticky-bar .widget').length > 0 )
		{
			var outerHeight = $('#wpadminbar').outerHeight();
			$('.sticky-bar').css('top', outerHeight);
			height += outerHeight;
		}

		if ( $('.sticky-bar .widget').length > 0 )
		{
			height = $('.sticky-bar .widget').outerHeight();
			$('.sticky-bar-wrap').css('padding-bottom', height );
		}
	}

	function mobile_nav()
	{
		if ( $(window).width() < 960 )
		{
			$('.navigation').each(function()
			{
				if ( ! $(this).is( '.mobile' ) )
				{
					$(this).prepend('<div class="toggle-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>');
					$(this).find('ul').hide();
					//$(this).append('<div class="clear"></div>');
					$(this).addClass('mobile');

				}
			});
		}
		else
		{
			$('.navigation').each(function()
			{
				$(this).find('ul').show();
				$(this).find('.toggle-bar').remove();
				$(this).removeClass('mobile');
			});
		}
	}

	$(window).resize(function()
	{
		adjust_DOM_for_sticky_bar()
		resize_header_height();
		mobile_nav();
		//accommodate_wpadminbar()
	});
	resize_header_height();
	mobile_nav();
	adjust_DOM_for_sticky_bar();
	//accommodate_wpadminbar();

	$('.toggle-bar').live('click', function()
	{
		if ( $(this).closest('.navigation').is('.toggled') )
		{
			$(this).closest('.navigation').removeClass('toggled');
			$(this).closest('.navigation').find('.menu').hide();
		}
		else
		{
			$(this).closest('.navigation').find('.menu').fadeIn('slow');
			$(this).closest('.navigation').addClass('toggled');
		}
	});

	$('.ajax-submit').on('submit',function(e){
		e.preventDefault();
		var form = $(e.target);
		var success = true;
		form.find('input').removeClass('error');
		form.find('input').each(function(){
			if ($(this).val()==''){
				$(this).addClass('error');
				success = false;
			}
		});
		if (success){
			$.post( form.attr('action'), form.serialize(), function(response){
				response = JSON.parse(response);
				form.find('.inside').hide();
				form.find('.response-message').html(response.message);
			});
		}
	});
});
