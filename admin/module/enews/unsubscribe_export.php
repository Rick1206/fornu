<?php
define('IN_SK',true);	
require('../../includes/init.php');	
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}
				
$query = $db->query("SELECT COUNT(*) FROM ".$ros->table('unsubscribe'));
$all_date_num = $db->result($query, 0);
if ($all_date_num) {
	header('Content-charset:utf-8'); 
	header('Content-type:application/vnd.ms-excel'); 
	header('Content-Disposition:filename=Unsubscribe_List.xls'); 
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name=ProgId content=Excel.Sheet>
	<meta name=Generator content="Microsoft Excel 11">
	<title>Unsubscribe List</title>
	</head>
	<body>
	<table width="350" border="1" cellspacing="0" cellpadding="0">
     <tr>
        <td width="50"><div align="center">ID</div></td>
		<td width="150"><div align="center">E-mail</div></td>
        <td width="150"><div align="center">Registration Time</div></td>
		<td width="150"><div align="center">Unsubscribe Time</div></td>
      </tr>
      <?php
	  $query = $db->query("SELECT * FROM ".$ros->table('Unsubscribe')." ORDER BY unreg_time DESC");
	  while($this_sql = $db->fetch_array($query)) {
	  ?>
	  <tr>
        <td><?php echo $this_sql['uid']?></td>
		<td><?php echo $this_sql['email']?>&nbsp;</td>
        <td><?php echo $this_sql['reg_time']?>&nbsp;</td>
		<td><?php echo $this_sql['unreg_time']?>&nbsp;</td>
      </tr>
	  <?php
	  }
	  ?>
    </table>
	</body>
	</html>
<?php
}
?>
