<?php
   /*   网站验证码程序
    *   运行环境： PHP5.0.18 下调试通过
    *   需要 gd2 图形库支持（PHP.INI中 php_gd2.dll开启）
    *   文件名: showimg.php
    *   作者：  17php.com
    *   Date:   2007.03
    *   技术支持： www.17php.com
    */

   //随机生成一个4位数的数字验证码
    $num="";
    for($i=0;$i<4;$i++){
    $num .= rand(0,9);
    }
   //4位验证码也可以用rand(1000,9999)直接生成
   //将生成的验证码写入session，备验证页面使用
    Session_start();
    $_SESSION["Checknum"] = $num;
   //创建图片，定义颜色值
    Header("Content-type: image/PNG");
    srand((double)microtime()*1000000);
    $im = imagecreate(80,34);
    $black = ImageColorAllocate($im,255,255,255);
    $color = ImageColorAllocate($im,246,158,158);
	//imagecolortransparent($im,$color);
    imagefill($im,0,0,$color);

    //随机绘制两条虚线，起干扰作用
    /*$style = array($black, $black, $black, $black, $black, $color, $color, $color, $color, $color);
    imagesetstyle($im, $style);
    $y1=rand(0,34);
    $y2=rand(0,34);
    $y3=rand(0,34);
    $y4=rand(0,34);
    imageline($im, 0, $y1, 80, $y3, IMG_COLOR_STYLED);
    imageline($im, 0, $y2, 80, $y4, IMG_COLOR_STYLED);*/

    //在画布上随机生成大量黑点，起干扰作用;
    for($i=0;$i<180;$i++)
    {
   imagesetpixel($im, rand(0,80), rand(0,34), $black);
    }
    //将四个数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
    $strx=rand(3,8);
	
	///imagettftext($im, 20, 0, 10, 20, $white,"", "I am NUMBER ONE !!");
	
    for($i=0;$i<4;$i++){
    $strpos=rand(5,15);
	
    imagestring($im,5,$strx, $strpos, substr($num,$i,1), $black);
    
	$strx+=rand(20,20);
    }
    ImagePNG($im);
    ImageDestroy($im);
   ?>