<?php
/**
 * modify community information
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

$pic_doc = 'community';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_community_id = isset($_GET["community_id"]) ? $_GET["community_id"] : "";
if(empty($get_community_id))
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
	if($get_community_id != '')
	{
			//$community_id = $_GET['community_id'];
			$sql = 'SELECT * FROM '.$ros->table('community'). 'WHERE community_id='.$get_community_id;
			$community_info = $db->getAll($sql);
			foreach($community_info as $k=>$v)
			{
				$community_title_en = $v['title_en'];
				$community_title_cn = $v['title_cn'];
				$community_title_gb = $v['title_gb'];
				$community_photo = $v['photo'];
				$community_description_en = html_entity_decode($v['description_en']);
				$community_description_cn = html_entity_decode($v['description_cn']);
				$community_description_gb = html_entity_decode($v['description_gb']);
				$community_orderby = $v['orderby'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_community" id="modify_community">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    企业公民&gt;&gt;
    <a href="community_list.php" id="module_link">我们在行动列表</a>
    &gt;&gt;修改我们在行动</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="15%" height="20" align="right">标题(英文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_en" type="text"  value='<?php echo $community_title_en; ?>' class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">标题(简体中文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_cn" type="text"  value="<?php echo $community_title_cn; ?>" class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">标题(繁体中文)：</td>
          <td width="85%" height="30"><label>
            <input name="title_gb" type="text"  value="<?php echo $community_title_gb; ?>" class="input_add" >
          </label></td>
        </tr>
        <tr>
          <td align="right">图片：</td>
          <td height="30">
		  <a href="<?php echo $attachdir.$community_photo?>" target="_blank" id="module_link"><?php echo $community_photo?></a><br>
          <input name="photo[]" type="file" size="50">('gif','jpg','jpeg','png',尺寸:170*130px)
          <input type="hidden" name="community_photo" value="<?php echo $community_photo;?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top">描述(英语)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_en') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $community_description_en;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'en' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td align="right" valign="top">描述(简体中文)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_cn') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $community_description_cn;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td align="right" valign="top">描述(繁体中文)：</td>
          <td height="30">
          <?php
         
            $sBasePath = '../../FCKeditor/' ;
            $oFCKeditor = new FCKeditor('description_gb') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $community_description_gb;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'cn' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          ?>          </td>
        </tr>
        <tr>
          <td width="15%" height="20" align="right">排序：</td>
          <td width="85%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $community_orderby;?>" size="1" />
          </label></td>
        </tr>
       <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_community" value="保存" />
            <input type="hidden" name="action" value="modify_community" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_community')
	{
	  if(!empty($get_community_id) )
	  {	
		  
		  $attachment     = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic = $v['attachment'];
				}
				@unlink($attachdir.$param['community_photo']);
				$db->query("UPDATE ".$ros->table('community')." SET photo='".$pic."' WHERE community_id='$get_community_id'");
		  }
		  		  
		  $back_data = $db->query("UPDATE ".$ros->table('community')." SET title_en='".$param['title_en']."', title_cn='".$param['title_cn']."', title_gb='".$param['title_gb']."', description_en='".htmlspecialchars($param['description_en'])."', description_cn='".htmlspecialchars($param['description_cn'])."', description_gb='".htmlspecialchars($param['description_gb'])."', orderby='".$param['orderby']."' WHERE community_id='$get_community_id'");
		  
		  if( $back_data )
		  {
			show_msg('修改成功','community_list.php');
		  }
		  else
		  {
			 show_msg('请重试','community_list.php');
		  }
	  }
	}
?>
</body>
</html>
