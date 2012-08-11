<?php
/**
 * CMS Backend Mangeageer
 * File function : to init backend param
 * ============================================================================
 * power by Rick
 * http://www.digtialcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick shi 
 * $email:1491361147@qq.com
 * $Id: index.php 2012-05-05 14:39
*/
/*
if (!defined('IN_SK')){
    die('Hacking attempt');
}*/
//define('SK_ADMIN', true);

error_reporting(E_ALL);

//set_magic_quotes_runtime(0);

if (__FILE__ == ''){
    die('Fatal error code: 0');
}
//to get document 
define('ROOT_PATH', str_replace('includes/init.php', '', str_replace('\\', '/', __FILE__)));

/* init session  */
@session_start();
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        0);

$home_header = false;
$param = $_POST;
//to set global var
$register_globals = @ini_get('register_globals');
$magic_quotes_gpc = get_magic_quotes_gpc();
if(!$register_globals || !$magic_quotes_gpc) {
	@extract(addslashes($_POST), EXTR_SKIP);
	$post = $_POST;
	@extract(addslashes($_GET), EXTR_SKIP);
	$get = $_GET;
	/*
	if(!$magic_quotes_gpc) {
		$_FILES = addslashes($_FILES);
	}
	*/
}

require_once ROOT_PATH.'includes/config.php';

require_once ROOT_PATH.'includes/cls_os.php';
require_once ROOT_PATH.'includes/cls_pager.php';
require_once ROOT_PATH.'includes/param.php';
require_once ROOT_PATH.'includes/function_main.php';

require_once ROOT_PATH.'admin/includes/function_main.php';

require_once './lang.php';
//return;
/*init os*/
$ros = new DB($db_name, $prefix);

/* init mysql db class */
require(ROOT_PATH . 'includes/cls_mysql.php');
$db = new cls_mysql;

$db->connect($db_host, $db_user, $db_pass, $pconnect=0);
$db->select_db($db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;

/*gzip module
if (gzip_enabled()){
    ob_start('ob_gzhandler');
}
else{
    ob_start();
}
*/
?>