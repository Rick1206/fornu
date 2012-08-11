<?php
/**
 * add admin user
 * ============================================================================
 * powered by Rick
 * http://www.digitalcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick Shi  
 * $email:1491361147@qq.com
 *
*/
define('IN_SK',true);
	
require('../../includes/init.php');	
	
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
<link rel="stylesheet" href="../../style/module.css" />
<script src="../../../js/j132m.js" language="javascript"></script>
<script src="../../js/contorl_module.js" language="javascript"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">系统设置>><a href="user_list.php" style="color:#666;">用户列表</a>>>添加用户</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="160" valign="top">
    <?php
   // to add new user
	   $action = isset($param["action"]) ? $param["action"] : "";
	   if(empty($action))
	   {
	?>
    <form id="add_user" name="add_user" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        
        <tr>
          <td height="30" colspan="2" class="m_t_c">添加用户</td>
          </tr>
        <tr>
          <td align="right">用户组：</td>
          <td height="30">
          <select name="user_group">
          <?php
		  	$user_group = get_user_group('');
            foreach($user_group as $k=>$v)
            {
          ?>
          <option value="<?php echo $v['j_id'];?>"><?php echo $v['name'];?></option>
          <?php }?>
          </select>          </td>
        </tr>
        <tr>
          <td width="9%" align="right">用户名：</td>
          <td width="91%" height="30"><input type="text" name="user_name" id="user_name" /></td>
        </tr>
        <tr>
          <td align="right"> 密码：</td>
          <td height="30"><input type="password" name="user_psw" id="user_psw" /></td>
        </tr>
        <tr>
          <td align="right">备注：</td>
          <td height="30"><input type="text" name="user_note" id="user_note" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30">
              <input type="submit" name="add_user" id="add_user" value="保存" />
              <input type="hidden" name="action" value="add_user" />          
              </td>
        </tr>
      </table>
    </form>
 <?php
}
elseif($action == 'add_user')
{

	if( empty($param['user_name']) )
	{
		show_msg('填写用户名','user_add.php');
		
	}
	else if( empty($param['user_psw']) )
	{
		show_msg('填写用户密码','user_add.php');
	}
	else
	{
		$back_data = add_new_user($param);
		
		if($back_data)
		{
			show_msg('添加成功','user_list.php');
		}
		else
		{
			show_msg('请重试','user_add.php');
		}
	
	}
	
}
?>    
    
    
    </td>
  </tr>
</table> 
</body>
</html>
