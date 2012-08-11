<?php
/**
 * finance list
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

//$pic_doc = 'finance';
$attachdir = "../../../uploadfiles/";

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
		if(!@$param["del_finance"])
		{
			//$lan_type = isset($_GET["lan_type"]) ? $_GET["lan_type"] : "";
			//echo $lan_type;
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form2" name="form2" method="get" action="finance_list.php">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="486" background="../../images/i_m_t.jpg">财物公开&gt;&gt;财物明细</td>
    
  </tr>
  </form>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" colspan="2" valign="top">
	  <form id="form1" name="form1" method="post" action="finance_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="5" class="m_t_c">财物明细</td>
          <td class="m_t_c"><div align="right"><img src="../../images/add.jpg" /></div></td>
          <td class="m_t_c"><a href="finance_add.php" style="color:#000;">添加明细</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="26" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="52">全选</td>
		  <td width="298">项目名称</td>
		  <td width="40"></td>
          <td width="50"></td>
          <td width="267">日期</td>
          <td width="94">操作</td>
        </tr>
        <?php
			//echo $lan_type;
			//$where = ($lan_type!="") ? ' WHERE lan = "'.$lan_type.'"' :"";
			$where = "";
			//echo $where;
             //to list event information
           	$all_date_num = page_1::page_all_num('finance',$where);
			//echo $all_date_num;
             //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
			$query = $db->query("SELECT * FROM ".$ros->table('finance')." $where LIMIT $offset, $page_a");
			while($this_sql = $db->fetch_array($query))
			{
        ?>
         <tr>
              <td>&nbsp;</td>
              <td height="25">&nbsp;</td>
              <td><input type="checkbox" name="del_finance_a[]" value="<?php echo $this_sql['finance_id']; ?>" /></td>
			  <td><?php echo $this_sql['title_cn'];?> <input type="hidden" name="del_finance_tc[]" value="<?php echo $this_sql['title_cn']; ?>" /> | <?php echo $this_sql['title_en'];?><input type="hidden" name="del_finance_te[]" value="<?php echo $this_sql['title_en']; ?>" /></td>
              <td><!--<php echo $_Ftype[$this_sql['ftype']];?>--></td>
              <td><!--<php echo $this_sql['fmoney'];?>--></td>
              <td><?php echo $this_sql['dateline'];?></td>
              <td><a href="finance_modify.php?finance_id=<?php echo $this_sql['finance_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
            </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="7">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'finance_list.php');
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="10" align="center">
            <input type="submit" name="del_finance" id="del_finance" value="删除" />   
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
	
		if(isset($param['del_finance_a']))
		{
			
			if( isset($param['del_finance_a']) && is_array($param['del_finance_a']))
			{
				//删除数据
				foreach($param['del_finance_a'] as $k)
				{
					$back_data = $db->query("DELETE FROM ".$ros->table('finance')." WHERE finance_id = '$k'");
	
				}
				
				foreach($param['del_finance_tc'] as $m){
					$delFile = $attachdir."finance_cn/".$m;
					if(file_exists($delFile)) {
						unlink($delFile);
					}
				}
				
				foreach($param['del_finance_te'] as $n){
					$delFile = $attachdir."finance_en/".$n;
					if(file_exists($delFile)) {
						unlink($delFile);
					}
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','finance_list.php');
				}
				else
				{
					show_msg('请重试','finance_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','finance_list.php');
		}
	
	
	}
?>
</body>
</html>
