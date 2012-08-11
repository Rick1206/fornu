<?php
/**
 * modify news information
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
require('../../lib/lib_right.php');
require('../../ckeditor/ckeditor.php') ;
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

$pic_doc = 'news';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_news_id = isset($_GET["news_id"]) ? $_GET["news_id"] : "";
if(empty($get_news_id))
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
	if($get_news_id != '')
	{
			//$news_id = $_GET['news_id'];
			$news_info = search_infor($get_news_id);
			foreach($news_info as $k=>$v)
			{
				$news_title_en = $v['title_en'];
				$news_intro_en = $v['intro_en'];
				$news_title_cn = $v['title_cn'];
				$news_intro_cn = $v['intro_cn'];
				$news_photo = $v['photo'];
				$news_image = $v['image'];
				$news_description_en = html_entity_decode($v['description_en']);
				$news_description_cn = html_entity_decode($v['description_cn']);
				$news_add_time = $v['dateline'];
				$news_orderby = $v['orderby'];
				
				
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_news" id="modify_news">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    优路新闻&gt;&gt;
    <a href="news_list.php" id="module_link">新闻列表</a>
    &gt;&gt;修改新闻信息</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="right">日期：</td>
          <td height="30"><input type="text" name="add_time" id="add_time" onFocus="HS_setDate(this)" readonly="readonly" value="<?php echo $news_add_time;?>" />          </td>
        </tr>
        
       <!--<tr>
          <td height="10" align="right">图片:</td>
          <td height="30">
		  <a href="<php echo $attachdir.$news_photo?>" target="_blank" id="module_link"><php echo $news_photo?></a><br>
          <input name="photo[]" type="file" size="40">
          ('gif', 'jpg','jpeg','png',Size:478*281px)
          <input type="hidden" name="news_photo" value="<php echo $news_photo;?>" /></td>
        </tr>

       <tr>
          <td height="10" align="right">缩略图:</td>
          <td height="30">
		  <a href="<php echo $attachdir.$news_image?>" target="_blank" id="module_link"><php echo $news_image?></a><br>
          <input name="image[]" type="file" size="40">
          ('gif', 'jpg','jpeg','png',Size:158*84px)
          <input type="hidden" name="news_image" value="<php echo $news_image;?>" /></td>
        </tr>-->
       
        <tr>
          <td width="20%" height="20" align="right">标题(英文)：</td>
          <td width="80%" height="30"><label>
            <input name="title_en" type="text"  value='<?php echo $news_title_en; ?>' class="input_add" >
          </label></td>
        </tr>
        
          <tr>
          <td width="20%" height="30" align="right">简介(英文)：</td>
          <td width="80%" height="65"><label>
            <textarea name="intro_en" type="textarea" class="input_text" /><?php echo $news_intro_en; ?></textarea>
          </label></td>
        </tr>
        
        <tr>
          <td width="20%" height="20" align="right">标题(简体中文)：</td>
          <td width="80%" height="30"><label>
            <input name="title_cn" type="text"  value="<?php echo $news_title_cn; ?>" class="input_add" >
          </label></td>
        </tr>
       
       <tr>
          <td width="20%" height="30" align="right">简介(简体中文)：</td>
          <td width="80%" height="65">
          <label>
            <textarea name="intro_cn" class="input_text" /><?php echo $news_intro_cn; ?></textarea>
          </label>
          </td>
        </tr>
  
        <!--<tr>
          <td align="right" valign="top">详细描述(英文)：</td>
          <td height="30">
          <php
            $sBasePath = '../../ckeditor/' ;
            $oFCKeditor = new FCKeditor('description_en') ;
            $oFCKeditor->BasePath	= $sBasePath ;
            $oFCKeditor->Value		= $news_description_en;
            $oFCKeditor->ToolbarSet		= 'Basic' ;
            $oFCKeditor->Config['AutoDetectLanguage']		= true ;
            $oFCKeditor->Config['DefaultLanguage']		= 'en' ;
            $oFCKeditor->Height		= 150 ;
            $oFCKeditor->Create() ;
          >          </td>
        </tr>-->
        
        <tr>
          <td align="right" valign="top">详细描述(简体中文)：</td>
          <td height="30">
          <?php
           	$sBasePath = '../../ckeditor/' ;
			$oFCKeditor = new ckeditor() ;
            $oFCKeditor->basePath = $sBasePath ;
			//$oFCKeditor->value = ;
			$oFCKeditor->config['height'] = 250;
			$oFCKeditor->editor("description_cn",$news_description_cn);
          ?>
          </td>
        </tr>
        
         <tr>
          <td width="20%" height="20" align="right">顺序:</td>
          <td width="80%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $news_orderby; ?>" size="4" />
          </label></td>
        </tr>
        
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_news" value="保存" />
            <input type="hidden" name="action" value="modify_news" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_news')
	{
	  if(!empty($get_news_id) )
	  {	
	  	  $attachment = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic = $v['attachment'];
				}
				@unlink($attachdir.$param['news_photo']);
				$db->query("UPDATE ".$ros->table('news')." SET photo='".$pic."' WHERE news_id='$get_news_id'");
				echo "";
		  }

		 
		  $attachment = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'image')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic2 = $v['attachment'];
				}
				@unlink($attachdir.$param['news_image']);
				$db->query("UPDATE ".$ros->table('news')." SET image='".$pic2."' WHERE news_id='$get_news_id'");
		  }

		  $back_data = $db->query("UPDATE ".$ros->table('news')." SET title_en='".$param['title_en']."', intro_cn='".$param['intro_cn']."', title_cn='".$param['title_cn']."', intro_en='".$param['intro_en']."', description_cn='".$param['description_cn']."', dateline='".$param['add_time']."', orderby='".$param['orderby']."' WHERE news_id='$get_news_id'");
		  
		  if( $back_data )
		  {
		  	show_msg('修改成功','news_list.php');
		  }
		  else
		  {
			 show_msg('请重试','news_list.php');
		  }
	  }
	}
?>
</body>
</html>
