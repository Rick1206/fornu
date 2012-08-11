<?php
/**
 * add milestone information
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

$pic_doc = 'milestone';
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
   // to add milestone information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_milestone" id="add_milestone">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    协鑫集团&gt;&gt;<a href="milestone_list.php" id="module_link">协鑫历史列表</a>&gt;&gt;添加协鑫历史</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="20%" height="20" align="right">时间：</td>
          <td width="80%" height="30"><input name="year" type="text" id="year" size="4" value="<?php echo date("Y");?>" /> - 
            <input name="month" type="text" id="month" size="2" value="<?php echo date("m");?>" /></td>
        </tr>  
        <tr>
          <td height="20" align="right">图片：</td>
          <td height="30"><input name="photo[]" type="file" size="50">
            <br />
          ('gif','jpg','jpeg','png',尺寸:100*66px)</td>
        </tr>
          <tr>
          <td height="20" align="right" valign="top">详细描述(英文)：</td>
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
          <td height="20" align="right" valign="top">详细描述(简体中文)：</td>
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
          <td height="20" align="right" valign="top">详细描述(繁体中文)：</td>
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
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_milestone" value="保存" />
            <input type="hidden" name="action" value="add_milestone" />            </td>
        </tr>
      </table>
    </td>
  </tr>
</table> 
</form>
<?php
	}
	elseif($action == 'add_milestone')
	{
	
		//上传图片
		$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		if(!$attachment_s){
		
			$pic = "";
			
		} else {
			
			foreach($attachments_arg_s as $k => $v)
			{
				$pic = $v['attachment'];
			}
			//$pic = resize_image($pic,$pic,54,47,$attachdir);
		}

			$dateline = $param['year']."-".$param['month']."-01";
			
			$back_data = $db->query("INSERT INTO ".$ros->table('milestone')." (dateline, photo, description_en, description_cn, description_gb) VALUES ('".$dateline."', '".$pic."', '".htmlspecialchars($param['description_en'])."', '".htmlspecialchars($param['description_cn'])."', '".htmlspecialchars($param['description_gb'])."')");
			if($back_data)
			{
				//milestone_xml();
				show_msg('添加成功','milestone_add.php');  
			}
			else
			{
				show_msg('请重试','milestone_add.php');
			}
		
	}
?>   
</body>
</html>
