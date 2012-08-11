<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$timeoffset = 8;

define('IN_WEB', TRUE);
define('WEB_ROOT', substr(dirname(__FILE__), 0, -8));
define('CHARSET', 'utf-8');
//define('CHARSET', 'GB2312');

set_magic_quotes_runtime(0);

$PHP_SELF = $HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME'];
$SCRIPT_FILENAME = str_replace('\\\\', '/', ($HTTP_SERVER_VARS['PATH_TRANSLATED'] ? $HTTP_SERVER_VARS['PATH_TRANSLATED'] : $HTTP_SERVER_VARS['SCRIPT_FILENAME']));
$WEBURL = 'http://'.$HTTP_SERVER_VARS['HTTP_HOST'].substr($PHP_SELF, 0, strrpos($PHP_SELF, '/') + 1);


require WEB_ROOT.'./config.php';
require WEB_ROOT.'./includes/global.php';
require WEB_ROOT.'./includes/db_'.$database.'.php';
require WEB_ROOT.'./includes/fun_media_ub.php';
require WEB_ROOT.'./includes/seo.php';
require WEB_ROOT.'./includes/param.php';

$timestamp = time();
$today = date('Y-m-d');  

$register_globals = @ini_get('register_globals');
$magic_quotes_gpc = get_magic_quotes_gpc();

if(getenv('HTTP_CLIENT_IP')) {
	$onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
	$onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR')) {
	$onlineip = getenv('REMOTE_ADDR');
} else {
	$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
}

if(!$register_globals || !$magic_quotes_gpc) {
	@extract(daddslashes($HTTP_POST_VARS), EXTR_SKIP);
	@extract(daddslashes($HTTP_GET_VARS), EXTR_SKIP);
	if(!$magic_quotes_gpc) {
		$_FILES = daddslashes($_FILES);
	}
}


$db = new dbstuff;
$db->connect($dbhost, $dbuser, $dbpw, $pconnect);
$db->select_db($dbname);
unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
$currscript = basename($PHP_SELF);
$currscript = substr($currscript, 0, strpos($currscript, '.php'));
$gzipcompress ? ob_start('ob_gzhandler') : ob_start();
?>