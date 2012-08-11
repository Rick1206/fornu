<?php
/**
 * add diary information
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
require('../../FCKeditor/fckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: login.php');
	exit();
}
$pic_doc = 'diary';
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
   // to add diary information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
	
?>
<form method="post" enctype="multipart/form-data" name="add_diary" id="add_diary">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    成长日记&gt;&gt;<a href="diary_list.php" id="module_link">日记列表</a>&gt;&gt;添加日记</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
          <td height="20" align="right">日期：</td>
          <td height="30">
          <input type="text" name="add_time" id="add_time" onFocus="HS_setDate(this)" readonly="readonly" value="<?php echo $now_date;?>" />          </td>
        </tr>
        
       <tr>
          <td height="20" align="right">图片:</td>
          <td height="30"><input name="photo[]" type="file" size="40"> 
          ('gif','jpg','jpeg','png',Size:478*281px)</td>
        </tr>
        
        <tr>
          <td height="20" align="right">缩略图:</td>
          <td height="30"><input name="thumbnail[]" type="file" size="40"> 
          ('gif','jpg','jpeg','png',Size:157*84px)</td>
        </tr>
        
        <tr>
          <td width="20%" height="20" align="right">标题(英文)：</td>
          <td width="80%" height="30"><label>
            <input name="title_en" type="text" class="input_add" />
          </label></td>
        </tr>
          <tr>
          <td width="20%" height="30" align="right">简介(英文)：</td>
          <td width="80%" height="65"><label>
            <textarea name="intro_en" type="text" class="input_text" /></textarea>
          </label></td>
        </tr>

        <tr>
          <td width="20%" height="20" align="right">标题(简体中文)：</td>
          <td width="80%" height="30"><label>
            <input name="title_cn" type="text" class="input_add" />
          </label></td>
        </tr>
        
         <tr>
          <td width="20%" height="30" align="right">简介(简体中文)：</td>
          <td width="80%" height="65"><label>
            <textarea name="intro_cn" type="text" class="input_text" /></textarea>
          </label></td>
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
            $oFCKeditor->Config['DefaultLanguage']		= 'en' ;
            $oFCKeditor->Height		=150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_diary" value="保存" />
            <input type="hidden" name="action" value="add_diary" />            </td>
        </tr>
      </table>
    </td>
  </tr>
</table> 
</form>
<?php
	}
	elseif($action == 'add_diary')
	{
	
		$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		if($attachment_s){
			foreach($attachments_arg_s as $k => $v)
			{
				$pic = $v['attachment'];
			}
			
			$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'thumbnail')) ? 1 : 0;
			if($attachment_s){
				$pic2 = $attachments_arg_s[0]['attachment'];
			} else {
				$pic2 = "";
			}
	
	$back_data = $db->query("INSERT INTO ".$ros->table('diary')." ( title_en, intro_en, title_cn, intro_cn, description_en, description_cn, dateline, photo, image) VALUES ('".$param['title_en']."','".$param['intro_en']."', '".$param['title_cn']."', '".$param['intro_cn']."','".htmlspecialchars($param['description_en'])."', '".htmlspecialchars($param['description_cn'])."', '".$param['add_time']."','".$pic."','".$pic2."')");
			if($back_data)
			{
				show_msg('添加成功','diary_add.php');  
			}
			else
			{
				show_msg('请重试','diary_add.php');
			}
			
			} else {
				show_msg('图片上传失败!','diary_add.php');
		}
	}
?>   
</body>
</html>
