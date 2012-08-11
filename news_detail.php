<?php 
define('IN_SK',true);

require_once('./includes/init.php');
$nId = $_GET['news_id'];

$query = $db->query("SELECT lan, dateline, orderby, title_".$lang." AS title, description_".$lang." AS description, photo FROM ".$ros->table('news')." WHERE news_id = '".$nId."' AND title_".$lang."<>'' LIMIT 1");

if ($thisB = $db->fetch_array($query)) {
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新闻中心-<?php echo cut_str($thisB["title"],30);?></title>
<meta name="keywords" content="优路-<?php echo $thisB["title"];?>"/>
<meta name="description" content="<?php echo $thisB["title"];?>"/>

<link rel="stylesheet" href="css/base.css" type="text/css">
<link rel="stylesheet" href="css/common.css" type="text/css">
<link rel="stylesheet" href="css/page.css" type="text/css">
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
    <div class="breadcrumbs">首页 > <a href="news.php" target="_blank">新闻中心</a> > <a class="on">正文</a><a href="news.php" class="fn-right news-return"><img src="images/icon_news_return.png" /></a></div>	
        
    <h3 class="news_detail_title"><?php echo $thisB['title']."&nbsp;&nbsp;";?>
    <?php echo "[".date("Y-m-d",strtotime($thisB['dateline']))."]" ;?>
    </h3>
    <div class="news-content inner-detail">
    <div class="news-content-panel">
    	<p>
        <?php echo $thisB['description']; ?>
        </p>
   		<!--<p>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/>"多美滋1000日抵抗力计划--成长映像纪"自6月启动以来深受消费者的欢迎。1000日街头访谈、10大城市的20场路演活动、1000日成长映像网络评选……超过4万名家长和宝宝与多美滋一起经历了一次生动的抵抗力之旅，体验强大的抵抗力给宝宝带来的每一次精彩成长。<br/><br/></p>-->
	</div>
    
    </div>

    </div>
    
</div>
<?php include "foot.php"; ?>
<script language="javascript" src="js/jquery-1.5.1.min.js"></script>
<script language="javascript" src="js/jquery.mousewheel.js"></script>
<script language="javascript" src="js/jScrollPane.js"></script>
<script language="javascript" src="js/common.js"></script>
</body>
</html>
<?php
} else {
	Header("Location:news.php");
}
?>