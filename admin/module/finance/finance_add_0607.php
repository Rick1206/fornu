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

$pic_doc = 'finance';
$attachdir = "../../../uploadfiles/".$pic_doc."/";


//$attachdir = "./uploadfiles/resume/";
//$attachment_s = ($attachments_arg_s = attach_upload_1(array('doc','docx','xls','xlsx'), 'file')) ? 1 : 0;
	
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
<form method="post" enctype="multipart/form-data" name="add_finance" id="add_finance">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    财务公开&gt;&gt;<a href="finance_list.php" id="module_link">物资列表</a>&gt;&gt;添加财务</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
          <td height="20" align="right">财务名称(中文)：</td>
          <td height="30">
          <input name="fin_cn" type="text" class="input_add" />
          </td>
        </tr>
         <tr>
          <td height="20" align="right">财务名称(英文)：</td>
          <td height="30">
          <input name="fin_en" type="text" class="input_add" />
          </td>
        </tr>
        
         <tr>
          <td height="20" align="right">日期：</td>
          <td height="30">
          <input type="text" name="add_time" id="add_time" onFocus="HS_setDate(this)" readonly="readonly" value="<?php echo $now_date;?>" />          
          </td>
        </tr>
        
         <tr>
          <td height="20" align="right">财务报表：</td>
          <td height="30"><input type="file" class="file" id="file" name="file[]" size="40"> 
          ('xls','word')</td>
        </tr>
        
		<tr>
          <td height="20" align="right">类型:</td>
          <td height="30">
          		<select name="ftype" id="ftype">   
       				<option value="0">收入</option>   
       				<option value="1">支出</option>   
     			 </select>   
          </td>
        </tr>
        <tr>
          <td height="20" align="right">金额:</td>
          <td height="30"><input name="count"  value="0" size="4" class="input_add" /></td>
        </tr>
        
        <tr>
          <td height="20">&nbsp;</td>
          <td height="30">
            <input type="submit" name="submit" id="add_finance" value="保存" />
            <input type="hidden" name="action" value="add_finance" />
           </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php
	}
	elseif($action == 'add_finance')
	{
		//$attachment_s = ($attachments_arg_s = attach_upload(array('gif','jpg','jpeg','png'), 'photo')) ? 1 : 0;
		
		$attachment_s = ($attachments_arg_s = attach_upload_1(array('doc','docx','xls','xlsx'), 'file')) ? 1 : 0;
		
		//echo $attachment_s;
		
		if($attachment_s){
			
			foreach($attachments_arg_s as $k => $v)
			{
				$pic = $v['attachment'];
				echo $pic;
			}
		
			
			$back_data = $db->query("INSERT INTO ".$ros->table('finance')." (title_cn, title_en, ftype, fmoney, dateline) VALUES ('".$param['fin_cn']."', '".$param['fin_en']."', '".$param['ftype']."', '".$param['count']."', '".$param['add_time']."')");
			
			if($back_data)
			{
				show_msg('添加财务成功!','finance_add.php');  
			}
			else
			{
				show_msg('Please Retry!','finance_add.php');
			}
		} 
		//else {
			
			//show_msg('Excel Upload False!','finance_add.php');
			
		//}
	}
?>   
</body>
</html>
