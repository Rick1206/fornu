<?php
/**
 * news list
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

$pic_doc = 'news';
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
		if(!@$param["del_news"])
		{
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form2" name="form2" method="get" action="news_list.php">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="486" background="../../images/i_m_t.jpg">优路新闻&gt;&gt;新闻列表</td>
    
  </tr>
  </form>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" colspan="2" valign="top">
	  <form id="form1" name="form1" method="post" action="news_list.php" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td width="7" bgcolor="#999999" >&nbsp;</td>
          <td colspan="4" class="m_t_c">新闻列表</td>
          <td class="m_t_c"><div align="right"><img src="../../images/add.jpg" /></div></td>
          <td class="m_t_c"><a href="news_add.php" style="color:#000;">添加新闻</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="26" height="30"><input type="checkbox" name="chkall" id="chkall" onclick="checkall(this.form)" /></td>
          <td width="52">全选</td>
		  <td width="98"></td>
		  <td width="540">标题</td>
          <td width="117">日期</td>
          <td width="94">操作</td>
        </tr>
        <?php
			$where = empty($news_type) ? "" : " WHERE news_type = '".$news_type."'";
			//to list news information
            $all_date_num = page_1::page_all_num('news',$where);
            //$last_page = intval (($all_date_num - 1) / $page_a) + 1; //获得总页数
            $page = isset($_GET['page']) ? $_GET['page'] : 1 ;	
            $offset = ($page - 1) * $page_a;
            $user_list = page_1::page_array('news',$where,' ORDER BY orderby, dateline DESC, news_id DESC',$offset,$page_a);
            foreach($user_list as $k=>$v)
            {
        ?>
        <tr>
          <td>&nbsp;</td>
          <td height="25">&nbsp;</td>
          <td><input type="checkbox" name="del_news_a[]" value="<?php echo $v['news_id']; ?>" /></td>
          <td></td>
          <!--<td><php echo $_news_type[$v['news_type']];?></td>-->
          <td><?php echo $v['title_cn'] ? $v['title_cn'] : $v['title_en'];?></td>
          <td><?php echo $v['dateline'];?></td>
          <td><a href="news_modify.php?news_id=<?php echo $v['news_id'];?>"><img src="../../images/modify.gif" width="16" height="16" border="0" alt="<?php echo $_L['edit'];?>" title="<?php echo $_L['edit'];?>" /></a></td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td></td>
          <td height="25" colspan="6">
          <?php 
            echo page::page_num($all_date_num,$page_a,$page,'news_list.php');
          ?>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="9" align="center">
            <input type="submit" name="del_news" id="del_news" value="删除" />   
            <input type="button" name="rfd" id="rfd" onclick="window.location.reload();" value="刷新" /></td>
        </tr>
      </table>
	  </form>
    </td>
  </tr>
</table>
<?php
	}
	else{
		if(isset($param['del_news_a'])){
			
			if( isset($param['del_news_a']) && is_array($param['del_news_a'])){
				//删除数据
				foreach($param['del_news_a'] as $k){
					$back_data = $db->query("DELETE FROM ".$ros->table('news')." WHERE news_id = '$k'");
				}
				//返回结果
				if($back_data){
					show_msg('删除成功','news_list.php');
				}
				else{
					show_msg('请重试','news_list.php');
				}	
			}
		}
		else{
			show_msg('没有选中删除项','news_list.php');
		}
	}
?>
</body>
</html>
