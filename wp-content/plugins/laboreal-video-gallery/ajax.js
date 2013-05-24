/* Adiciona novos campos para vídeos ao clicar no botão "+" */
var counter = 1;
function addInput(divName){
	var newdiv = document.createElement('div');
	newdiv.innerHTML = "<b>Video #" + (counter + 1) + "</b> <input type='text' name='url[]'>";
	document.getElementById(divName).appendChild(newdiv);
	counter++;
}

/* Adiciona uma nova galeria no banco de dados */
function new_gallery() {
	var gallery = $(document.getElementsByName('gallery'));
	if (gallery.val() == '') { } else {
		var add = $.ajax({
			type: "POST",
			url: "../wp-content/plugins/laboreal-video-gallery/ajax.php",
			data: "gallery=" + gallery.val(),
			beforeSend: function() {
				$("#create_new_gallery").hide();
				$("#load_new_gallery").fadeIn('slow');
			},
			success: function(txt) {
				valor = txt.split('@');
				$('#list_galleries').prepend('<li><label><input type="checkbox" name="gallery_del[]" value='+valor[0]+' /> '+gallery.val()+' (0)</label></li>').fadeIn('slow');
				$('#galleries_select_list').fadeIn().append('<option value='+valor[1]+'>'+gallery.val()+'</option>');
				gallery.val('');
				$("#load_new_gallery").hide();
				$("#create_new_gallery").fadeIn('slow');
			}
		});
	}
}

/* Adiciona um novo vídeo no banco de dados */
function new_video() {
	var url = $(document.getElementsByName('url'));
	var parent = $(document.getElementsByName('parent'));
	var description = $(document.getElementsByName('description'));
	if (url.val() == '' || parent.val() == '') { } else {
		var add = $.ajax({
			type: "POST",
			url: "../wp-content/plugins/laboreal-video-gallery/ajax.php",
			data: "url=" + url.val() + "&parent=" + parent.val() + "&description=" + description.val(),
			beforeSend: function() {
				$("#add_new_video").hide();
				$("#load_new_video").fadeIn('slow');
			},
			success: function() {
				$('#show_all_videos').load('../wp-content/plugins/laboreal-video-gallery/load_videos.php').fadeIn();
				url.val('');
				parent.val('');
				description.val('');
				$("#load_new_video").hide();
				$("#add_new_video").fadeIn('slow');
			}
		});
		
	}
}