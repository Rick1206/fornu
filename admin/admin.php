<?php
/**
 * this is a center that contorl website information
 * ============================================================================
 * powered by Rick
 * http://www.digitalcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick Shi  
 * $email:1491361147@qq.com
 *
*/

define('IN_SK',true);
	
include 'includes/init.php';

include 'lib/lib_right.php';
	
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
</head>
<body>
<div id="contant_left">
	<div id="left_title">系统设置</div>
  	<div class="left_list" id="0"><img src="images/dir.gif" />系统信息</div>
  	<div class="left_list" id="1"><img src="images/dir.gif" />修改密码</div>
    <?php
    	if( @in_array('1',$a_right))
		{
	?>
    <div class="left_list" id="2"><img src="images/dir.gif" />用户管理</div>
    <?php
    	}
		if( @in_array('2',$a_right))
		{
	?>
    <div class="left_list" id="3"><img src="images/dir.gif" />用户组管理</div>
	<?php } ?>
</div>

<div id="contant_right">
  <?php 
		$action = isset($param["action"]) ? $param["action"] : "";
		if( empty($action))
		{
	?>
    <div id="right_mark">
        <!--information start -->
    	<div class="include_module">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="5"  background="images/i_m_t.jpg">&nbsp;</td>
            <td width="972" height="31" background="images/i_m_t.jpg" >系统设置&gt;&gt;系统信息</td>
          </tr>
          <tr>
            <td height="15"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
    	<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0" class="table">
          <tr>
            <td width="5" height="25"  class="m_t_c">&nbsp;</td>
            <td colspan="2"  class="m_t_c">系统配置信息</td>
          </tr>
          <tr>
            <td height="25"></td>
            <td width="89" height="30" align="right">服务器环境：</td>
            <td width="653"><?php echo $serverinfo;?></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td height="30" align="right">数据库版本：</td>
            <td height="25"><?php echo $dbversion;?></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td height="30" align="right">允许上传数：</td>
            <td height="25"><?php echo $fileupload; ?></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td height="30" align="right">数据库使用：</td>
            <td height="25"><?php echo $dbsize; ?></td>
          </tr>
        </table>
    	</div>
        <!--information end -->

        <!--chagnpassword start -->
        <div class="include_module">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5" height="31" background="images/i_m_t.jpg">&nbsp;</td>
            <td width="972" background="images/i_m_t.jpg">系统设置&gt;&gt;修改密码</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="160" valign="top">
            <form id="change_psw" name="change_psw" method="post">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                
                <tr>
                  <td width="9%" align="right">旧密码：</td>
                  <td width="91%" height="30">
                  <input type="password" name="old_psw" id="old_psw" />

                  </td>
                </tr>
                <tr>
                  <td align="right">新密码：</td>
                  <td height="30"><input type="password" name="new_psw" id="new_psw" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td height="30">
                    <input type="submit" name="change_psw" id="change_psw" value="保存"  />
                    <input type="hidden" name="action" value="change_psw" />
                 </td>
                </tr>
              </table>
              </form>
            </td>
          </tr>
        </table>    
      </div>
        <!--chagnpassword end -->

        <!--manage user start -->
        <div class="include_module">
         <?php
         	if( @in_array('1',$a_right))
			{
		 ?>
		 <iframe src="module/admin_user/user_list.php" width="760" height="470" allowtransparency="true" frameborder="0" scrolling="auto" marginwidth="0" marginheight="0"></iframe>
         <?php }?>
        </div> 
        <!--manage user end -->
    
        <!--add user start -->
        <div class="include_module">
        <?php
        	if( @in_array('2',$a_right))
			{
		?>
       		<iframe src="module/admin_user/right_list.php" width="760" height="470" allowtransparency="true" frameborder="0" scrolling="auto" marginwidth="0" marginheight="0"></iframe>
        <?php } ?>
      </div>
      	<!--add user end --> 
      	

     
      
   </div> 
   <!-- end silder-->
<?php
	}
	//修改初始密码
	elseif($action == 'change_psw')
	{
		
		if( empty($param['old_psw']) )
		{
			show_msg('请填写旧密码','admin.php?web_set=1');
			exit;
		}
		if( empty($param['new_psw']) )
		{
			show_msg('请填写新密码','admin.php?web_set=1');
			exit;
		}	
		
		if(!empty($param['new_psw']))
		{		
				//to get olde password
				$back_old_psw = get_old_psw($_SESSION['admin_id'],$param);
				//ture
				if(!empty($back_old_psw)){
					// to change new password
					$back_data = change_psw($_SESSION['admin_id'],$param);
					if($back_data)
					{
						show_msg('修改成功','admin.php?web_set=1');
					}
					else
					{
						show_msg('请重试','admin.php?web_set=1');
					}
				}
				else
				{
					show_msg('旧密码错误,请重新出入','admin.php?web_set=1');
				}
		}
	}
	
  ?>
</div>
<script>
$(document).ready(function(){
	
	//this function is to select paenl that get the url value 
	
	var id = <?php echo $id = ( empty($_GET['web_set']) ) ? 0 : intval($_GET['web_set']);?>
	
	function curr_id(id)
	{
		
		var movingDistance=500;
		if(id > 0)
		{
			var move_des = -(movingDistance * id);
			$("#right_mark").animate({
						top: move_des + "px"
			 }, "slow");	
		}	
	}
	curr_id(id);	
})
</script> 
</body>
</html>