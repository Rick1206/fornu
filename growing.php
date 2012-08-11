<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>About us</title>
<link rel="stylesheet" href="css/base.css" type="text/css">
<link rel="stylesheet" href="css/common.css" type="text/css">
<link rel="stylesheet" href="css/jScrollPane.css" type="text/css">
<!--[if IE 6]>
<script language="javascript" src="js/DD_belatedPNG.js"></script>
<script>
	DD_belatedPNG.fix('.navgation .item .link,.png,.navgation .item.on .link,.navgation .item:hover .link,.navgation .item,.navgation .item.on,.navgation .item:hover,.bt_c,.bt_t,.bt_b,.menu li .bt_c a.on,.menu li .bt_c a:hover');
    document.execCommand("BackgroundImageCache",false,true);
</script>
<![endif]-->
</head>

<body class="background-news">
<div class="container header">
	
    <?php
	$navNum = 2;
	include "menu.php"; 	
	?>
</div>
<div class="container">
	<div class="growing-block"></div>
     <div class="breadcrumbs">首页 > <a class="on">优护成长</a></div>
</div>
<div class="container">
	<div class="growing">
    	<h3>优路金装优化配方</h3>
        <p>蕴含7大主要营养元素，全面支持宝宝大脑与身体的发育生长。<br>
科学的配比让各个营养元素都能被宝宝充分吸收，让宝宝身体棒棒。</p>

		<div class="growing-content">
        	<ul class="grow-left-menu fn-left" id="grow-table">
            	<li class="on"><span></span></li>
                <li><span class="grs2"></span></li>
                <li><span class="grs3"></span></li>
            </ul>
            
            <ul class="grow-right" id="grow-table-content">
            	<li><img src="images/grow-right-01.jpg" /></li>
                <li class="fn-hide"><img src="images/grow-right-02.jpg" /></li>
                <li class="fn-hide"><img src="images/grow-right-03.jpg" /></li>
            </ul>
            
        </div>
    </div>
</div>

<div class="container copyright">
沪ICP备09004096号<br/>
© Copyright 2010 All rights reserved by Dumex　　多美滋婴幼儿食品有限公司
</div>
<script language="javascript" src="js/jquery-1.5.1.min.js"></script>
<script language="javascript" src="js/jquery.mousewheel.js"></script>
<script language="javascript" src="js/jScrollPane.js"></script>
<script language="javascript" src="js/common.js"></script>
<script language="javascript">
$(function(){
	var url = location.href;
	if(url.lastIndexOf("?")>-1)
	{
		var i = url.substring(url.lastIndexOf("?")+1,url.length);
		$("#grow-table li").eq(i).click();	
	}
});
</script>

</body>
</html>
