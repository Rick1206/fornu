<?php
/**
 * modify banners information
 * ============================================================================
 * powered by Rick
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

$pic_doc = 'banners';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_banner_id = isset($_GET["banner_id"]) ? $_GET["banner_id"] : "";

if(empty($get_banner_id))
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
<script src="../../js/time_en.js" language="javascript"></script>
</head>
<body>
<?php
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
	if($get_banner_id != '')
	{
			//$event_id = $_GET['event_id'];
			$sql = 'SELECT * FROM '.$ros->table('banners'). 'WHERE banner_id='.$get_banner_id;
			$event_info = $db->getAll($sql);
			foreach($event_info as $k=>$v)
			{
				$banner_lan = $v['lan'];
				$banner_photo = $v['photo'];
				//$event_image = $v['image'];
				$banner_link = $v['link'];
				$banner_orderby = $v['orderby'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_event" id="modify_event">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    首页&gt;&gt;<a href="banners_list.php" id="module_link">Banner列表</a>&gt;&gt;修改Banner</td>
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
				  <option value="<?php echo $key?>"<?php echo $banner_lan==$key ? ' selected="selected"' : '' ?>><?php echo $vaule?></option>
				  <?php
				  }
				  ?>
                </select></td>
        </tr>
		<tr>
          <td height="10" align="right">Photo:</td>
          <td height="30">
		  <a href="<?php echo $attachdir.$banner_photo?>" target="_blank" id="module_link"><?php echo $banner_photo?></a><br>
          <input name="photo[]" type="file" size="40">
          ('gif', 'jpg','jpeg','png',Size:203*110px)
          <input type="hidden" name="banner_photo" value="<?php echo $banner_photo;?>" /></td>
        </tr>
		<!--<tr>
          <td height="10" align="right">Mouse Over Photo:</td>
          <td height="30">
		  <php
		  if ($event_image) {
		  ?>
		  <a href="<php echo $attachdir.$event_image?>" target="_blank" id="module_link"><php echo $event_image?></a>&nbsp;&nbsp;
		  <input type="checkbox" name="image_del" value="1" />
		  <font color="#FF0000">DEL</font><br>
		  <php
		  }
		  ?>
          <input name="image[]" type="file" size="40">
          ('gif', 'jpg','jpeg','png',Size:203*110px)
          <input type="hidden" name="event_image" value="<php echo $event_image;?>" /></td>
        </tr>-->
		<tr>
          <td height="10" align="right">链接:</td>
          <td height="30"><input name="link" type="text"  value="<?php echo $banner_link; ?>" class="input_add" ></td>
        </tr>
        <tr>
          <td width="20%" height="20" align="right">顺序:</td>
          <td width="80%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $banner_orderby; ?>" size="4" />
          </label></td>
        </tr>
       <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_banner" value="Save" />
            <input type="hidden" name="action" value="modify_banner" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_banner')
	{
	  if(!empty($get_banner_id) )
	  {	
		  $attachment  = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic = $v['attachment'];
				}
				@unlink($attachdir.$param['banner_photo']);
				$db->query("UPDATE ".$ros->table('banners')." SET photo='".$pic."' WHERE banner_id='$get_banner_id'");
		  }

		  /*if (isset($param['image_del']) && $param['image_del']=="1") {
		  	@unlink($attachdir.$param['event_image']);
			$db->query("UPDATE ".$ros->table('event')." SET image='' WHERE event_id='$get_banner_id'");
		  }*/

		  $attachment     = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'image')) ? 1 : 0;
		  /*if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic2 = $v['attachment'];
				}
				@unlink($attachdir.$param['event_image']);
				$db->query("UPDATE ".$ros->table('banners')." SET image='".$pic2."' WHERE banner_id='$get_banner_id'");
		  }*/

		  $back_data = $db->query("UPDATE ".$ros->table('banners')." SET lan='".$param['lan_type']."', link='".$param['link']."', orderby='".$param['orderby']."' WHERE banner_id='$get_banner_id'");
		  
		  if( $back_data )
		  {
		  	show_msg('修改成功!','banners_list.php');
		  }
		  else
		  {
			 show_msg('Please Retry!','banners_list.php');
		  }
		}
	}
?>
</body>
</html>
