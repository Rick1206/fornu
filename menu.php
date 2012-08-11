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