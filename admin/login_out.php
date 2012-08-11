<?php
/**
 * backend user login out
 * ============================================================================ * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 * $Id: index.php 2009-09-15 14:39
*/
define('IN_SK', true);
require(dirname(__FILE__) . '/includes/init.php');

//$login_out = login_out_os($_SESSION['admin_id']);

session_destroy();

header("Location: ./login.php\n");

?>