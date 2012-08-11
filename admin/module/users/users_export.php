<?php
define('IN_SK',true);	
require('../../includes/init.php');	
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}
$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
$SCRIPT_FILENAME = str_replace('\\\\', '/', ($_SERVER['PATH_TRANSLATED'] ? $_SERVER['PATH_TRANSLATED'] : $_SERVER['SCRIPT_FILENAME']));
$WEBURL = 'http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF, 0, strrpos($PHP_SELF, '/') + 1 - 17);

$query = $db->query("SELECT * FROM ".$ros->table('users')." WHERE users_id='".$_GET["users_id"]."'");
if ($this_sql = $db->fetch_array($query)) {
	header('Content-charset:utf-8'); 
	header('Content-type:application/vnd.ms-excel'); 
	header('Content-Disposition:filename=users_'.$_GET["users_id"].'_List.xls'); 
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name=ProgId content=Excel.Sheet>
	<meta name=Generator content="Microsoft Excel 11">
	<title>申请表导出</title>
	</head>
	<body>
    <table width="600" border="1" cellpadding="2" cellspacing="2">
		<tr>
		<td align="right">昵   称：</td>
		<td align="left"><?php echo $this_sql['unickname'];?></td>
		<td nowrap="nowrap" align="right"></td>
		<td align="left"></td>
	  </tr>
	  <tr>
		<td align="right">手   机：</td>
		<td align="left"><?php echo $this_sql['umobile'];?></td>
		<td align="right">电子邮件：</td>
		<td align="left"><?php echo $this_sql['uemail'];?></td>
	  </tr>
	  <tr>
		<td align="right">妈妈姓名：</td>
		<td align="left"><?php echo $this_sql['umname'];?></td>
		<td align="right">所 在 地：</td>
		<td align="left"><?php echo $this_sql['ulocation'];?></td>
	  </tr>
	  <tr>
		<td align="right">地   址：</td>
		<td align="left"><?php echo $this_sql['uaddress'];?></td>
		<td align="right">电   话：</td>
		<td align="left"><?php echo $this_sql['uphone'];?></td>
	  </tr>
	  <tr>
		<td align="right">邮政编码：</td>
		<td align="left"><?php echo $this_sql['uzipcode'];?></td>
		<td align="right">现   状：</td>
		<td align="left"><?php echo $this_sql['unow'];?></td>
	  </tr>
	  <tr>
		<td align="right">是否愿意接受知道/杂志:</td>
		<td valign="top"><?php echo $this_sql['umaga'];?></td>
        <td align="right">是否愿意接受新品推广:</td>
		<td valign="top"><?php echo $this_sql['uactivity'];?></td>
	  </tr>
      
      
      <tr>
		<td align="right">希望何种联系方式:</td>
		<td valign="top"><?php echo $this_sql['ucontact'];?></td>
        <td align="right"></td>
		<td valign="top"></td>
	  </tr>
	  <tr>
    </table>
    

	</html>
<?php
} else {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />没有结果！";
}
?>
