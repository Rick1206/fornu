<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>优路</title>
<link type="text/css" rel="stylesheet" href="css/base.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/jScrollPane.css" />
</head>
<body class="bg2">
<?php
	$navNum = 6;
	include "head.php"; 
?>
<div class="w">
<div class="w960 pr">
    <div class="tags png about"><div class="tags-content"><ul><li><a href="donate.php"><img src="image/tags/into_01.png" /></a></li><li><a href="pro_support.php"></a><img src="image/tags/into_02.png" /></li><li class="tagon"><a href="word.php"><img src="image/tags/into_03.png" /></a></li></ul></div><div class="tags-right png"></div></div> 
</div>
</div>

<div class="w bgfff">
<div class="w970 ol pt20 pb10" id="content">
	<div class="fl pl165 pt30 pb20 w530">
        <p class="fi pb50 w300">你的关爱是对孩子最大的帮助，您的鼓励是对我们工作最大的支持，短短几句话，也是您的一份爱心捐助
在这里留下您的爱吧</p>
        <table cellpadding="0" cellspacing="0" border="0" class="pro_support mb20 f14">
    <tr><td>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</td><td><input type="text" class="comm-text" id="name" value="请填写您的称呼" /></td></tr>
    <tr><td valign="top">爱心赠言</td><td><textarea class="comm-textarea comm2" id="word">请在此填写您的爱心……</textarea><a href="javascript:void(0)" id="wordsubmit"><img src="image/submit_word.jpg" /></a></td></tr>
    </table>
    </div>
    <div class="fr word">
        	<div class="tc pt10 f12">爱心小黑板</div>
            <ul class="wlist f10">
            	<li>Lisa说：<br/>
春天到了，小苹果要多多吃饭长身体哦</li>
<li>Lisa说：<br/>
春天到了，小苹果要多多吃饭长身体哦</li>
<li>Lisa说：<br/>
春天到了，小苹果要多多吃饭长身体哦</li>
            </ul>
            <div class="w page pb20 pt15">
	<a>上一页</a>&lt;1.2.3.4.5.6...&gt;<a>下一页</a>
    </div>
    </div>
    
</div>



<div class="w650 ol pt50 pb50 tc none" id="result">
	<img src="image/withheart_success.jpg" border="0" usemap="#Map" class="mau" />
    <map name="Map">
      <area shape="rect" coords="252,139,307,162" href="javascript:window.close();">
      <area shape="rect" coords="490,16,512,39" href="javascript:window.close();">
    </map>
</div>


</div>

<div class="w ol pb50 pt10 tags-bottom">
<div class="cb mau w960">
    	<a href="" class="png fr"><img src="image/social_media_sina.png" /></a>
</div>
</div>

<div class="footer tc f11">
	优路   版权所有©  2011  LuPin26.Com  优路.Com  All Rights Reserved. 
</div>
</body>
</html>
<script language="javascript" src="script/jquery-1.5.1.min.js" type="text/javascript"></script>
<script language="javascript" src="script/common.js" type="text/javascript"></script>
<script language="javascript" src="script/action.js" type="text/javascript"></script>
<script language="javascript" src="script/jScrollPane.js" type="text/javascript"></script>
<script language="javascript" src="script/jquery.mousewheel.js" type="text/javascript"></script>
<script language="javascript">
$(function(){
	bindWord();
});
</script>
<!--[if IE 6]>
<script language="javascript" src="script/DD_belatedPNG.js"></script>
<script>
	DD_belatedPNG.fix('.png,.menu li a');
    document.execCommand("BackgroundImageCache",false,true);
</script>
<![endif]-->