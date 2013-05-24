// JavaScript Document
jQuery(document).ready(function($){
	//Inizializza ogni anteprima dei colori
	$("div[class*='showcolor']").css(
		{
			background: "#FFFFFF",
			border: "1px solid #aaa",
			margin: "1px 0px 0px",
			width: "18px",
			height: "20px",
			clear: "right",
			float: "left"
		}
	);
	
	$("input[name*='color']").css( {color: '#555555'} );
	
	//Aggiorna dinamicamente le anteprime dei colori
	$("input[name*='color']").blur( function()
		{
			if ($(this).val() != '') temp_color = "#" + $(this).val();
			else
			{
				temp_color = "#FFFFFF";
			}
			$(this).prev().animate(	{backgroundColor: temp_color}, 1000 );
		} ).blur();
	
	//Disattiva i colori della userbar se questa è disattivata
	$("input[name='show_userbar']").change(
		function() {
			if ($("input[name='show_userbar']").attr('checked')) {
				$("#color_ub").animate( {opacity: 1.0}, 'slow',
					function() { $("input[name*='color_ub']").removeAttr("readonly"); }
				);
			} else {
				$("#color_ub").animate( {opacity: 0.3}, 'slow',
					function() { $("input[name*='color_ub']").attr("readonly", true); }
				);
			}
		}
	).change();
	
	//Disattiva i colori del titolo e della descrizione del blog se questi sono disattivati
	$(".jq_titdesc").change(
		function() {
			if ($("input[name='show_title']").attr('checked') && $("input[name='show_description']").attr('checked')) {
				$("#color_titdesc").animate( {opacity: 1.0}, 'slow',
					function() {
						$("input[name*='color_title']").removeAttr("readonly");
						$("input[name*='color_description']").removeAttr("readonly");
					}
				);
			} else if (!$("input[name='show_title']").attr('checked') && !$("input[name='show_description']").attr('checked')) {
				$("#color_titdesc").animate( {opacity: 0.3}, 'slow',
					function() {
						$("input[name*='color_title']").attr("readonly", true);
						$("input[name*='color_description']").attr("readonly", true);
					}
				);
			}
		}
	).change();
	
	//Disattiva i colori dei menu se questi sono disattivati
	$("input[name='menu_show_pages']").change(
		function() {
			if ($("input[name='menu_show_pages']").attr('checked')) {
				$("#color_pg").animate( {opacity: 1.0}, 'slow',
					function() { $("input[name*='color_pg']").removeAttr("readonly"); }
				);
			} else {
				$("#color_pg").animate( {opacity: 0.3}, 'slow',
					function() { $("input[name*='color_pg']").attr("readonly", true); }
				);
			}
		}
	).change();
	
	$("input[name='menu_show_categories']").change(
		function() {
			if ($("input[name='menu_show_categories']").attr('checked')) {
				$("#color_cat").animate( {opacity: 1.0}, 'slow',
					function() { $("input[name*='color_cat']").removeAttr("readonly"); }
				);
			} else {
				$("#color_cat").animate( {opacity: 0.3}, 'slow',
					function() { $("input[name*='color_cat']").attr("readonly", true); }
				);
			}
		}
	).change();
});

function ApplyStyle(ctitle, cdesc, cub1, cub2, cub3, bg1, bg2, cpg1, cpg2, cat1, cat2, c4, c5, c6, cbg1, cbg2, ctext) {
	document.getElementsByName('color_title')[0].value = ctitle;
	document.getElementsByName('color_title')[0].focus();
	document.getElementsByName('color_description')[0].value = cdesc;
	document.getElementsByName('color_description')[0].focus();
	
	document.getElementsByName('color5')[0].value = c5;
	document.getElementsByName('color5')[0].focus();
	document.getElementsByName('color6')[0].value = c6;
	document.getElementsByName('color6')[0].focus();
	
	document.getElementsByName('color_ub1')[0].value = cub1;
	document.getElementsByName('color_ub1')[0].focus();
	document.getElementsByName('color_ub2')[0].value = cub2;
	document.getElementsByName('color_ub2')[0].focus();
	document.getElementsByName('color_ub3')[0].value = cub3;
	document.getElementsByName('color_ub3')[0].focus();
	
	document.getElementsByName('color_bg1')[0].value = bg1;
	document.getElementsByName('color_bg1')[0].focus();
	document.getElementsByName('color_bg2')[0].value = bg2;
	document.getElementsByName('color_bg2')[0].focus();
	
	document.getElementsByName('color_pg1')[0].value = cpg1;
	document.getElementsByName('color_pg1')[0].focus();
	document.getElementsByName('color_pg2')[0].value = cpg2;
	document.getElementsByName('color_pg2')[0].focus();
	
	document.getElementsByName('color_cat1')[0].value = cat1;
	document.getElementsByName('color_cat1')[0].focus();
	document.getElementsByName('color_cat2')[0].value = cat2;
	document.getElementsByName('color_cat2')[0].focus();
	
	document.getElementsByName('color4')[0].value = c4;
	document.getElementsByName('color4')[0].focus();
	
	document.getElementsByName('color_cbg1')[0].value = cbg1;
	document.getElementsByName('color_cbg1')[0].focus();
	document.getElementsByName('color_cbg2')[0].value = cbg2;
	document.getElementsByName('color_cbg2')[0].focus();
	document.getElementsByName('color_text')[0].value = ctext;
	document.getElementsByName('color_text')[0].focus();
	document.getElementsByName('color_text')[0].blur();
}

function updateColor(color, kRed, kGreen, kBlue) {
	red = parseInt(color.substring(0, 1), 16) + kRed;
	green = parseInt(color.substring(2, 3), 16) + kGreen;
	blue = parseInt(color.substring(4, 5), 16) + kBlue;
	
	if (red > 255) red = 255;
	else if (red < 0) red = 0;
	
	if (green > 255) green = 255;
	else if (green < 0) green = 0;
	
	if (blue > 255) blue = 255;
	else if (blue < 0) blue = 0;
	
	return red.toString(16) + green.toString(16) + blue.toString(16);
}