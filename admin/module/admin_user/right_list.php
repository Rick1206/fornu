<?php
/**
 * admin user list
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

	
if( empty($_SESSION['admin_id'])){

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
    <td width="972" background="../../images/i_m_t.jpg">系统设置&gt;&gt;用户组列表</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="300" valign="top">
    <?php
		if(!@$param["del_group"])
		{
	?>
    <form id="user_list" name="user_list" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="3" height="30" class="m_t_c">&nbsp;</td>
          <td colspan="3" class="m_t_c">用户组列表</td>
          <td class="m_t_c">&nbsp;</td>
          <td class="m_t_c">&nbsp;</td>
          <td align="right" class="m_t_c"><img src="../../images/add.jpg" /></td>
          <td bgcolor="#999999"><a href="right_add.php" style="color:#000;">添加用户组</a></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td width="22" height="25"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="105">全选</td>
          <td width="193" height="30">用户组名称</td>
          <td width="176">拥有权限</td>
          <td width="305">备注</td>
          <td width="55">操作</td>
          <td width="104">&nbsp;</td>
        </tr>
        <?php
            $where = '';
            $all_date_num = page_1::page_all_num('user_group',$where);
            $last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('user_group',$where,'',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="20">&nbsp;</td>
          <td height="20">
         	 <input type="checkbox" name="del_group_a[]" id="del_group_a" value="<?php echo $v['j_id'];?>" />          </td>
          <td height="25"><?php echo $v['name'];?></td>
          <td height="20"><a href="right_details.php?right_id=<?php echo $v['j_id']?>" style="color:#000;">查看详细</a></td>
          <td height="20"><?php echo $v['desc'];?></td>
          <td height="20" colspan="2"><a href="right_modify.php?right_id=<?php echo $v['j_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
          </tr>
        <?php } ?>
        <tr>
            <td>&nbsp;</td>
            <td height="25" colspan="7" >
            <?php 
            echo page::page_num($all_date_num,$page_a,$page,'right_list.php?action=right_list');
            //echo $pager->show();?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="40" colspan="7" align="center">
            <input type="submit" name="del_group" id="del_group" value="删除" />
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" /> </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
<?php
	}
	else
	{
	
		if(isset($param['del_group_a']))
		{
			
			if( is_array($param['del_group_a']))
			{
				
				foreach($param['del_group_a'] as $k)
				{
					$back_data = del_user_group($k);
				}
				
				if($back_data == 0)
				{
					show_msg('不能删除，该用户组下存在用户。','right_list.php');
				}
				elseif($back_data)
				{
					show_msg('删除成功','right_list.php');
				}
				else
				{
					show_msg('请重试','right_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','right_list.php');
		}
	
	
	}
?>

</body>
</html>
