<?php
/**
 * admin user funcion 
 * ============================================================================
 * powered by Rick
 * http://www.digitalcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick Shi  
 * $email:1491361147@qq.com
 *
*/

if (!defined('IN_SK'))
{
    die('Hacking attempt');
}
//get old pssword
function get_old_psw($admin_id,$param)
{
	global $db,$ros;
	
	$sql = 'SELECT admin_id,uname,pwd '.
			'FROM '. $ros->table('admin').
			'WHERE pwd="'.$param['old_psw'].'"'.' and admin_id = "'.$admin_id.'" ';

	$info = $db->getOne($sql);
	$info = md5($info);		
	return $info;
	$db->free_result($res);

}

//change user password

function change_psw($admin_id,$param)
{
	global $db,$ros;
	
	$pssword = empty($param['new_psw']) ? $param['user_psw'] : $param['new_psw'];
	
	$pssword = md5($pssword);
	
	$sql =  'UPDATE '.$ros->table('admin').
			' SET ';
			if( !empty($param['user_note_s']) )
			{
				$sql .= ' note="'.$param['user_note_s'].'",';
			}
			if( !empty($param['user_group_id']))
			{
				$sql .=' user_group="'.$param['user_group_id'].'",';
			}
			$sql .=	' pwd="'.$pssword.'"'.
					' WHERE '. 
					' admin_id='.$admin_id;
			 

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
//get all user 
function get_all_user($id)
{
	global $db,$ros;
	
	if(empty($id))
	{
		$sql = "SELECT * FROM".$ros->table('admin');
		$a = $db->getAll($sql);
	}
	else
	{
		$sql = "SELECT amdin_id,uname FROM ".$ros->table('admin').'WHERE admin_id='.$id;
		$res = $db->query($sql);
		while( $row = $db->fetch_array($res) )
		{
			$a = $row['name'];
		}
		
	}
	return $a;
	

}
//search user  by admin_id

function search_user($id)
{
	global $db,$ros;
	$sql = "SELECT * FROM ".$ros->table('admin').'WHERE admin_id='.$id;
	$a = $db->getAll($sql);
	if(count($a)!=0)
	{
		return $a;
	}
	else
	{
		return 0;	
	}
	
}
//search group user by user_group
function search_group_user($id)
{
	global $db,$ros;
	$sql = "SELECT * FROM ".$ros->table('admin').'WHERE user_group='.$id;
	$a = $db->getAll($sql);
	return $a;
}

//add new user
function add_new_user($param)
{
  global $ros,$db;
	
  $sql='INSERT INTO '.$ros->table('admin').' (uname,pwd,user_group,note) VALUES '.
  		'('.'"'.$param['user_name'].'",'.'"'.$param['user_psw'].'",'.'"'.$param['user_group'].'",'.'"'.$param['user_note'].'"'.
		
		')';
  
  
  $res = $db->query($sql);
  
  if($res)
  {
  	return true;
  }
  else
  {
  	return false;
  }
	

}

//del user

function del_user($id)
{
	global $ros,$db;
	
	if(empty($id))
	{
		return false;
	}
	else
	{
	
		$sql = 'DELETE FROM '.$ros->table('admin').' WHERE admin_id='.$id;
		
		$res = $db->query($sql);
		
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
}



?>