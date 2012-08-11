<?php

if (!defined('IN_SK'))
{
    die('Hacking attempt');
}
/** 
 * user to login backend
 * string  $user_name 	user name
 * string  $user_psw	user password
 * return  int			admin_id in db form admin table
*/
function login_backend($user,$psw)
{
	global $db,$ros;
	
	//$psw  = md5($psw);
	
	$sql = 'SELECT admin_id,uname,pwd '.
			'FROM '. $ros->table('admin').
			'WHERE uname = "'.$user.'" '.
			'AND pwd = "'.$psw.'"'
			;
	$info = $db->getOne($sql);			
	return $info;
	$db->free_result($res);
}

/**
 * user login out backend
 * int		$admin_id		user id
 */

function login_out_os($user_id)
{
	global $db,$ros;
	
	$sql = 'UPDATE '.$ros->table('admin').
	
			' SET out_time="'.date('Y-m-d-H-i-s').'"
			
			 WHERE admin_id='.$user_id.'';
    $res = $db->query($sql);
	if($res)
	{
		return true;
	}
	else
	{
		return false;
	}
	$db->free_result($res);

}

?>