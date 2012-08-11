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
   // to add news information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_banners" id="add_banners">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    首页&gt;&gt;<a href="banners_list.php" id="module_link">Banner列表</a>&gt;&gt;添加Banner</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
          <td height="20" align="right">Lang:</td>
          <td height="30">
		  <select name="lan_type" id="lan_type">
				  <?php
				  foreach($lan as $key=>$vaule) {
				  ?>
				  <option value="<?php echo $key?>"><?php echo $vaule?></option>
				  <?php
				  }
				  ?>
                </select></td>
        </tr>
		<tr>
          <td height="20" align="right">Photo:</td>
          <td height="30"><input name="photo[]" type="file" size="40"> 
          ('gif','jpg','jpeg','png',Size:1440*426px)</td>
        </tr>
		<!--<tr>
          <td height="20" align="right">Mouse Over Photo:</td>
          <td height="30"><input name="image[]" type="file" size="40"> 
          ('gif','jpg','jpeg','png',Size:203*110px)</td>
        </tr>-->
		<tr>
          <td height="20" align="right">Link:</td>
          <td height="30"><input name="link" type="text" class="input_add" /></td>
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
            <input type="submit" name="submit" id="add_banners" value="Save" />
            <input type="hidden" name="action" value="add_banners" />
           </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php
	}
	elseif($action == 'add_banners')
	{
		$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		if($attachment_s){
			foreach($attachments_arg_s as $k => $v)
			{
				$pic = $v['attachment'];
			}
			
			/*$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'image')) ? 1 : 0;
			if($attachment_s){
				$pic2 = $attachments_arg_s[0]['attachment'];
			} else {
				$pic2 = "";
			}*/
			
			$back_data = $db->query("INSERT INTO ".$ros->table('banners')." (lan, photo, link, orderby) VALUES ('".$param['lan_type']."', '".$pic."', '".$param['link']."', '".$param['orderby']."')");
			if($back_data)
			{
				show_msg('添加Banner成功!','banners_add.php');  
			}
			else
			{
				show_msg('Please Retry!','banners_add.php');
			}
		} else {
			show_msg('Photo Upload False!','banners_add.php');
		}
	}
?>   
</body>
</html>
