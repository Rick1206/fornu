<?php
/**
 * job
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 *
*/
define('IN_SK',true);
	
require(dirname(__FILE__) . '/includes/init.php');	
require(dirname(__FILE__) .'/lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: login.php');
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $system_name;?></title>
<link rel="stylesheet" href="style/module.css" />
<script src="../js/j132m.js" language="javascript"></script>
<script src="js/contorl_module.js" language="javascript"></script>
<script src="js/time_cn.js" language="javascript"></script>
</head>
<body>

<div id="contant_left">
	<div id="left_title">企业公民</div>
    <?php
    	if( @in_array('5',$a_right))
		{
	?>
    <div class="left_list" id="0"><img src="images/dir.gif" />协鑫阳光慈善基金</div>
	<div class="left_list" id="1"><img src="images/dir.gif" />我们在行动</div>
	<?php }?>
</div>

<div id="contant_right">

    <div id="right_mark">
        
        <?php
        	//工作管理
			if( @in_array('5',$a_right))
			{
		?>
    	<div class="include_module">
        <iframe  width="760" height="470" allowtransparency="true" frameborder="0" scrolling="auto" marginwidth="0" marginheight="0" src="module/responsibility/foundation_list.php" name="a0"></iframe>
        </div>
     	<div class="include_module">
        <iframe  width="760" height="470" allowtransparency="true" frameborder="0" scrolling="auto" marginwidth="0" marginheight="0" src="module/responsibility/community_list.php" name="a1"></iframe>
        </div>
        <?php } ?>
     
		

   </div> <!-- end silder-->
</div><!--end right-->
</body>
</html>