<?php

if(!defined('IN_SK')) {
	exit('Access Denied');
}

$timestamp = time();
$errmsg = '';

$dberror = $this->error();
$dberrno = $this->errno();

if($message) {
	$errmsg = "<b>Web! info</b>: $message\n\n";
}

$errmsg .= "<b>Time</b>: ".gmdate("Y-m-d H:i:s", $timestamp + ($GLOBALS['timeoffset'] * 3600))."\n";
$errmsg .= "<b>Script</b>: ".$GLOBALS['PHP_SELF']."\n\n";

if($sql) {
	$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
}

$errmsg .= "<b>Error</b>:  $dberror\n";
$errmsg .= "<b>Errno</b>:  $dberrno";

echo "</table></table></table></table></table>\n";
echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
echo nl2br($errmsg);
echo '</p>';

exit();

?>