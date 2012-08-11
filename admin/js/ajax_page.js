
//初始化AJAX配置
function InitAjax() 
{
	var ajax=false;
	try {
		ajax = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			ajax = false;
		}
	}
	if (!ajax && typeof XMLHttpRequest!='undefined') {
		ajax = new XMLHttpRequest();
	}
	return ajax;
}

var ajax = InitAjax();

//post param to php file for change the values 
function changeStatus(elementid,change_type,module){ 
	var element =  document.getElementById(elementid);
	var action = document.getElementById("actionurl"); 
	var url = action.value+"?change_type="+ change_type + "&id="+ elementid +"&action="+ module + "&time=" + Math.round(Math.random()*10000);
	//alert(url);
	ajax.open("GET",url,true);
	ajax.onreadystatechange = function()
	{
	    if(ajax.readyState == 1)
		{
			document.getElementById(elementid).innerHTML ="<img src='./images/28-0.gif' width='14' height='14' / >";
		}
		if(ajax.readyState==4 && ajax.status==200)
		{
			if(ajax.responseText == 1)
			{
				if(change_type == 1){
					element.innerHTML='<a href="javascript:changeStatus('+ elementid +',2,'+ module +')"><img  src="./images/yes.gif" border="0" /></a>';
			    	//window.location.replace(location.href);					 
				}
				if(change_type == 2)
				{
					element.innerHTML='<a href="javascript:changeStatus('+ elementid +',1,'+ module +')"><img  src="./images/no.gif" border="0" /></a>';
			    	//window.location.replace(location.href);					
				}
			}	
		}	
	}	
	ajax.send(null);
}

