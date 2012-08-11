<?php
/**
 * modify honor information
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
require('../../FCKeditor/fckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

$pic_doc = 'honor';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_honor_id = isset($_GET["honor_id"]) ? $_GET["honor_id"] : "";
if(empty($get_honor_id))
{
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
<?php
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
	if($get_honor_id != '')
	{
			//$honor_id = $_GET['honor_id'];
			$sql = 'SELECT * FROM '.$ros->table('honor'). 'WHERE honor_id='.$get_honor_id;
			$honor_info = $db->getAll($sql);
			foreach($honor_info as $k=>$v)
			{
				$honor_year = $v['year'];
				$honor_title_en = $v['title_en'];
				$honor_title_cn = $v['title_cn'];
				$honor_title_gb = $v['title_gb'];
				$honor_detail_en = $v['detail_en'];
				$honor_detail_cn = $v['detail_cn'];
				$honor_detail_gb = $v['detail_gb'];
				$honor_orderby = $v['orderby'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_honor" id="modify_honor">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    企业公民&gt;&gt;
    <a href="honor_list.php" id="module_link">奖项荣誉列表</a>
    &gt;&gt;修改奖项荣誉</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td width="18%" align="right">年份：</td>
          <td width="82%" height="30"><label>
            <input type="text" name="year" value="<?php echo $honor_year;?>" size="4" /> 
          </label></td>
        </tr>  
        <tr>
          <td width="18%" align="right">标题(英文)：</td>
          <td width="82%" height="30"><label>
            <input name="title_en" type="text"  value="<?php echo $honor_title_en; ?>" class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td width="18%" align="right">标题(简体中文)：</td>
          <td width="82%" height="30"><label>
            <input name="title_cn" type="text"  value="<?php echo $honor_title_cn; ?>" class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td width="18%" align="right">标题(繁体中文)：</td>
          <td width="82%" height="30"><label>
            <input name="title_gb" type="text"  value="<?php echo $honor_title_gb; ?>" class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td width="18%" align="right">详细介绍(英文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_en" class="input_text"><?php echo $honor_detail_en;?></textarea>
          </label></td>
        </tr>  
        <tr>
          <td width="18%" align="right">详细介绍(简体中文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_cn" class="input_text"><?php echo $honor_detail_cn;?></textarea>
          </label></td>
        </tr>
        <tr>
          <td width="18%" align="right">详细介绍(繁体中文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_gb" class="input_text"><?php echo $honor_detail_gb;?></textarea>
          </label></td>
        </tr>
        <tr>
          <td width="18%" height="20" align="right">排序：</td>
          <td width="82%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $honor_orderby;?>" size="1" />
          </label></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_honor" value="保存" />
            <input type="hidden" name="action" value="modify_honor" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_honor')
	{
	  if(!empty($get_honor_id) )
	  {		  		  
		  $back_data = $db->query("UPDATE ".$ros->table('honor')." SET year='".$param['year']."', title_en='".$param['title_en']."', title_cn='".$param['title_cn']."', title_gb='".$param['title_gb']."', detail_en='".$param['detail_en']."', detail_cn='".$param['detail_cn']."', detail_gb='".$param['detail_gb']."', orderby='".$param['orderby']."' WHERE honor_id='$get_honor_id'");
		  
		  if( $back_data )
		  {
			//honor_xml();
			show_msg('修改成功','honor_list.php');
		  }
		  else
		  {
			 show_msg('请重试','honor_list.php');
		  }
	  }
	}
?>
</body>
</html>
