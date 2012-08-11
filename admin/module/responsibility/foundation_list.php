<?php
/**
 * foundation list
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

$pic_doc = 'foundation';
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
	if(!@$param["del_foundation"])
	{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td background="../../images/i_m_t.jpg">企业公民&gt;&gt;协鑫阳光慈善基金列表</td>
    </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" valign="top">
    <form id="form1" name="form1" method="post" action="foundation_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="2" class="m_t_c">协鑫阳光慈善基金列表</td>
          <td colspan="2" class="m_t_c"><div align="right"><img src="../../images/add.jpg" /></div></td>
          <td class="m_t_c"><a href="foundation_add.php" style="color:#000;">添加协鑫阳光慈善基金</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="46" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="134">全选</td>
          <td width="496">标题</td>
          <td width="96">排序</td>
          <td width="154">操作</td>
        </tr>
        <?php
			//to list foundation information
            $all_date_num = page_1::page_all_num('foundation','');
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('foundation','',' ORDER BY orderby, foundation_id',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_foundation_a[]" value="<?php echo $v['foundation_id']; ?>" /></td>
          <td><?php echo $v['title_cn'] ? $v['title_cn'] : $v['title_en'];?></td>
          <td><?php echo $v['orderby'];?>&nbsp;</td>
          <td><a href="foundation_modify.php?foundation_id=<?php echo $v['foundation_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="5">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'foundation_list.php');
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="8" align="center">
            <input type="submit" name="del_foundation" id="del_foundation" value="删除" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" /></td>
        </tr>
      </table>
      </form>    </td>
  </tr>
</table>
<?php
	}
	else
	{
	
		if(isset($param['del_foundation_a']))
		{
			
			if( isset($param['del_foundation_a']) && is_array($param['del_foundation_a']))
			{
				//删除数据
				foreach($param['del_foundation_a'] as $k)
				{
					$sql = 'SELECT photo FROM '.$ros->table('foundation'). 'WHERE foundation_id='.$k;
					$foundation_info = $db->getAll($sql);
					@unlink($attachdir.$foundation_info[0]['photo']);
					$back_data = $db->query('DELETE FROM '.$ros->table('foundation').' WHERE foundation_id='.$k);
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','foundation_list.php');
				}
				else
				{
					show_msg('请重试','foundation_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','foundation_list.php');
		}
	
	
	}
?>
</body>
</html>
