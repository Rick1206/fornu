<?php
/**
 * banner list
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

$pic_doc = 'banners';
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
		if(!@$param["del_banner"])
		{
			$lan_type = isset($_GET["lan_type"]) ? $_GET["lan_type"] : "";
			//echo $lan_type;
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form2" name="form2" method="get" action="banners_list.php">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="486" background="../../images/i_m_t.jpg">首页&gt;&gt;Banner列表</td>
    <td width="486" background="../../images/i_m_t.jpg"><div align="right"><label>
          类别:
                <select name="lan_type" id="lan_type">
                  <option value="" >All</option>
                  <?php
				  foreach ($lan as $key => $value) {  
				  ?>
                 <option value="<?php echo $key?>"<?php echo $lan_type==$key ? ' selected="selected"' : '' ?>><?php echo $value?></option>
                  <?php
				  }
				  ?>
                </select>
                <input type="submit" name="search" id="search" value="搜索" />
        </label>&nbsp;</div>
      </td>
  </tr>
  </form>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" colspan="2" valign="top">
	  <form id="form1" name="form1" method="post" action="banners_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="4" class="m_t_c">Banner列表</td>
          <td class="m_t_c"><div align="right"><img src="../../images/add.jpg" /></div></td>
          <td class="m_t_c"><a href="banners_add.php" style="color:#000;">添加Banner</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="26" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="52">全选</td>
		  <td width="98">语言</td>
		  <td width="540">图片</td>
          <td width="117">顺序</td>
          <td width="94">操作</td>
        </tr>
        <?php
			//echo $lan_type;
			$where = ($lan_type!="") ? ' WHERE lan = "'.$lan_type.'"' :"";
			//echo $where;
             //to list event information
           	$all_date_num = page_1::page_all_num('banners',$where);
			//echo $all_date_num;
             //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
			$query = $db->query("SELECT * FROM ".$ros->table('banners')." $where ORDER BY lan, orderby LIMIT $offset, $page_a");
			while($this_sql = $db->fetch_array($query))
			{
        ?>
         <tr>
              <td>&nbsp;</td>
              <td height="25">&nbsp;</td>
              <td><input type="checkbox" name="del_banner_a[]" value="<?php echo $this_sql['banner_id']; ?>" /></td>
			  <td><?php echo $lan[$this_sql['lan']];?></td>
              <td><img src="<?php echo $attachdir.$this_sql['photo']?>" width="180" height="54" /></td>
              <td><?php echo $this_sql['orderby'];?></td>
              <td><a href="banners_modify.php?banner_id=<?php echo $this_sql['banner_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
            </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="6">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'banners_list.php?lan_type='.$lan_type);
          ?>          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="9" align="center">
            <input type="submit" name="del_banner" id="del_banner" value="删除" />   
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
	
		if(isset($param['del_banner_a']))
		{
			
			if( isset($param['del_banner_a']) && is_array($param['del_banner_a']))
			{
				//删除数据
				foreach($param['del_banner_a'] as $k)
				{
					$back_data = $db->query("DELETE FROM ".$ros->table('banners')." WHERE banner_id = '$k'");
				}
				
				//返回结果
				if($back_data)
				{
					show_msg('删除成功','banners_list.php');
				}
				else
				{
					show_msg('请重试','banners_list.php');
				}
				
			}
			
		}
		else
		{
			show_msg('没有选中删除项','banners_list.php');
		}
	
	
	}
?>
</body>
</html>
