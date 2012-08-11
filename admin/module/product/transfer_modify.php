<?php
/**
 * modify product information
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

$pic_doc = 'product';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_product_id = isset($_GET["product_id"]) ? $_GET["product_id"] : "";

if(empty($get_product_id))
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
	if($get_product_id != '')
	{
			//$event_id = $_GET['event_id'];
			$sql = 'SELECT * FROM '.$ros->table('product'). 'WHERE product_id='.$get_product_id;
			$event_info = $db->getAll($sql);
			foreach($event_info as $k=>$v)
			{
				
				$product_photo = $v['photo'];
				$product_title_cn = $v['title_cn'];
				$product_title_en = $v['title_en'];
				$product_count = $v['pcount'];
				$product_orderby = $v['orderby'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_event" id="modify_event">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    首页&gt;&gt;<a href="product_list.php" id="module_link">product列表</a>&gt;&gt;修改product</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         
          <tr>
          <td height="20" align="right">物资名称(中文)：</td>
          <td height="30">
          <input name="pro_cn" type="text" class="input_add" value="<?php echo $product_title_cn;?>"/>
          </td>
        </tr>
         <tr>
          <td height="20" align="right">物资名称(英文)：</td>
          <td height="30">
           <input name="pro_en" type="text" class="input_add" value="<?php echo $product_title_en;?>"/>
          </td>
        </tr>
        
		<tr>
          <td height="10" align="right">图片:</td>
          <td height="30">
		  <a href="<?php echo $attachdir.$product_photo?>" target="_blank" id="module_link"><?php echo $product_photo?></a><br>
          <input name="photo[]" type="file" size="40"><br />
          ('gif', 'jpg','jpeg','png',Size:203*110px)
          <input type="hidden" name="product_photo" value="<?php echo $product_photo;?>" /></td>
        </tr>
		<tr>
          <td height="10" align="right">数量:</td>
          <td height="30"><input name="count" type="text"  value="<?php echo $product_count; ?>" class="input_add" ></td>
        </tr>
        <tr>
          <td width="20%" height="20" align="right">Order By:</td>
          <td width="80%" height="30"><label>
            <input name="orderby" type="text" value="<?php echo $product_orderby; ?>" size="4" />
          </label></td>
        </tr>
       <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_product" value="Save" />
            <input type="hidden" name="action" value="modify_product" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_product')
	{
	  if(!empty($get_product_id) )
	  {	
		  $attachment  = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		  if($attachment == 1)
		  {
				foreach($attachments_arg as $k => $v)
				{
					$pic = $v['attachment'];
				}
				@unlink($attachdir.$param['product_photo']);
				$db->query("UPDATE ".$ros->table('product')." SET photo='".$pic."' WHERE product_id='$get_product_id'");
		  }

		

		  $attachment     = ($attachments_arg = attach_upload(array('gif','jpg','jpeg','png'), 'image')) ? 1 : 0;
		 

		  $back_data = $db->query("UPDATE ".$ros->table('product')." SET title_cn='".$param['pro_cn']."', title_en='".$param['pro_en']."', pcount='".$param['count']."', orderby='".$param['orderby']."' WHERE product_id='$get_product_id'");
		  
		  if( $back_data )
		  {
		  	show_msg('修改成功!','product_list.php');
		  }
		  else
		  {
			 show_msg('Please Retry!','product_list.php');
		  }
		}
	}
?>
</body>
</html>
