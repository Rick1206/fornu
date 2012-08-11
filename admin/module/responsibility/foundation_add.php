<?php
/**
 * add foundation information
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
   // to add foundation information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_foundation" id="add_foundation">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    企业公民&gt;&gt;<a href="foundation_list.php" id="module_link">协鑫阳光慈善基金列表</a>&gt;&gt;添加协鑫阳光慈善基金</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="15%" height="20" align="right">标题(英文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_en" type="text" class="input_add" />
          </label></td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">标题(简体中文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_cn" type="text" class="input_add" />
          </label></td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">标题(繁体中文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_gb" type="text" class="input_add" />
          </label></td>
        </tr>
        <tr>
          <td height="20" align="right">图片：</td>
          <td height="30"><input name="photo[]" type="file" size="50">
            ('gif','jpg','jpeg','png',尺寸:170*130px)</td>
        </tr>
          <tr>
          <td height="20" align="right" valign="top">描述(英语)：</td>
          <td height="30" valign="top">
          <?php
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_en') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= '' ;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'en' ;
            $oFCKeditor->Height		=150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
          <tr>
          <td height="20" align="right" valign="top">描述(简体中文)：</td>
          <td height="30" valign="top">
          <?php
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_cn') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= '' ;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		=150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
          <tr>
          <td height="20" align="right" valign="top">描述(繁体中文)：</td>
          <td height="30" valign="top">
          <?php
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_gb') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= '' ;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		=150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">排序：</td>
          <td width="85%" height="30"><label>
            <input name="orderby" type="text" value="0" size="1" />
          </label></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_foundation" value="保存" />
            <input type="hidden" name="action" value="add_foundation" />            </td>
        </tr>
      </table>
    </td>
  </tr>
</table> 
</form>
<?php
	}
	elseif($action == 'add_foundation')
	{
	
		//上传图片
		$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		if($attachment_s){
		
			foreach($attachments_arg_s as $k => $v)
			{
				$pic = $v['attachment'];
			}
			
			$back_data = $db->query("INSERT INTO ".$ros->table('foundation')." (title_en, title_cn, title_gb, photo, description_en, description_cn, description_gb, orderby) VALUES ('".$param['title_en']."', '".$param['title_cn']."', '".$param['title_gb']."', '".$pic."', '".htmlspecialchars($param['description_en'])."', '".htmlspecialchars($param['description_cn'])."', '".htmlspecialchars($param['description_gb'])."', '".$param['orderby']."')");
			if($back_data)
			{
				show_msg('添加成功','foundation_add.php');  
			}
			else
			{
				show_msg('请重试','foundation_add.php');
			}
		} else {
			show_msg('图片上传失败','foundation_add.php');
		}
		
	}
?>   
</body>
</html>
