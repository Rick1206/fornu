<?php
/**
 * honor list
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

$pic_doc = 'honor';
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
	if(!@$param["del_honor"])
	{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td background="../../images/i_m_t.jpg">企业公民&gt;&gt;奖项荣誉列表</td>
  </tr>
  </form>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" valign="top">
	  <form id="form1" name="form1" method="post" action="honor_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="3" class="m_t_c">奖项荣誉列表</td>
          <td colspan="2" class="m_t_c"><div align="right"><img src="../../images/add.jpg" /></div></td>
          <td class="m_t_c"><a href="honor_add.php" style="color:#000;">添加奖项荣誉</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="29" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="56">全选</td>
          <td width="139">年份</td>
          <td width="682">标题</td>
          <td width="133">排序</td>
          <td width="153">操作</td>
        </tr>
        <?php
			//$where = (empty($honor_type) ? "" : " WHERE honor_type='".$honor_type."'");//to list news information
			//to list honor information
            $all_date_num = page_1::page_all_num('honor','');
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('honor','',' ORDER BY year, orderby, honor_id',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_honor_a[]" value="<?php echo $v['honor_id']; ?>" /></td>
          <td><?php echo $v['year'];?>&nbsp;</td>
          <td><?php echo $v['title_cn'] ? $v['title_cn'] : $v['title_en'];?></td>
          <td><?php echo $v['orderby'];?>&nbsp;</td>
          <td><a href="honor_modify.php?honor_id=<?php echo $v['honor_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="6">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'honor_list.php');
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="9" align="center">
            <input type="submit" name="del_honor" id="del_honor" value="删除" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" /></td>
        </tr>
      </table>
	  </form>	</td>
  </tr>
</table>

<?php
	}
	else
	{
	
		if(isset($param['del_honor_a']))
		{
			
			if( isset($param['del_honor_a']) && is_array($param['del_honor_a']))
			{
				//删除数据
				foreach($param['del_honor_a'] as $k)
				{
					$back_data = $db->query('DELETE FROM '.$ros->table('honor').' WHERE honor_id='.$k);
				}
				
				//返回结果
				if($back_data)
				{
					//honor_xml();
					show_msg('删除成功','honor_list.php');
				}
				else
				{
					show_msg('请重试','honor_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','honor_list.php');
		}
	
	
	}
?>
</body>
</html>
