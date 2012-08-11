<?php
define('IN_SK',true);
require_once('./includes/init.php');
require_once('./includes/pager.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $system_name; ?>-新闻中心</title>
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
	$navNum = 3;
	include "menu.php"; 	
	?>
</div>
<div class="container">
	<div class="news-block">
    </div>
</div>
<div class="container">
	<img src="images/news_photo_1_1.jpg" class="fn-left" alt="澳大利亚贝思特食品有限公司-新闻中心" />
    <div class="main-right">
    <div class="breadcrumbs">首页 > <a class="on">新闻中心</a></div>	
    <h2 class="news-title">新闻中心</h2>
    
    <div class="news-content">
    
    <div class="news-content-panel">
   		<ul class="news-list">
        <?php 
			$all_date_num = page_1::page_all_num("news"," WHERE title_".$lang."<>''");
			$perpage = 5;
			$page = isset($_GET['page']) ? $_GET['page'] : 1 ;
			$offset = ($page - 1) * $perpage;
			$multipage = multi_cn($all_date_num, $perpage, $page, "news.php");
			$strPage= "news.php?page=";
			$params = array(
			'total_rows'=>$all_date_num, 
            'method'    =>'html', 
            'parameter' =>$strPage.'!',  
            'now_page'  =>$_GET['page'], 
            'list_rows' =>4,
			);
			$page = new Core_Lib_Page($params);
		
			$myquery = $db->query("SELECT news_id, dateline, intro_".$lang." as intro , title_".$lang." as title FROM ".$ros->table('news')." ORDER BY orderby, dateline Desc LIMIT 0,5");
			$num =  $db->num_rows($myquery);
			if($num >0){	
			while($thisB = $db->fetch_array($myquery)) {
		  	?>
        	<li><strong><?php echo cut_str($thisB['title'],180);?></strong><em><a href="news_detail.php?news_id=<?php echo $thisB['news_id']; ?>" target="_blank">详细内容 ></a></em>
            <p><?php echo cut_str($thisB['intro'],350);?></p>
            </li>
            <?php 
			}
			$thisB = null;
			$myquery = nul;
			$db->close();
			}else{
			?>
            <div class="no-news"></div>
            <?php 
			}
			?>
            <!--<li><strong>1、多美滋抵抗力小达人出炉，1000日抵抗力计划持续升温</strong><em>详细内容 ></em>
            <p>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。</p>
            </li>
            
            <li><strong>1、多美滋抵抗力小达人出炉，1000日抵抗力计划持续升温</strong><em>详细内容 ></em>
            <p>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。</p>
            </li>
            
            <li><strong>1、多美滋抵抗力小达人出炉，1000日抵抗力计划持续升温</strong><em>详细内容 ></em>
            <p>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。</p>
            </li>
            
            <li><strong>1、多美滋抵抗力小达人出炉，1000日抵抗力计划持续升温</strong><em>详细内容 ></em>
            <p>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。</p>
            </li>-->
        </ul>
        
        <!--<div class="no-news">
        </div>-->
        
	</div>
    
    </div>
    
      <div class="page">
       <?php echo $page->show(2);?>
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
</body>
</html>
