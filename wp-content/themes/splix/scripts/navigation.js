jQuery(document).ready(function($){
	//Navigation
	$("ul[class*='nav']").ready(function(){
			$(this).find('li:has(ul)').find("a:first").addClass('more');
		});
	$("ul[class*='nav'] a").removeAttr("title");
	$("ul[class*='nav'] ul ").css({display: "none"}); // Opera Fix
	$("ul[class*='nav'] li:has(ul)").hover(function(){
			$(this).find('ul:first').show('fast');
		},function(){
			$(this).find('ul:first').hide('fast');
		});
	
//	//Info
//	$("span[class~='title']").animate(	{opacity: 0.8}, 'slow' );
//	$("span[class~='title']").hover(
//		function() {
//			$(this).animate(	{opacity: 1.0}, 'slow' );
//		}, function() {
//			$(this).animate(	{opacity: 0.8}, 'slow' );
//		}
//	);
});