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
	DD_belatedPNG.fix('.png,.text1,.text2');
    document.execCommand("BackgroundImageCache",false,true);
</script>
<![endif]-->
</head>

<body class="background-reg">
<div class="container header">
	<?php
	$navNum = 0;
	include "menu.php"; 	
	?>
</div>
<div class="container">
	<div class="reg-block">
    </div>
</div>
<div class="container reg-hack">
	<div id="step1" class="pr">
    <div class="s-title"><img src="images/reg_step_1.jpg" /></div>    
	<ul class="reg-list">
    	<li><span>手机号码：</span><input type="text" class="text1" id="mobile" reg="mobile" defaultMessage="请输入手机号码" errorMessage="您输入的手机号码有误"  /><em></em></li>
        <li class="only"><span>手机验证码：</span><input type="text" class="text2" id="checkcode" name="checkcode" /><img class="fn-left reg-cer" src="showing.php" id="checkImg" /><em></em></li>
        <li><span>昵称：</span><input type="text" class="text1" id="nickname" reg="empty" defaultMessage="请输入昵称" errorMessage="您输入的昵称有误"  /><em></em></li>
        <li><span>邮箱：</span><input type="text" class="text1" id="email"  reg="email" defaultMessage="请输入邮箱地址" errorMessage="您输入的邮箱地址有误"  /><em></em></li>
        <li><span>密码：</span><input type="password" class="text1" id="password"  reg="pass" defaultMessage="请输入密码" errorMessage="您输入的密码有误"  /><em></em></li>
        <li><span>确认密码：</span><input type="password" class="text1" reg="pass" defaultMessage="请输入确认密码" errorMessage="您输入的确认密码有误" unsamereg="password" unsameMessage="两次输入不一致"  /><em></em></li>
        <li><span>妈妈姓名：</span><input type="text" class="text1" id="mumname" reg="empty" defaultMessage="请输入妈妈姓名" errorMessage="您输入的妈妈姓名有误"  /><em></em></li>
        <li><span>所在地：</span><input type="text" class="text1" id="area" reg="empty" defaultMessage="请输入所在地" errorMessage="您输入的所在地有误"  /><em></em></li>
    </ul>
    <a href="javascript:void(0)" id="btn_step_1" class="reg-btn-step"></a>
    </div>
    
    <div id="step2" class="fn-hide pr">
    <div class="s-title"><img src="images/reg_step_2.jpg" /></div>     
	<ul class="reg-list">
    	<li><span>联系地址：</span><input type="text" class="text1"  id="address" reg="empty" defaultMessage="请输入联系地址" errorMessage="您输入的联系地址有误"  /><em></em></li>
        <li><span>电话：</span><input type="text" class="text3" id="phone1" reg="d3-4" defaultMessage="请输入区号" errorMessage="您输入区号有误"  /><strong class="reg-other">-</strong><input type="text" id="phone2" class="text2" reg="d7-8" defaultMessage="请输入电话" errorMessage="您输入的电话有误"   /><em></em></li>
        <li><span>邮编：</span><input type="text" class="text1" id="zipcode" reg="zipcode" defaultMessage="请输入邮编" errorMessage="您输入的邮编有误"  /><em></em></li>
        <li><span>现状：</span>
        <ul comment="now" class="reg-checkbox"><li>已有宝宝</li><li>怀孕期</li><li>无宝宝</li></ul> 
        <input id="now" value="" type="hidden"/> <em></em>
        </li>
        <li><span class="o1">是否愿意接受知道/杂志:</span>
        <ul comment="maga" class="reg-checkbox"><li>是</li><li>否</li></ul> 
        <input id="maga" value=""  type="hidden"/>   <em></em>
        </li>
        <li><span class="o2">是否愿意接受新品推广,活动信息的手机短信：</span>
        <ul comment="activity" class="reg-checkbox"><li>是</li><li>否</li></ul> 
        <input id="activity" value=""  type="hidden"/>  <em></em>
        </li>
        <li><span class="o3">希望何种联系方式：</span>
        <ul comment="contact" class="reg-checkbox"><li>Email</li><li>短信</li><li>邮寄</li><li>电话</li></ul> 
        <input id="contact" value=""  type="hidden"/> <em></em>
        </li>
    </ul>
    <a href="javascript:void(0)" id="btn_step_2" class="reg-btn-step success"></a>
    </div>
    
</div>

<div class="container copyright">
沪ICP备09004096号<br/>
© Copyright 2010 All rights reserved by Dumex　　多美滋婴幼儿食品有限公司
</div>

<div class="reg-success fn-hide png">
	<div class="noti"><a href="aboutus.php" target="_self" >返回首页</a>　　<a href="#" class="popClose">返回前页</a></div>
</div>

<script language="javascript" src="js/jquery-1.5.1.min.js"></script>
<script language="javascript" src="js/jquery.mousewheel.js"></script>
<script language="javascript" src="js/jScrollPane.js"></script>
<script language="javascript" src="js/jquery.lightbox.js"></script>
<script language="javascript" src="js/common.js"></script>
<script language="javascript" src="js/form.js"></script>


</body>
</html>
