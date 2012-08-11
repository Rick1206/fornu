<?php
/**
 * modify finance information
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

//$pic_doc = 'finance';
//$attachdir = "../../../uploadfiles/".$pic_doc."/";

$get_finance_id = isset($_GET["finance_id"]) ? $_GET["finance_id"] : "";

if(empty($get_finance_id))
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
	if($get_finance_id != '')
	{
			//$event_id = $_GET['event_id'];
			$sql = 'SELECT * FROM '.$ros->table('finance'). 'WHERE finance_id='.$get_finance_id;
			$event_info = $db->getAll($sql);
			foreach($event_info as $k=>$v)
			{
				
				//$finance_photo = $v['photo'];
				$finance_title_cn = $v['title_cn'];
				$finance_title_en = $v['title_en'];
				$finance_type = $v['ftype'];
				$finance_money = $v['fmoney'];
				//$finance_orderby = $v['orderby'];
				$finance_add_time = $v['dateline'];
			}	
	}
	
?>
<form method="post" enctype="multipart/form-data" name="modify_event" id="modify_event">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    财务公开&gt;&gt;<a href="finance_list.php" id="module_link">财务列表</a>&gt;&gt;修改</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         
          <tr>
          <td height="20" align="right">物资名称(中文)：</td>
          <td height="30">
          <input name="pro_cn" type="text" class="input_add" value="<?php echo $finance_title_cn;?>"/>
          </td>
        </tr>
        
         <tr>
          <td height="20" align="right">物资名称(英文)：</td>
          <td height="30">
           <input name="pro_en" type="text" class="input_add" value="<?php echo $finance_title_en;?>"/>
          </td>
        </tr>
        
         <tr>
          <td height="25" align="right">日期：</td>
          <td height="30"><input type="text" name="add_time" id="add_time" onFocus="HS_setDate(this)" readonly="readonly" value="<?php echo $finance_add_time;?>" />          </td>
        </tr>
        
        <tr>
          <td height="20" align="right">类型:</td>
          <td height="30">
          		<select name="ftype" id="ftype" value="<?php echo $_Ftype[$finance_type];?>" >   
       				<option <?php echo $finance_type ? "" : "selected='selected'";?>  value="0">收入</option>   
       				<option <?php echo $finance_type ? "selected='selected'" : "";?>  value="1">支出</option>   
     			 </select>   
          </td>
        </tr>
      
		
		<tr>
          <td height="10" align="right">金额:</td>
          <td height="30"><input name="count" type="text"  value="<?php echo $finance_money; ?>" class="input_add" ></td>
        </tr>
        
       <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="modify_finance" value="Save" />
            <input type="hidden" name="action" value="modify_finance" />          </td>
        </tr>   
      </table>  
    </td>
  </tr>
</table> 
</form> 
<?php
	}
	elseif($action == 'modify_finance')
	{
	  
		  $back_data = $db->query("UPDATE ".$ros->table('finance')." SET title_cn='".$param['pro_cn']."', title_en='".$param['pro_en']."', ftype='".$param['ftype']."', fmoney='".$param['count']."' WHERE finance_id='$get_finance_id'");
		  
		  if( $back_data )
		  {
		  	show_msg('修改成功!','finance_list.php');
		  }
		  else
		  {
			 show_msg('Please Retry!','finance_list.php');
		  }
	}
?>
</body>
</html>
