<?php
/**
 * add right add
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
    <td width="972" background="../../images/i_m_t.jpg">系统设置>><a href="right_list.php" style="color:#666;">用户组列表</a>>>添加用户组</td>
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
    <form id="add_righta" name="add_righta" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        
        <tr>
          <td width="0%" height="30" class="m_t_c">&nbsp;</td>
          <td width="12%" class="m_t_c">添加新用户组</td>
          <td height="30" class="m_t_c">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right">用户组名称：</td>
          <td height="40"><input name="right_name" type="text" class="input_add" id="right_name" /></td>
        </tr>
        <tr>
          <td colspan="2" align="right">拥有权限：</td>
          <td width="88%" height="150"><table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="11%" height="30" align="right">系统设置：</td>
              <td width="89%"><input type="checkbox" name="right_set[]" id="right_set1" value="1" />
                用户管理 
                  <label>
                  <input type="checkbox" name="right_set[]" id="right_set2" value="2" />
                  用户组管理                  </label></td>
            </tr>
            <tr>
              <td height="30" align="right">模块权限：</td>
              <td><input type="checkbox"  name="right_set[]" id="right_set3" value="3" />
                优路首页
                <input type="checkbox" name="right_set[]" id="right_set4" value="4" />
                优路新闻
                <input type="checkbox" name="right_set[]" id="right_set5" value="5" />
                成长日记
                <input type="checkbox" name="right_set[]" id="right_set6" value="6" />
                孩子教养
                <input type="checkbox" name="right_set[]" id="right_set7" value="7" />
                爱心捐赠
                <input type="checkbox" name="right_set[]" id="right_set8" value="8" />
                义工招募
                <input type="checkbox" name="right_set[]" id="right_set9" value="9" />
                物资转送
                <input type="checkbox" name="right_set[]" id="right_set10" value="10" />
                财物公开
				</td>
            </tr>
            
          </table>
          <div style="height:10px;"></div>
          </td>
        </tr>
        
        <tr>
          <td colspan="2" align="right">备注：</td>
          <td height="100"><textarea name="desc" cols="45" rows="5" class="input_text" id="desc"></textarea></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td height="30">
              <input type="submit" name="add_right" id="add_right" value="保存" />
              <input type="hidden" name="action" value="add_right" />              </td>
        </tr>
      </table>
    </form>
 <?php
}
elseif($action == 'add_right')
{
	if( empty($param['right_name']) )
	{
		show_msg('请填写用户组名称','right_add.php');
	}
	else
	{
		if( isset($param['right_set']) )
		{
		
			if( is_array($param['right_set']) )
			{
				
				//print_r($param['right_set']);
				
				$right_list = implode(',',$param['right_set']);
				
				$back_data = create_news_group($param,$right_list,$_SESSION['admin_id']);
				
				if($back_data==0)
				{
					show_msg('用户组名称以存在','right_add.php');
				}
				elseif($back_data)
				{
					show_msg('添加成功','right_list.php');
				}
				else
				{
					show_msg('请重试','right_add.php');
				}
				
			}
			else
			{
				show_msg('没有选择用户组拥有的权限','right_add.php');
			}
	
		}
		else
		{
			show_msg('没有选择用户组拥有的权限','right_add.php');
		}
	
	}
	
}
?>    
	 </td>
  </tr>
</table> 
</body>
</html>
