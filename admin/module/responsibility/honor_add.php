<?php
/**
 * add honor information
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
require('../../FCKeditor/fckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: login.php');
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
   // to add honor information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_honor" id="add_honor">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    企业公民&gt;&gt;<a href="honor_list.php" id="module_link">奖项荣誉列表</a>&gt;&gt;添加奖项荣誉</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td width="18%" height="20" align="right">年份：</td>
          <td width="82%" height="30"><label>
            <input name="year" type="text" value="<?php echo date("Y");?>" size="4" />
          </label></td>
        </tr>  
        <tr>
          <td width="18%" height="20" align="right">标题(英文)：</td>
          <td width="82%" height="30"><label>
            <input name="title_en" type="text" class="input_add" />
          </label></td>
        </tr>  
          <tr>
            <td height="20" align="right">标题(简体中文)：</td>
            <td height="30"><label>
              <input name="title_cn" type="text" class="input_add" />
            </label></td>
          </tr>
          <tr>
            <td height="20" align="right">标题(繁体中文)：</td>
            <td height="30"><label>
              <input name="title_gb" type="text" class="input_add" />
            </label></td>
          </tr>
        <tr>
          <td width="18%" height="20" align="right">详细介绍(英文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_en" class="input_text"></textarea>
          </label></td>
        </tr>  
        <tr>
          <td width="18%" height="20" align="right">详细介绍(简体中文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_cn" class="input_text"></textarea>
          </label></td>
        </tr>
        <tr>
          <td width="18%" height="20" align="right">详细介绍(繁体中文)：</td>
          <td width="82%" height="30"><label>
            <textarea name="detail_gb" class="input_text"></textarea>
          </label></td>
        </tr>
        <tr>
          <td width="18%" height="20" align="right">排序：</td>
          <td width="82%" height="30"><label>
            <input name="orderby" type="text" value="0" size="1" />
          </label></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_honor" value="保存" />
            <input type="hidden" name="action" value="add_honor" />            </td>
        </tr>
      </table>
    </td>
  </tr>
</table> 
</form>
<?php
	}
	elseif($action == 'add_honor')
	{
	
			$back_data = $db->query("INSERT INTO ".$ros->table('honor')." (year, title_en, title_cn, title_gb, detail_en, detail_cn, detail_gb, orderby) VALUES ('".$param['year']."', '".$param['title_en']."', '".$param['title_cn']."', '".$param['title_gb']."', '".$param['detail_en']."', '".$param['detail_cn']."', '".$param['detail_gb']."', '".$param['orderby']."')");
			if($back_data)
			{
				//honor_xml();
				show_msg('添加成功','honor_add.php');  
			}
			else
			{
				show_msg('请重试','honor_add.php');
			}
	}
?>   
</body>
</html>
