<?php
/**
 * transfer list
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
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

$pic_doc = 'transfer';
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
		if(!@$param["del_transfer"])
		{
			//$lan_type = isset($_GET["lan_type"]) ? $_GET["lan_type"] : "";
			//echo $lan_type;
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form2" name="form2" method="get" action="transfer_list.php">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="486" background="../../images/i_m_t.jpg">转送申请&gt;&gt;申请列表</td>
  </tr>
  </form>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" colspan="2" valign="top">
	  <form id="form1" name="form1" method="post" action="transfer_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="5" class="m_t_c">申请列表</td>
          <td class="m_t_c"></td>
          <td class="m_t_c"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="26" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="52">全选</td>
		  <td width="198">申请人姓名</td>
		  <td width="240">联系方式</td>
          <td width="100">物品名称</td>
          <td width="117">数量</td>
          <td width="94">操作</td>
        </tr>
        <?php
			//echo $lan_type;
			//$where = ($lan_type!="") ? ' WHERE lan = "'.$lan_type.'"' :"";
			$where = "";
			//echo $where;
             //to list event information
           	$all_date_num = page_1::page_all_num('transfer',$where);
			//echo $all_date_num;
             //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
			$query = $db->query("SELECT * FROM ".$ros->table('transfer')." $where ORDER BY dateline Desc LIMIT $offset, $page_a");
			while($this_sql = $db->fetch_array($query))
			{
        ?>
         <tr>
              <td>&nbsp;</td>
              <td height="25">&nbsp;</td>
              <td><input type="checkbox" name="del_transfer_a[]" value="<?php echo $this_sql['transfer_id']; ?>" /></td>
			  <td><?php echo $this_sql['tname'];?></td>
              <td><?php echo $this_sql['tcontact']?></td>
              
              <td></td>
              <td><?php echo $this_sql['tcount']?></td>
              <td><a href="transfer_modify.php?transfer_id=<?php echo $this_sql['transfer_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
            </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="7">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'transfer_list.php');
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="10" align="center">
            <input type="submit" name="del_transfer" id="del_transfer" value="删除" />   
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
	
		if(isset($param['del_transfer_a']))
		{
			
			if( isset($param['del_transfer_a']) && is_array($param['del_transfer_a']))
			{
				//删除数据
				foreach($param['del_transfer_a'] as $k)
				{
					$back_data = $db->query("DELETE FROM ".$ros->table('transfer')." WHERE transfer_id = '$k'");
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','transfer_list.php');
				}
				else
				{
					show_msg('请重试','transfer_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','transfer_list.php');
		}
	
	
	}
?>
</body>
</html>
