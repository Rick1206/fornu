// JavaScript Document
//########################all the module js is here###########################//
/**
 * this file is to deal with all post data for module applications 
 * ============================================================================ * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 * $Id: module.js  
*/	

$(document).ready(function(){



		var curr_width  = $(document).width();
		//to count msg width
		var show_msg_width = $('#show_msg').width();
		var curr_width_now	= (curr_width-show_msg_width)/2;
		$('#show_msg').css({
						   	left: curr_width_now
						   })
		
		$('.from_submit').each(function(e){
			
			$(this).click(function(e){
								   
				
			
			
			});
								   
	
		
		});

/*		$('#full_frame').css({display:'block'});
		$('#show_msg').css({display:'block'}).animate({
			top:200											  
		});*/
		
							
		

 

	
});////jquery document end 

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

