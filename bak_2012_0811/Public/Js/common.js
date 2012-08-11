$(function(){
	
/*fix outline*/	
$('a').focus(function(){this.blur();});


//$(".aboutus-content-panel").jScrollPane({dragMinHeight:29,dragMaxHeight:29,hidePanelBackground:true});
$(".news-content-panel").jScrollPane({dragMinHeight:178,dragMaxHeight:178,scrollbarWidth:13,hidePanelBackground:true});
$(".knowledge-inner-content-panel").eq(0).jScrollPane({dragMinHeight:124,dragMaxHeight:124,scrollbarWidth:13,hidePanelBackground:true});



/* menu */
var $showlist = $(".showmenu>div");
$(".u1 > a").hover(function(){
						 var _va = $(this).attr("show");
						 $showlist.eq(_va).slideDown(200).siblings().slideUp(200);
						 
						 if(_inter)
						{
							clearInterval(_inter);	
						}				
					 },function(){
						 _inter = setTimeout(function(){ hide(); },2000);
					 });

$showlist.hover(function(){
	clearInterval(_inter);	   
},function(){
	_inter = setTimeout(function(){ hide(); },2000);
});

	
function hide()
{
	$showlist.slideUp(200);		
}


/* menu end */





//aboutus list
$("#aboutus h2.inner-title").click(function(){
	var $this = $(this);
	$this.next("p").slideDown(200).siblings("p").slideUp(200);	
});


/* growing */
$("#grow-table li").click(function(){
	var i = $(this).index();
	$(this).addClass("on").siblings().removeClass("on");
	$("#grow-table-content li").eq(i).fadeIn(200).siblings().fadeOut(0);	
});



//knowledge list
$(".knowledge-list .title").click(function(){
	var $this = $(this);
	$this.addClass("on").next("p").slideDown(200).parents("li").siblings().find("p").slideUp(200).prev().removeClass("on");	
});

$(".knowledge-tag li").click(function(){
	var $this = $(this), _index = $this.index();
	$this.addClass("on").siblings().removeClass("on");	
	$("#knowledge-tag-content>div").eq(_index).show(0,function(){
		if(_index=="1" && !$(".knowledge-inner-content-panel").eq(1).hasClass(".isjp"))
		{
			$(".knowledge-inner-content-panel").eq(1).jScrollPane({dragMinHeight:178,dragMaxHeight:178,scrollbarWidth:13,hidePanelBackground:true});
			$(".knowledge-inner-content-panel").eq(1).addClass("isjp");	
		}	
	}).siblings().hide(0);	
});



//注册链接
$("input.reg").click(function(){ location.href="confirm.php"; });



//自定义多选框
function checkbox(obj){
	var $obj = obj;
	var $hi = $("#"+$obj.attr("comment"));
	var $list = $obj.find("li");
	
	$list.bind("click",function(){
		var _this = $(this);
		_this.addClass("on").siblings().removeClass("on");
		$hi.val(_this.text());
	});
	
};

$(".reg-checkbox").each(function(i) {
    checkbox($(this));
});


$(".map-icon").mouseover(function(){
	$(this).animate({top:"-="+10},300,function(){
			$(this).animate({top:"+="+10},300);
	});	
});



});
 

