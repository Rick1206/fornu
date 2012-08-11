<?php
define('IN_SK',true);	
require('../../includes/init.php');	
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

foreach($_GET as $key => $value) {
	$$key = $value;
}

		$conditions = "";
		$and = " WHERE";
		if (isset($_GET['formdate']) || isset($_GET['todate'])) {
			if (isset($_GET['formdate']) && $_GET['formdate'] != "") {
				$conditions .= $and." reg_time>='".$_GET['formdate']."'";
				$and = " AND";
			}
			if (isset($_GET['todate']) && $_GET['todate'] != "") {
				$conditions .= $and." reg_time<='".$_GET['todate']."'";
				$and = " AND";
			}
		} elseif (isset($_GET['email']) && $_GET['email']!="") {
			$conditions .= $and." (email LIKE '%".$_GET['email']."%' OR email='".$_GET['email']."')";
			$and = " AND";
		}
				
$query = $db->query("SELECT COUNT(*) FROM ".$ros->table('enews')." $conditions");
$all_date_num = $db->result($query, 0);
if ($all_date_num) {
	header('Content-charset:utf-8'); 
	header('Content-type:application/vnd.ms-excel'); 
	header('Content-Disposition:filename=Enews_List.xls'); 
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name=ProgId content=Excel.Sheet>
	<meta name=Generator content="Microsoft Excel 11">
	<title>邮件列表</title>
	</head>
	<body>
	<table width="350" border="1" cellspacing="0" cellpadding="0">
     <tr>
        <td width="50"><div align="center">编号</div></td>
		<td width="150"><div align="center">邮件地址</div></td>
        <td width="150"><div align="center">注册时间</div></td>
      </tr>
      <?php
	  $query = $db->query("SELECT * FROM ".$ros->table('enews')." $conditions ORDER BY reg_time DESC");
	  while($this_sql = $db->fetch_array($query)) {
	  ?>
	  <tr>
        <td><?php echo $this_sql['eid']?></td>
		<td><?php echo $this_sql['email']?>&nbsp;</td>
        <td><?php echo $this_sql['reg_time']?>&nbsp;</td>
      </tr>
	  <?php
	  }
	  ?>
    </table>
	</body>
	</html>
<?php
} else {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />没有结果！";
}
?>
