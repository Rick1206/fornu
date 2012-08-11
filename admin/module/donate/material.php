<?php
/**
 * room list
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 *
*/
define('IN_SK',true);
require('../../includes/init.php');	
require('../../lib/lib_right.php');
if( empty($_SESSION['admin_id']) ){
	header('Location: ../../login.php');
	exit();
}

$pic_doc = 'booking';
$attachdir = "../../../uploadfiles/".$pic_doc."/";

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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="31" background="../../images/i_m_t.jpg">&nbsp;</td>
    <td width="972" background="../../images/i_m_t.jpg">爱心捐献&gt;&gt;物力查询</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td height="400" valign="top">
	<form action="material_list.php" method="get" name="form1" id="form1">
<table border="0" cellspacing="0" cellpadding="0" width="98%" class="table">

<tr><td width="4" bgcolor="#999999" >&nbsp;</td>
  <td class="m_t_c" colspan="2">按时间查询</td>
</tr>

<tr><td>&nbsp;</td>
  <td width="150" height="30" align="right">从:</td>
<td width="780"><input type="text" size="25" name="formdate" id="formdate" onFocus="HS_setDate(this)" readonly="readonly" /></td></tr>

<tr><td>&nbsp;</td>
  <td height="30" align="right">到:</td>
<td><input type="text" size="25" name="todate" id="todate" onFocus="HS_setDate(this)" readonly="readonly" /></td></tr>

<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="center"></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td height="30" colspan="2" align="center"><input type="submit" name="searchsubmit" value="查询"></td>
</tr>
</table>
</form>
    </td>
  </tr>
</table>
</body>
</html>
