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
	exit('你没有权限');
}
$right_id = isset($_GET['right_id']) ? intval($_GET['right_id']) : "";

if( empty($right_id))
{
	exit('你没有权限');
}
else
{
	$right_list = get_right_list($right_id);
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
    <td width="972" background="../../images/i_m_t.jpg">
    系统设置>><a href="right_list.php" style="color:#666;">用户组列表</a>>>
    <?php echo get_user_group($right_id);?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="160" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="0%" height="30" class="m_t_c">&nbsp;</td>
          <td width="12%" class="m_t_c">用户列表</td>
          <td height="30" class="m_t_c">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right">拥有用户：</td>
          <td width="88%" height="50">
            <table width="98%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                      <td height="30">
                       <?php
                       		//get user in group
							$get_group_user = search_group_user($right_id);
							foreach($get_group_user as $k=>$v )
							{
								echo "(".$v['uname'].') ';
							} 
					   ?>
                      </td>
                  </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        
        <tr>
          <td width="0%" height="30" class="m_t_c">&nbsp;</td>
          <td width="12%" class="m_t_c">权限列表</td>
          <td height="30" class="m_t_c">&nbsp;</td>
        </tr>
        
        <tr>
          <td colspan="2" align="right">拥有权限：</td>
          <td width="88%" height="150"><table width="98%" border="0" cellpadding="0" cellspacing="0">
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
          </td>
        </tr>
      </table>
	  <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="13%">&nbsp;</td>
          <td width="12%"><a href="right_list.php" style="color:#000;">返回列表</a></td>
          <td width="75%"><a href="right_modify.php?right_id=<?php echo $right_id;?>" style="color:#000;">修改权限</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table> 
</body>
</html>
