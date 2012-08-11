<?php
/**
 * modify about information
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

$pic_doc = 'about';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_about_id = isset($_GET["about_id"]) ? $_GET["about_id"] : "";
if(empty($get_about_id))
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
	if($get_about_id != '')
	{
			//$about_id = $_GET['about_id'];
			$sql = 'SELECT * FROM '.$ros->table('about'). 'WHERE about_id='.$get_about_id;
			$about_info = $db->getAll($sql);
			foreach($about_info as $k=>$v)
			{
				$about_year = $v['year'];
				$about_photo = $v['photo'];
				$about_description_en = html_entity_decode($v['description_en']);
				$about_description_cn = html_entity_decode($v['description_cn']);
				$about_description_gb = html_entity_decode($v['description_gb']);
				$about_orderby = $v['orderby'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_about" id="modify_about">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    协鑫集团&gt;&gt;
    <a href="about_list.php" id="module_link">奖项殊荣列表</a>
    &gt;&gt;修改奖项殊荣</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">  
         <tr>
           <td width="18%" align="right">年份：</td>
          <td width="82%" height="30"><label>
            <input type="text" name="year" value="<?php echo $about_year;?>" size="4" /> 
          </label></td>
        </tr>  
        <tr>
          <td width="20%" align="right">图片：</td>
          <td width="80%" height="30">
		  <a href="<?php echo $attachdir.$about_photo?>" target="_blank" id="module_link"><?php echo $about_photo?></a><br>
          <input name="photo[]" type="file" size="50"><br />
          ('gif','jpg','jpeg','png',尺寸:60*47px)
          <input type="hidden" name="about_photo" value="<?php echo $about_photo;?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top">详细描述(英文)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_en') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $about_description_en;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'en' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td align="right" valign="top">详细描述(简体中文)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_cn') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $about_description_cn;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td align="right" valign="top">详细描述(繁体中文)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_gb') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $about_description_gb;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td width="20%" height="20" align="right">排序：</td>
          <td width="80%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $about_orderby?>" size="1" />
          </label></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_about" value="保存" />
            <input type="hidden" name="action" value="modify_about" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_about')
	{
	  if(!empty($get_about_id) )
	  {	
	  
		  $attachment     = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic = $v['attachment'];
				}
				//$pic = resize_image($pic,$pic,54,47,$attachdir);
				@unlink($attachdir.$param['about_photo']);
				$db->query("UPDATE ".$ros->table('about')." SET photo='".$pic."' WHERE about_id='$get_about_id'");
		  }
		  		  
	  
		  $back_data = $db->query("UPDATE ".$ros->table('about')." SET year='".$param['year']."', description_en='".htmlspecialchars($param['description_en'])."', description_cn='".htmlspecialchars($param['description_cn'])."', description_gb='".htmlspecialchars($param['description_gb'])."', orderby='".$param['orderby']."' WHERE about_id='$get_about_id'");
		  
		  if( $back_data )
		  {
			show_msg('修改成功','about_list.php');
		  }
		  else
		  {
			 show_msg('请重试','about_list.php');
		  }
	  }
	}
?>
</body>
</html>
