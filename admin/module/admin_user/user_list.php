<?php
/**
 * admin user list
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
    <td width="972" background="../../images/i_m_t.jpg">系统设置>>用户管理</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="300" valign="top">
    <?php
		if(!@$param["del_user"])
		{
			$search_title = isset($_GET["search_title"]) ? $_GET["search_title"] : "";
			$search_title = ( empty($search_title) ) ? @$param['search_title'] : $search_title;

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
          <td colspan="3" class="m_t_c">用户列表
		  <?php 
			if(!empty($search_title) )
			{
		  ?>
          [<a href="user_list.php" style="color:#000;">列表首页</a>]
          <?php } ?></td>
          <td class="m_t_c">&nbsp;</td>
          <td class="m_t_c">&nbsp;</td>
          <td align="right" class="m_t_c"><img src="../../images/add.jpg" /></td>
          <td bgcolor="#999999"><a href="user_add.php" style="color:#000;">添加用户</a></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2" align="right">用户名:
              <input type="text" name="search_title" id="search_title" />
              <input type="submit" name="search" id="search" value="搜索" />          </td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="20" height="25"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="59">全选</td>
          <td width="118" height="30">用户名</td>
          <td width="134">用户组</td>
          <td width="152">备注</td>
          <td width="152">上次退出时间</td>
          <td width="101">操作</td>
        </tr>
        <?php
            $where = ( empty($search_title)) ? '' : ' WHERE uname like "%'.$search_title.'%"';
            $all_date_num = page_1::page_all_num('admin',$where);
            $last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('admin',$where,'',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
            if($v['admin_id']!=1)
            {
          ?>
        <tr>
          <td>&nbsp;</td>
          <td height="20">&nbsp;</td>
          <td height="20"> <input type="checkbox" name="del_user_a[]" id="del_user_a" value="<?php echo $v['admin_id'];?>" />
          </td>
          <td height="25"><?php echo $v['uname'];?></td>
          <td height="20"><?php echo get_user_group($v['user_group']);?></td>
          <td height="20"><?php echo $v['note'];?>&nbsp;</td>
          <td height="20"><?php echo $time = ( $v['out_time']== "0000-00-00 00:00:00" ) ? '' : $v['out_time'];?>&nbsp;</td>
          <td height="20"><a href="user_modify.php?user_id=<?php echo $v['admin_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
        </tr>
        <?php }} ?>
        <tr>
            <td>&nbsp;</td>
            <td height="25" colspan="7" >
            <?php 
            echo page::page_num($all_date_num,$page_a,$page,'user_list.php?search_title='.$search_title);
            //echo $pager->show();?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="40" colspan="7" align="center">
            <input type="submit" name="del_user" id="del_user" value="删除" />
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
	
		if(isset($param['del_user_a']))
		{
			
			if( is_array($param['del_user_a']))
			{
				
				foreach($param['del_user_a'] as $k)
				{
					$back_data = del_user($k);
				}
				
				if($back_data)
				{
					show_msg('删除成功','user_list.php');
				}
				else
				{
					show_msg('请重试','user_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','user_list.php');
		}
	
	
	}
?>

</body>
</html>
