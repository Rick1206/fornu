// JavaScript Document

// JavaScript Document
/**
 * to show module panel js
 * ============================================================================ * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
$(function(){
		   
		/*get all panel*/
		var totalPanels	 = $(".left_list").size();
		
		/*move distance (px)*/
		var movingDistance	    = 500;

        $('.left_list').each(function(){
      	
			$(this).click(function(){
					
					var id = $(this).attr("id");
					var iframe_id = "a"+id;
					if (window[iframe_id]) {
						window[iframe_id].location.reload();
					}
					var move_des = -(movingDistance * id);
					$("#right_mark").animate({

						top: move_des + "px"
					
					}, 800
					
					);	
		});


//to change move sub css
	$('.left_list').hover(
		function()
		{
			$(this).removeClass('left_list');
			$(this).addClass('left_list_hover');
		},
		function()
	    {
			$(this).removeClass('left_list_hover');
			$(this).addClass('left_list');
		}
	
	);
	});
})

//to change all delete checkbox stauts 
function checkall(form) 
{
	for(var i = 0;i < form.elements.length; i++) 
	{
		var e = form.elements[i];
		if (e.name != 'chkall' && e.disabled != true) 
		{
				e.checked = form.chkall.checked;
		}
	}
}

//to refresh page that the appliction run
function refurbish()
{
	
	window.location.href = window.location.href;
}


