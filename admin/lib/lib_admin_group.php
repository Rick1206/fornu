<?php
/**
 * admin user group funcion 
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

//create new user group
function create_news_group($param,$right,$admin_id)
{
  global $ros,$db;
  
  //search the group name 
  
  $res = $db->query('SELECT name FROM '.$ros->table('user_group').'where name="'.$param['right_name'].'"');
  $num = $db->num_rows($res);
  if($num>=1)
  {
  	return 0;
  }
  else
  {
  
	  $sql='INSERT INTO '.$ros->table('user_group').' (`name`,`right`,`desc`,`admin_id`) VALUES '.
			'('.'"'.$param['right_name'].'",'.
			'"'.$right.'",'.
			'"'.$param['desc'].'",'.
			'"'.$admin_id.'"'.
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
	

}

//del user group

function del_user_group($id)
{
	global $ros,$db;
	//no select item
	if(empty($id))
	{
		return false;
	}
	else
	{
		//to search have user in this group
		
		$res = $db->query('SELECT user_group FROM '.$ros->table('admin').' WHERE user_group='.$id);
		
		$num = $db->num_rows($res);
		
		if($num>=1)
		{
			return 0;
		}
		else
		{
			//delete user group information by id
			$sql = 'DELETE FROM '.$ros->table('user_group').' WHERE j_id='.$id;
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
	
}
//modify user group infor by group id in database
function modify_group($param,$right_list,$id,$admin)
{	
	
	global $ros,$db;
	if(empty($id))
	{
		return false;
	}
	else
	{
	    if($param['right_name1']!= $param['right_name2'])
		{
			//first to check the name that in databa
			$res = $db->query('SELECT name FROM '.$ros->table('user_group'). ' WHERE name="'.$param['right_name1'].'"');
			$num = $db->num_rows($res);
			//echo $num;
			if( $num >= 1 )
			{
				return 0;
			}
			else
			{
				$sql = ' UPDATE	'.$ros->table('user_group').
						' SET'.
						' `name`="'.$param['right_name1'].'",'.
						' `right`="'.$right_list.'",'.
						' `admin_id`="'.$admin.'",'.
						' `desc`="'.$param['desc'].'"'.
						' WHERE'.
						' `j_id`='.$id
						;
				$res  = $db->query($sql);
				if($res)
				{
					return true;
				}
				else
				{
					return fasle;
				}
				$db->free_result($res);
				
			}
		}
		else
		{
			$sql = ' UPDATE	'.$ros->table('user_group').
			
					' SET'.
					' `name`="'.$param['right_name1'].'",'.
					' `right`="'.$right_list.'",'.
					' `admin_id`="'.$admin.'",'.
					' `desc`="'.$param['desc'].'"'.
					' WHERE'.
					' `j_id`='.$id
					;
			$res  = $db->query($sql);
			if($res)
			{
				return true;
			}
			else
			{
				return fasle;
			}
			$db->free_result($res);
			
		}
		
	}
}

//search all user group 

function get_user_group($id)
{
	global $db,$ros;
	if( empty($id) )
	{
		$sql = 'SELECT * FROM '.$ros->table('user_group');
		$res = $db->getAll($sql);
		return $res;
	}
	else
	{
		$sql = ' SELECT * FROM '.$ros->table('user_group') . ' WHERE j_id='.$id;
		$res = $db->getAll($sql);
		$nam = $res[0]['name'];
		return $nam;
	}
}
// get gruop information by id return array
function get_all_group($id)
{
	global $db,$ros;
	$sql = ' SELECT * FROM '.$ros->table('user_group') . ' WHERE j_id='.$id;
	$res = $db->getAll($sql);
	return $res;
}


//return group right list

function get_right_list($id)
{
	global $db,$ros;
	$sql = ' SELECT * FROM '.$ros->table('user_group') . ' WHERE j_id='.$id. ' LIMIT 1';
	
	$res = $db->getAll($sql);
	
	if(count($res)!=0)
	{
		$right_list = explode(',',$res[0]['right']);
		return $right_list;
	}
	else
	{
		return 0;
	}

}

//通过管理员的ID得到管理员的权限列表

function get_right_byId($id)
{

	global $db,$ros;
	
	//first to get group id
	
	if(empty($id))
	{
		return false;
	}
	else
	{
	
		$sql = 'SELECT admin_id,user_group FROM '.$ros->table('admin'). 'WHERE admin_id='.$id;
		
		$res = $db->getAll($sql);
		
		$group_id = $res[0]['user_group'];
		//
		if( empty($group_id))
		{
			return false;
		}
		else
		{
			//GET RIGHT LIST IN USER GROUP TABLE
			$sql = 'SELECT `j_id`,`right` FROM '.$ros->table('user_group'). ' WHERE j_id='.$group_id;
			$res = $db->getAll($sql);
			$r_l = $res[0]['right'];
			$r_l = explode(',',$r_l);
			if(count($r_l)!=0)
			{
				return $r_l;
			}
			else
			{
				return false;
			}
	
		}
	}

}

//通过ID得到权限的详细信息
function  get_right_details($id)
{

	global $db,$ros;
	
	if(!empty($id))
	{
	
		$sql = 'SELECT `j_id`,`right`,`name`,`desc` FROM '.$ros->table('user_group'). ' WHERE j_id='.$id;
		$res = $db->getAll($sql);
		return $res;
	}
	else
	{
		return false;
	}


}

?>