<?php

/*if (!defined('IN_SK'))
{
    die('Hacking attempt');
}*/

define('SK_ADMIN', true);

error_reporting(E_ALL);

/* php4.2
set_magic_quotes_runtime(0);
*/

/*if (__FILE__ == ''){
    die('Fatal error code: 0');
}*/

//to get document 
define('ROOT_PATH', str_replace('admin/includes/init.php', '', str_replace('\\', '/', __FILE__)));
//echo (ROOT_PATH);
//to set global var
$register_globals = @ini_get('register_globals');
$magic_quotes_gpc = get_magic_quotes_gpc();
if(!$register_globals || !$magic_quotes_gpc) {
/*	@extract(addslashes($_POST), EXTR_SKIP);
	$post = $_POST;
	@extract(addslashes($_GET), EXTR_SKIP);
	$get = $_GET;
	if(!$magic_quotes_gpc) {
		$_FILES = addslashes($_FILES);
	}*/
}
/* init set  */
@session_start();
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);

require_once ROOT_PATH.'includes/config.php';
require_once ROOT_PATH.'includes/cls_os.php';
require_once ROOT_PATH.'includes/function_main.php';
require_once ROOT_PATH.'includes/param.php';
require_once ROOT_PATH.'admin/includes/function_login.php';
require_once ROOT_PATH.'admin/includes/function_main.php';
require_once ROOT_PATH.'admin/includes/param.php';
require_once ROOT_PATH.'admin/lib/lib_admin.php';
require_once ROOT_PATH.'admin/lib/lib_admin_group.php';
require_once ROOT_PATH.'admin/lib/lib_news.php';
require_once ROOT_PATH.'admin/lib/lib_diary.php';
require_once ROOT_PATH.'admin/lib/lib_job.php';
require_once ROOT_PATH.'admin/lib/lib_xml.php';

/*pager*/
require_once ROOT_PATH.'includes/cls_pager.php';

$page_a = 10;
/*init ea os*/
$ros = new DB($db_name, $prefix);
/* init mysql db class */
require(ROOT_PATH . 'includes/cls_mysql.php');

$db = new cls_mysql;

$db->connect($db_host, $db_user, $db_pass, $pconnect=0);
$db->select_db($db_name);

//$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;

/*server infotmation*/

$serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
$serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
$dbversion = $db->result($db->query("SELECT VERSION()"), 0);
if(@ini_get("file_uploads")) {
	$fileupload = "Allow - File ".ini_get("upload_max_filesize")." - Table ".ini_get("post_max_size");
} else {
	$fileupload = "<font color=\"red\">Forbidden</font>";
}
$dbsize = 0;
$query = $db->query("SHOW TABLE STATUS LIKE '$prefix%'", 1);
while($table = $db->fetch_array($query)) {
	$dbsize += $table['Data_length'] + $table['Index_length'];
}
$dbsize = $dbsize ? sizecount($dbsize) : "Unknow";

/*gzip module
if (gzip_enabled()){
    ob_start('ob_gzhandler');
}
else{
    ob_start();
}
*/

?>