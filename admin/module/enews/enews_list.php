<?php
/**
 * enews list
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
    <td width="972" background="../../images/i_m_t.jpg">邮件订阅&gt;&gt;<a href="enews.php" id="module_link">邮件列表查询</a>&gt;&gt;邮件列表查询结果列表</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" valign="top">
    <?php
	$url_add = "";
	$url_link = "?";
	if (isset($_GET['formdate']) && $_GET['formdate'] != "") {
		$url_add .= $url_link."formdate=".$_GET['formdate'];
		$url_link = "&";
	}
	if (isset($_GET['todate']) && $_GET['todate'] != "") {
		$url_add .= $url_link."todate=".$_GET['todate'];
		$url_link = "&";
	}
	if (isset($_GET['email']) && $_GET['email'] != "") {
		$url_add .= $url_link."email=".$_GET['email'];
	}			
		if(!@$param["del_enews"])
		{
	?>
    <form id="form1" name="form1" method="post" action="enews_list.php<?php echo $url_add;?>" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="8" bgcolor="#999999" >&nbsp;</td>
          <td colspan="4" class="m_t_c">邮件列表查询结果列表</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="29" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="88">全选</td>
		  <td width="468">邮件地址</td>
          <td width="341">注册时间</td>
        </tr>
        <?php
		$conditions = "";
		$and = " WHERE";
		if (isset($_GET['formdate']) || isset($_GET['todate'])) {
			if (isset($_GET['formdate']) && $_GET['formdate'] != "") {
				$conditions .= $and." reg_time>='".$_GET['formdate']."'";
				$and = " AND";
			}
			if (isset($_GET['todate']) && $_GET['todate'] != "") {
				$conditions .= $and." reg_time<='".$_GET['todate']."'";
				$and = " AND";
			}
		} elseif (isset($_GET['email']) && $_GET['email']!="") {
			$conditions .= $and." (email LIKE '%".$_GET['email']."%' OR email='".$_GET['email']."')";
			$and = " AND";
		}
			//to list enews information
            $all_date_num = page_1::page_all_num('enews',$conditions);
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('enews',$conditions,' ORDER BY reg_time DESC, eid DESC',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_enews_a[]" value="<?php echo $v['eid']; ?>" /></td>
          <td><?php echo $v['email'];?></td>
          <td><?php echo $v['reg_time'];?></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="4">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'enews_list.php'.$url_add);
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="8" align="center">
            <input type="submit" name="del_enews" id="del_enews" value="删除" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" />
			<input type="button" name="btn_print" id="btn_print" value="导出结果" onclick="window.open('enews_export.php<?php echo $url_add;?>')">
			</td>
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
	
		if(isset($param['del_enews_a']))
		{
			
			if( isset($param['del_enews_a']) && is_array($param['del_enews_a']))
			{
				//删除数据
				foreach($param['del_enews_a'] as $k)
				{
					$back_data = $db->query('DELETE FROM '.$ros->table('enews').' WHERE eid='.$k);
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','enews_list.php'.$url_add);
				}
				else
				{
					show_msg('请重试','enews_list.php'.$url_add);
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','enews_list.php'.$url_add);
		}
	
	
	}
?>
</body>
</html>
