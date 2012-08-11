<?php
/**
 * add admin user
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 *
*/
define('IN_SK',true);
	
require('../../includes/init.php');	
	
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit('你没有权限');
}
//获取权限列表
$right_id = isset($_GET['right_id']) ? intval($_GET['right_id']) : "";
if( empty($right_id))
{
	header('Location: ../../login.php');
	exit('你没有权限');
}
else
{
	$right_list = get_right_list($right_id);//权限列表
	if($right_list==0)
	{
		header('Location: ../../login.php');
		exit('你没有权限');
	}
	else
	{
		$right_details = get_right_details($right_id);//权限详细内容通过ID
		foreach($right_details as $k=>$v)
		{
			$name	= $v['name'];
			$desc	= $v['desc'];
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
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">系统设置>><a href="right_list.php" style="color:#666;">用户组列表</a>>>修改用户组权限</td>
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
    <form id="modify_right" name="modify_right" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="4" height="30" class="m_t_c">&nbsp;</td>
          <td width="162" height="30" class="m_t_c">修改用户组权限</td>
          <td height="30" class="m_t_c">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right">用户组名称：</td>
          <td height="40">
          <input name="right_name1" type="text" class="input_add" id="right_name" value="<?php echo $name;?>" />
          <input name="right_name2" type="hidden" value="<?php echo $name;?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2" align="right">拥有权限：</td>
          <td width="782" height="150"><table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="11%" height="30" align="right">系统设置：</td>
              <td width="89%">
              	<input type="checkbox" name="right_set[]" id="right_set1" value="1" 
				  <?php 
                    if(in_array('1',$right_list))
                    {
                  ?> 
                  checked="checked"
                  <?php } ?>
                  />
                用户管理 
                  <input type="checkbox" name="right_set[]" id="right_set2" value="2" 
				  <?php 
					if(in_array('2',$right_list))
					{
				  ?> 
				  checked="checked"
				  <?php } ?> />
                  用户组管理                  </td>
            </tr>
            <tr>
              <td height="30" align="right">模块权限：</td>
              <td>
               <input type="checkbox"  name="right_set[]" id="right_set3" value="3"
              <?php 
			  	if(in_array('3',$right_list))
				{
			  ?> 
              checked="checked"
              <?php } ?>
               />
				优路首页
                <input type="checkbox" name="right_set[]" id="right_set4" value="4"
                <?php 
			  	if(in_array('4',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
              	 />
				优路新闻
                <input type="checkbox" name="right_set[]" id="right_set5" value="5"
                <?php 
			  	if(in_array('5',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                 />
                成长日记	
                <input type="checkbox" name="right_set[]" id="right_set6" value="6"
                <?php 
			  	if(in_array('6',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                 />
                孩子教养
                <input type="checkbox" name="right_set[]" id="right_set7" value="7" 
                <?php 
			  	if(in_array('7',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                />
				爱心捐赠
				<input type="checkbox" name="right_set[]" id="right_set8" value="8"
                <?php 
			  	if(in_array('8',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                 />
                 义工招募
				<input type="checkbox" name="right_set[]" id="right_set9" value="9"
                <?php 
			  	if(in_array('9',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                 /> 
				物资转送
                <input type="checkbox" name="right_set[]" id="right_set10" value="10"
                <?php 
			  	if(in_array('10',$right_list))
				{
			  	?> 
              	checked="checked"
              	<?php } ?>
                 /> 
                财物公开
				</td>
            </tr>
            
          </table>
          <div style="height:10px;"></div>          </td>
        </tr>
        
        <tr>
          <td colspan="2" align="right">备注：</td>
          <td height="100">
          <textarea name="desc" cols="45" rows="5" class="input_text" id="desc"><?php echo $desc;?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td height="30">
              <input type="submit" name="modify_right" id="modify_right" value="保存" />
              <input type="hidden" name="action" value="modify_right" />              </td>
        </tr>
      </table>
    </form>
<?php
}
elseif($action == 'modify_right')
{
	if( empty($param['right_name1']) )
	{
		
		show_msg('用户组名不能空','right_modify.php?right_id='.$right_id);
	}
	else
	{
	
		//echo $param['right_name1']."<br>".$param['right_name2']."<br>";
		if( @is_array($param['right_set']) )
		{
		
			$right_list = implode(',',$param['right_set']);
			
			$back_data = modify_group($param,$right_list,$right_id,$_SESSION['admin_id']);
			
			if($back_data==0)
			{
				show_msg('用户组名已存在！','right_modify.php?right_id='.$right_id);
			}
			elseif($back_data)
			{
				show_msg('修改成功','right_list.php');
			}
			else
			{
				show_msg('请重试','right_modify.php?right_id='.$right_id);
			}
		}
		else
		{
			show_msg('没有分配权限列表','right_modify.php?right_id='.$right_id);
		}
	
	}
	
}
?>    
	 </td>
  </tr>
</table> 
</body>
</html>
