$(function()
{

//regexp
var reg = {
	mobile:/^1[3|4|5|8][0-9]\d{8}$/,
	tel:/^(\d{3,4}\d{7,8})$/,
	emailstandard:/^[a-zA-Z0-9-._]+@[a-zA-Z0-9-._]+.[a-z]{2,3}$/,
	email:/@/,
	hostname:/^[a-zA-Z0-9-._]+.[a-z]{2,3}$/,
	hostnamefirst:/^[a-zA-Z0-9-._]+$/,
	empty:/^\S+$/,
	pass:/^.{6,18}$/,
	comparepass:function(){
			
	},
	numberextend:function(n,n2){
		if(n2 && n)
		{
			if(n && reg.number.test(n) && reg.number.test(n2))
			{
				var _reg = new RegExp("^\\d{"+n+","+n2+"}$");
				return _reg;
			}
		}
		else if(n)
		{
			if(n && reg.number.test(n))
			{
				var _reg = new RegExp("^\\d{"+n+"}$");
				return _reg;
			}	
		}else
		{
			return /^\d{1,}$/;
		}
	},
	nexdrule:/^[d]\d{1,}$/,
	nexdruleextend:/^[d]\d{1,}-\d{1,}$/,
	number:/^\d{1,}$/,
	birth:/^[1-2][0-9]\d{2}-(([0][1-9])|([1][0-2]))-([0-2][0-9])|([3][0-1])$/,
	year:/^[1-2][0-9]\d{2}$/,
	month:/^([0][1-9])|([1][0-2])$/,
	day:/^([0-2][0-9])|([3][0-1])$/,
	cnandnotnull:/^[\u4E00-\u9FA5\x00-\xff]+$/g,
	enandnotnull:/^[a-zA-Z]+$/,
	zipcode:/^[1-9][0-9]{5}$/,
	fnRegs:function($list){			
		var $list = $($list),len = $list.length,i=0,_temp="";
		for(;i<len;i++)
		{
			_temp = checkOne($list.eq(i));
			if(_temp != "ok")
			{
				return "wrong";
			}
		}
		return "ok";		
	},
	fnReg:function($obj){		
		var $this = $obj,tempreg = $this.attr("reg");
		
		if(reg.nexdrule.test(tempreg))
		{
			tempreg = reg.numberextend(parseInt(tempreg.replace("d","")));
		}else if(reg.nexdruleextend.test(tempreg))
		{
			tempreg = tempreg.replace("d","").split("-");
			tempreg = reg.numberextend(parseInt(tempreg[0]),parseInt(tempreg[1]));
		}else
		{ 
			tempreg = reg[$this.attr("reg")] || new RegExp();
		}
		var result = tempreg.test($this.val());
		if(result)
		{
			return "ok";	
		}
		else
		{
			return 2;	
		}
				
		
			
	}
};	


$("input[reg]").each(function(){
	var $this = $(this);				
	$this.addClass("wrong").focus(function(){
		var _dm = $this.attr('defaultMessage');
		if(_dm!="")
		{
			start.showTip($this,_dm);
		}
	}).blur(function(){	
		 checkOne($this);
	});
});

var start = {
	showTip:function(obj,_dm){
		$(obj).siblings("em").html(_dm);
	},
	closeTip:function(obj){
		$(obj).removeClass("wrong").siblings("em").html("");
	}
};

function checkOne($this){			
	  var _em = $this.attr('errorMessage');		  					
	  var _re = reg.fnReg($this);
	  
	  if(_re=="ok")
	  {
		  checkSpecial($this);
		    
	  }else{
		  if(_em!="")
		  {
			  start.showTip($this,_em);
		  }					
	  }
}

//检测所有
function check(obj){
	var $list = $(obj).find(".wrong");	
 	
	if($list.length<1){
	}else{
		
		for(var i=0,j=$list.length;i<j;i++)
		{		
			var _temp = reg.fnReg($list.eq(i));
			if(_temp != "ok"){
				start.showTip($list.eq(i),$list.eq(i).attr("errorMessage"));
				return false;
			}
			else
			{
				 checkSpecial($list.eq(i));
			}
		}
	}	
	return "ok";	
}


function checkSpecial($this){
	if($this.attr("unsamereg")!=undefined)
	  {
			if($this.val()!=$("#"+$this.attr("unsamereg")).val())
			{
				start.showTip($this,$this.attr("unsameMessage"));
				return;
			}
			else
			{
				start.closeTip($this); 	
			}
	  }else
	  { 		  
		start.closeTip($this); 
	  }	
}

function checkCheckBox()
{
	var $list = $("input[type='hidden']");
	for(var i=0,j=$list.length;i<j;i++)
	{		
		var $this = $list.eq(i);
		if($this.val()==""){
			$this.siblings("em").html("请选择");
			return false;
		}
		else
		{
			$this.siblings("em").html("");
		}
	}
	return "ok";
}


//提交动作
function submitForm(){
	$.ajax({
		type:'POST',
		url:'service_center.php',
		data:{type:'users',
		umobile:v("#mobile"),unickname:v("#nickname"),uemail:v("#email"),upsw:v("#password"),umname:v("#mumname"),
			  ulocation:v("#area"),uaddress:v("#address"),uphone:v("#phone1")+v("#phone2"),uzipcode:v("#zipcode"),
			  unow:v("#now"),umaga:v("#maga"),uactivity:v("#activity"),ucontact:v("#contact")
		},
		success:function(e){
				if(e=="1"){
					$.lightBox(".reg-success");
				}
				else{
					alert("Error!Try again!");						
				}
		}
	});	
}



//初始化
$("#step1 input,#step2 input").val("");

$("#btn_step_1").bind('click',function(){
	if(check("#step1")=="ok"){	
		$.ajax({
		type:'POST',
		url:'service_center.php',
		data:{type:'check',ucheckcode:v("#checkcode")
		},
		success:function(e){
				  if(e=="1"){
					  $("#step1").fadeOut(0);
						  $("#step2").fadeIn(0,function(){
						  $("#btn_step_2").bind('click',function(){
						  if(check("#step2")=="ok"){
							  if(checkCheckBox()=="ok"){
								  submitForm();
							  }	
						  }	
					  });	
				  });
				}
				else{
					$('#checkcode').siblings("em").html("验证码错误!");
					$(this).attr('src','showing.php');		
				}
		}
	});	
	}	
	else
	{
		return false;
	}
});

function v(id)
{
	return $(id).val();	
}

$("#checkImg").click(function(){
	//alert(3);
	$(this).attr('src','showing.php');
	});

});

