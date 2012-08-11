<?php
/**
 * unsubscribe list
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
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
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
<script src="../../js/time_cn.js" language="javascript"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">E-news&gt;&gt;Unsubscribe List</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" valign="top">
    <?php
		if(!@$param["del_unsubscribe"])
		{
	?>
    <form id="form1" name="form1" method="post" action="unsubscribe_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="6" bgcolor="#999999" >&nbsp;</td>
          <td colspan="5" class="m_t_c">Unsubscribe List</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="25" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="72">All</td>
		  <td width="300">Email</td>
          <td width="300">Enewsletter Date</td>
          <td width="231">Unsubscribe Date</td>
        </tr>
        <?php
			//to list unsubscribe information
            $all_date_num = page_1::page_all_num('unsubscribe','');
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('unsubscribe','',' ORDER BY unreg_time DESC, uid DESC',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_unsubscribe_a[]" value="<?php echo $v['uid']; ?>" /></td>
          <td><?php echo $v['email'];?></td>
          <td><?php echo $v['reg_time'];?></td>
          <td><?php echo $v['unreg_time'];?></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="5">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'unsubscribe_list.php');
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="8" align="center">
            <input type="submit" name="del_unsubscribe" id="del_unsubscribe" value="Delete" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="Refresh" />
			<input type="button" name="btn_print" id="btn_print" value="export" onclick="window.open('unsubscribe_export.php')"></td>
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
	
		if(isset($param['del_unsubscribe_a']))
		{
			
			if( isset($param['del_unsubscribe_a']) && is_array($param['del_unsubscribe_a']))
			{
				//删除数据
				foreach($param['del_unsubscribe_a'] as $k)
				{
					$back_data = $db->query('DELETE FROM '.$ros->table('unsubscribe').' WHERE uid='.$k);
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('Delete Success!','unsubscribe_list.php');
				}
				else
				{
					show_msg('Please Retry!','unsubscribe_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('No Delete Item!','unsubscribe_list.php');
		}
	
	
	}
?>
</body>
</html>
