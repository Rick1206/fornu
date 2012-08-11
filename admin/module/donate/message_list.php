<?php
/**
 * message list
 * ============================================================================
 * powered by Rick
 * http://www.digitalcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick shi 
 * $email:1491361147@qq.com
 *
*/
define('IN_SK',true);
require('../../includes/init.php');	
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

$pic_doc = 'message';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

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
		if(!@$param["del_message"])
		{
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form2" name="form2" method="get" action="message_list.php">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="486" background="../../images/i_m_t.jpg">爱心捐献&gt;&gt;爱心赠言</td>
    
  </tr>
  </form>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" colspan="2" valign="top">
	  <form id="form1" name="form1" method="post" action="message_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="4" class="m_t_c">爱心赠言</td>
          <td class="m_t_c"></td>
          <td class="m_t_c"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="26" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="52">全选</td>
		  <td width="228">用户名</td>
		  <td width="360">赠言</td>
       
          <td width="150">日期</td>
          <td width="111"></td>
        </tr>
        <?php
				$conditions = "";
		$and = " WHERE";
		if (isset($_GET['formdate']) || isset($_GET['todate'])) {
			if (isset($_GET['formdate']) && $_GET['formdate'] != "") {
				$conditions .= $and." dateline>='".$_GET['formdate']."'";
				$and = " AND";
			}
			if (isset($_GET['todate']) && $_GET['todate'] != "") {
				$conditions .= $and." dateline<='".$_GET['todate']."'";
				$and = " AND";
			}
		} elseif (isset($_GET['job_id']) && $_GET['job_id']!="") {
			$conditions .= $and." job_id='".$_GET['job_id']."'";
			$and = " AND";
		}
			
			//$where = empty($message_type) ? "" : " WHERE message_type = '".$message_type."'";
			//to list message information
			$where = '';
            $all_date_num = page_1::page_all_num('message',$conditions);
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('message',$conditions,' ORDER BY dateline DESC, message_id DESC',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_message_a[]" value="<?php echo $v['message_id']; ?>" /></td>
          <td><?php echo $v['uname'];?></td>
          <td><?php echo cut_str($v['umessage_cn'],40);?></td>
    
          <td><?php echo $v['dateline'];?></td>
          <td></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="6">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'message_list.php');
          ?>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="9" align="center">
            <input type="submit" name="del_message" id="del_message" value="删除" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" /></td>
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
	
		if(isset($param['del_message_a']))
		{
			
			if( isset($param['del_message_a']) && is_array($param['del_message_a']))
			{
				//删除数据
				foreach($param['del_message_a'] as $k)
				{
					$back_data = $db->query("DELETE FROM ".$ros->table('message')." WHERE message_id = '$k'");
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','message_list.php');
				}
				else
				{
					show_msg('请重试','message_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','message_list.php');
		}
	
	
	}
?>
</body>
</html>
