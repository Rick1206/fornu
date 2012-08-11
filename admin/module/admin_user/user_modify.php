<?php
/**
 * modify news information
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
require('../../FCKeditor/fckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}
$action = isset($param["action"]) ? $param["action"] : "";
$user_idw = isset($_GET['user_id']) ? intval($_GET['user_id']) : "";
if(empty($user_idw))
{
	header('Location: ../../login.php');
	exit();
}
else
{
	$user_info = search_user($user_idw);
	if($user_info==0)
	{
		header('Location: ../../login.php');
		exit();
	}
	else
	{
		foreach($user_info as $k=>$v)
		{
			$user_name = $v['uname'];
			$user_note = $v['note'];
			$user_group_id = $v['user_group'];
			$user_password = $v['pwd'];
		}	
	}
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
<script src="../../js/time_cn.js" language="javascript"></script>
</head>
<body>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">系统设置>><a href="user_list.php" style="color:#666;">用户列表</a>>>修改用户</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="160" valign="top">
    <?php
	
	if(empty($action))
	{
		if(!empty($user_idw))
		{
	?>
    <form id="change_psw2" name="add_user" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        
        <tr>
          <td width="9%" align="right">用户组：</td>
          <td width="91%" height="30">
          <select name="user_group_id">
          <?php
		  	$user_group = get_user_group('');
			
            foreach($user_group as $k=>$v)
            {
				
			  if($v['j_id'] == $user_group_id)
			  {
          ?>
          <option value="<?php echo $v['j_id'];?>" selected="selected"><?php echo $v['name'];?></option>
          <?php 
		  	}else{
		  ?>
          <option value="<?php echo $v['j_id'];?>"><?php echo $v['name'];?></option>
          <?php  }} ?>
          </select> 
                  
          </td>
        </tr>
        <tr>
          <td align="right">用户名：</td>
          <td height="30"><label>
            <input type="text" name="user_name" id="textfield" value="<?php echo $user_name;?>" disabled="disabled" />
          </label></td>
        </tr>
        <tr>
          <td align="right"> 新密码：</td>
          <td height="30"><input type="password" name="new_psw" id="new_psw" />
          <input type="hidden" name="user_psw" value="<?php echo $user_password;?>" /></td>
        </tr>
        <tr>
          <td align="right">备注：</td>
          <td height="30"><input type="text" name="user_note_s" id="user_note_s" value="<?php echo $user_note;?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30">
              <input type="submit" name="modify_user" id="modify_user" value="保存" />
              <input type="hidden" name="action" value="modify_user" />          </td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>

<?php
	}
}
elseif($action =='modify_user')
{
	$back_data = change_psw($_GET['user_id'],$param);
	if($back_data)
	{
		show_msg('修改成功','user_list.php');
	}
	else
	{
		show_msg('请重试','user_modify.php?user_id='.$user_idw);
	}	
}
?> 
</body>
</html>
