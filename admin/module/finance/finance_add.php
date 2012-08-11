<?php
/**
 * add finance information
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

//$pic_doc = 'finance';
//$attachdir = "../../../uploadfiles/".$pic_doc."/";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $system_name;?></title>
<link rel="stylesheet" href="../../style/module.css" />
<link type="text/css" rel="stylesheet" href="../../css/ui-lightness/jquery-ui-1.8.20.custom.css" />
<!---  show month and year --->
<style>
.ui-datepicker-calendar{display: none;}​
</style>
</head>
<body>
<?php
   // to add finance information
   $action = isset($param["action"]) ? $param["action"] : "";
   if(empty($action))
   {
?>
<form method="post" enctype="multipart/form-data" name="add_finance" id="add_finance">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">
    财务公开&gt;&gt;<a href="finance_list.php" id="module_link">财务列表</a>&gt;&gt;添加财务</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      
         <!-- <tr>
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
        </tr>-->
        
         <tr>
          <td height="20" align="right">日期：</td>
          <td height="30">
          <input type="text" name="add_time" id="add_time" value="<?php echo date("Y-m");?>" />          
          </td>
        </tr>
        
		<!--<tr>
          <td height="20" align="right">类型:</td>
          <td height="30">
          		<select name="ftype" id="ftype">   
       				<option value="0">收入</option>   
       				<option value="1">支出</option>   
     			 </select>   
          </td>
        </tr>-->
        
         <tr>
          <td height="40" align="right">财务报表(中):</td>
          <td height="50"><input name="cfile[]" type="file" size="40">
          <br />
          ('xls','xlsx')</td>
        </tr>
        
        <tr>
          <td height="40" align="right">财务报表(英):</td>
          <td height="50"><input name="efile[]" type="file" size="40">
          <br />
          ('xls','xlsx')</td>
        </tr>
        
       <!-- <tr>
          <td height="20" align="right">金额:</td>
          <td height="30"><input name="count"  value="0" size="4" class="input_add" /></td>
        </tr>-->
        
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
		
		if($_FILES["cfile"]["name"][0] == "" || $_FILES["efile"]["name"][0] == ""){
			show_msg('请同时上传（中/英）报表!','finance_add.php');
		}
		
		$xls = array('cfile','efile');
		$xlsN = array('_cn','_en');
		
		$xlsName = "";
		$xlsState = 0;
		
		$addTime = $param['add_time'];
		
		for($i = 0;$i<count($xls);$i++){
			
			$pic_doc = 'finance'.$xlsN[$i];
			$attachdir = "../../../uploadfiles/".$pic_doc."/";
			
			$attachment_s = ($attachments_arg_s = attach_upload_xls(array('xls','xlsx'), $xls[$i],'财务报表支持的格式是',$param['add_time'].$xlsN[$i])) ? 1 : 0;
			
			if($attachment_s){
				$xlsName[$i] = $attachments_arg_s[0]['attachment']; 
				$xlsState++;
				}
		}
		
		if($xlsState>1){

		$back_data = $db->query("INSERT INTO ".$ros->table('finance')." (title_cn, title_en, dateline) VALUES ('".$xlsName[0]."', '".$xlsName[1]."', '".$now_date."')");
			
			if($back_data)
			{
				show_msg('添加财务成功!','finance_add.php');  
			}
			else
			{
				show_msg('Please Retry!','finance_add.php');
			}
			
		} else {
			show_msg('财务报表上传失败!','finance_add.php');
		}
	}
?>   
</body>

</html>
<script language="javascript" src="../../script/jquery-1.5.1.min.js" type="text/javascript"></script>
<script language="javascript" src="../../script/jquery-ui-1.8.20.custom.min.js" type="text/javascript" ></script>
<script language="javascript" type="text/javascript">
	
$(function(){
	$('#add_time').datepicker({
								 changeMonth: true,
								 
     							 changeYear: true,
								 
								 showButtonPanel: true,
								 
								 dateFormat:'yy-mm', 
								 
								 currentText: '今天',
		
		prevText: '&#x3c;上月',
		
		nextText: '下月&#x3e;',
								 
		monthNames: ['01','02','03','04','05','06',
		'07','08','09','10','11','12'],
		
		monthNamesShort: ['01','02','03','04','05','06',
		'07','08','09','10','11','12'],
		
		closeText: '确认',
		
		showMonthAfterYear: true,
		
	 onClose: function() {

        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();

        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));

     },
     beforeShow: function() {
       if ((selDate = $(this).val()).length > 0){

			iYear = selDate.substring(0,4);
			
          iMonth = jQuery.inArray(selDate.substring(5,7),
			
                   $(this).datepicker('option', 'monthNames'));
			
          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth,1));

          $(this).datepicker('setDate', new Date(iYear, iMonth,1));

       }

    }

  });
							
								
								
								
});
</script>