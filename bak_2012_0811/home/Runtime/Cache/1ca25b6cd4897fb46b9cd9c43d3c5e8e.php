<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!-- 准备使用 ajax -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo (THINK_VERSION); ?></title>
<link rel="stylesheet" href="__PUBLIC__/Css/base.css" type="text/css">
<link rel="stylesheet" href="__PUBLIC__/Css/common.css" type="text/css">
<link rel="stylesheet" href="__PUBLIC__/Css/jScrollPane.css" type="text/css">
<!--[if IE 6]>
<script language="javascript" src="__PUBLIC__/Js/DD_belatedPNG.js"></script>
<script>
	DD_belatedPNG.fix('.png,.text1,.text2');
    document.execCommand("BackgroundImageCache",false,true);
</script>
<![endif]-->
</head>

<body class="background-reg">
<div class="container header">
    <div class="fn-right login">
    <form method="post">
    	<span>用户登录：</span><input type="text" class="text" /><span>密　码：</span><input type="password" class="text" />
        <input type="button" class="reg" value="新用户注册" /><input type="submit" class="go" value="go" />
    </form>
    </div>
<ul class="menu fn-right">
    	<li class="u1">
        <a show="0" href="aboutus.php"<?php echo ($navNum==0) ? " class=\"on\"" : "";?>><span class="m1">关于竞维</span></a>
        <a href="product.php"<?php echo ($navNum==1) ? " class=\"on\"" : "";?>><span class="m2">产品中心</span></a>
        <a show="1" href="growing.php"<?php echo ($navNum==2) ? " class=\"on\"" : "";?>><span class="m3">优护成长</span></a>
        <a show="2" href="news.php"<?php echo ($navNum==3) ? " class=\"on\"" : "";?>><span class="m4">活动介绍</span></a>
        <a href="knowledge.php"<?php echo ($navNum==4) ? " class=\"on\"" : "";?>><span class="m5">育儿知识</span></a>
        
        </li>
        
        <li class="showmenu">
        <div class="menu-down md01">
        	<div class="bt_t"></div>
            <div class="bt_c">
            	<a href="aboutus.php">
                	<span></span>
                </a>
                <a href="aboutus_jayvee.php">
                	<span class="sm2"></span>
                </a>
                <a href="#">
                	<span class="sm3"></span>
                </a>
            </div>
            <div class="bt_b"></div>
        </div>
        
         <div class="menu-down md02">
        	<div class="bt_t"></div>
            <div class="bt_c">
            	<a href="growing.php?0">
                	<span class="sm4"></span>
                </a>
                <a href="growing.php?1">
                	<span class="sm5"></span>
                </a>
                <a href="growing.php?2">
                	<span class="sm6"></span>
                </a>
            </div>
            <div class="bt_b"></div>
        </div>
        
        
        
         <div class="menu-down md03">
        	<div class="bt_t"></div>
            <div class="bt_c">
            	<a href="news.php">
                	<span class="sm7"></span>
                </a>
            </div>
            <div class="bt_b"></div>
        </div>
        
        
        </li>
    </ul>
</div>
<div class="container">
	<div class="reg-block">
    </div>
</div>
<div class="container reg-hack">
	<div id="step1" class="pr">
    <div class="s-title"><img src="__PUBLIC__/Images/reg_step_1.jpg" /></div>    
	<ul class="reg-list">
    	<li><span>手机号码：</span><input type="text" class="text1" id="mobile" reg="mobile" defaultMessage="请输入手机号码" errorMessage="您输入的手机号码有误"  /><em></em></li>
        <li class="only"><span>手机验证码：</span><input type="text" class="text2" /><img class="fn-left reg-cer" src="__PUBLIC__/Images/temp_reg_cer.png" /></li>
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
	<div class="noti"><a href="#">返回首页</a>　　<a href="#">返回前页</a></div>
</div>

<script language="javascript" src="__PUBLIC__/Js/jquery-1.5.1.min.js"></script>
<script language="javascript" src="__PUBLIC__/Js/jquery.mousewheel.js"></script>
<script language="javascript" src="__PUBLIC__/Js/jScrollPane.js"></script>
<script language="javascript" src="__PUBLIC__/Js/jquery.lightbox.js"></script>
<script language="javascript" src="__PUBLIC__/Js/common.js"></script>
<script language="javascript" src="__PUBLIC__/Js/form.js"></script>
</body>
</html>