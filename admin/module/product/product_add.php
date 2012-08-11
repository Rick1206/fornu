<?php
/**
 * add news information
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
require('../../FCKeditor/fckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: login.php');
	exit();
}

$pic_doc = 'product';
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
   // to add news information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_product" id="add_product">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    物资转送&gt;&gt;<a href="product_list.php" id="module_link">物资列表</a>&gt;&gt;添加物资</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
          <td height="20" align="right">物资名称(中文)：</td>
          <td height="30">
          <input name="pro_cn" type="text" class="input_add" />
          </td>
        </tr>
         <tr>
          <td height="20" align="right">物资名称(英文)：</td>
          <td height="30">
          <input name="pro_en" type="text" class="input_add" />
          </td>
        </tr>
		<tr>
          <td height="20" align="right">图片:</td>
          <td height="30"><input name="photo[]" type="file" size="40">
           <br />
           ('gif','jpg','jpeg','png',Size:81*55px)</td>
        </tr>
		<tr>
          <td height="20" align="right">物资数量:</td>
          <td height="30"><input name="count"  value="0" size="4" /></td>
        </tr>
        <tr>
          <td width="20%" height="20" align="right">Order By:</td>
          <td width="80%" height="30"><label>
            <input name="orderby" type="text" value="0" size="4" />
          </label></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_product" value="Save" />
            <input type="hidden" name="action" value="add_product" />
           </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php
	}
	elseif($action == 'add_product')
	{
		$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		if($attachment_s){
			foreach($attachments_arg_s as $k => $v){
				$pic = $v['attachment'];
			}
		} else {
			$pic = "";
			//show_msg('Photo Upload False!','product_add.php');
		}
			
			$back_data = $db->query("INSERT INTO ".$ros->table('product')." (title_cn, title_en, photo, pcount, orderby) VALUES ('".$param['pro_cn']."', '".$param['pro_en']."', '".$pic."', '".$param['count']."', '".$param['orderby']."')");
			
			if($back_data){
				show_msg('添加物资成功!','product_add.php');  
			}
			
			else
			{
				show_msg('Please Retry!','product_add.php');
			}
		
	}
?>   
</body>
</html>
