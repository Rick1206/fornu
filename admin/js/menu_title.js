// JavaScript Document
/**
 * to show module panel js
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
$(function(){
		   
		/*left foot div center*/
/*		var screen_width	= 	$(document).width();
		var foot_width		=	$('#main_foot').width();
		var keep_center	= 	(screen_width - foot_width)/2;
		//alert(foot_width);
		$('#main_foot').css({left: keep_center});   */

		/*get all panel*/
		var totalPanels	 = $(".menu_title").size();		
		/*move distance (px)*/
		var movingDistance	    = 1003;
        $('.menu_title').each(function(){
			$(this).click(function(){		   
					var id = $(this).attr("id");
					var move_des = -(movingDistance * id);
					$("#mask").animate({
						left: move_des + "px"
					}, 1000);	
		    });
 	  	});
	  	//menu title
	  	$('.menu_title').hover(
			function()
			{
				$(this).removeClass('menu_title');
				$(this).addClass('menu_title_hover');
			},
			function()
			{
				$(this).removeClass('menu_title_hover');
				$(this).addClass('menu_title');
			}
	
	  	);		
})
