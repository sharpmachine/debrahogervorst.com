jQuery(document).ready(function($){
	function reply(commentid, authorstr){
		var str = "<a href='#comment-" + commentid + "'>@" + authorstr + "</a>\n" + $("textarea#comment").text();
		$("textarea#comment").text(str);
		$("textarea#comment").focus();
	};
	
	window['reply'] = reply;
});