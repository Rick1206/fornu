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

$query = $db->query("SELECT * FROM ".$ros->table('job')." WHERE job_id='".$_GET["job_id"]."'");
if ($this_sql = $db->fetch_array($query)) {
	header('Content-charset:utf-8'); 
	header('Content-type:application/vnd.ms-excel'); 
	header('Content-Disposition:filename=job'.$_GET["job_id"].'_List.xls'); 
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
		<td align="right">姓　　名：</td>
		<td align="left"><?php echo $this_sql['uname'];?></td>
		<td nowrap="nowrap" align="right"></td>
		<td align="left"></td>
	  </tr>
	  <tr>
		<td align="right">性　　别：</td>
		<td align="left"><?php echo $this_sql['usex'] ? "女" : "男";?></td>
		<td align="right">年　　龄：</td>
		<td align="left"><?php echo $this_sql['uage'];?></td>
	  </tr>
	  <tr>
		<td align="right">证件号码：</td>
		<td align="left"><?php echo $this_sql['ucard'];?></td>
		<td align="right">证件种类：</td>
		<td align="left"><?php echo $this_sql['utype'];?></td>
	  </tr>
	  <tr>
		<td align="right">出生年月：</td>
		<td align="left"><?php echo $this_sql['uage'];?></td>
		<td align="right">申 请 日：</td>
		<td align="left"><?php echo $this_sql['utime'];?></td>
	  </tr>
	  <tr>
		<td align="right">地  址：</td>
		<td align="left"><?php echo $this_sql['ucontact'];?></td>
		<td align="right">教育程度：</td>
		<td align="left"><?php echo $this_sql['uedu'];?></td>
	  </tr>
	  <tr>
		<td align="right">宗教信仰:</td>
		<td valign="top"><?php echo $this_sql['ubelief'];?></td>
        <td align="right">宗教信仰:</td>
		<td valign="top"><?php echo $this_sql['ubelief'];?></td>
	  </tr>
      <tr>
		<td align="right">义工种类：</td>
		<td colspan="3" align="left"><?php echo $_user_job[$this_sql['ujob']]; ?></td>
	  </tr>
       <tr>
		<td align="right">义工经验：</td>
		<td colspan="3" align="left"><?php echo $this_sql['uexperience']; ?></td>
	  </tr>
      <tr>
		<td align="right">自我介绍：</td>
		<td colspan="3" align="left"><?php echo $this_sql['uintro']; ?></td>
	  </tr>
	</table>
	</body>
	</html>
<?php
} else {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />没有结果！";
}
?>
