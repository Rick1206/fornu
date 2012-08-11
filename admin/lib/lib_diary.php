<?php
/**
 * admin diary function 
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
if (!defined('IN_SK')) 
{
    die('Hacking attempt');
}   

//add diary

function add_diary($param,$admin_id)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	$publish = $param['publish'];
	$sql = 'INSERT INTO '.$ros->table('diary'). '(`title`,`keywords`,`contant`,`lan`,`add_time`,`is_publish`,`order`,`admin_id`) '.
			'VALUES ("'.$param['title'].'",'.
			'"'.$param['keywords'].'",'.
			'"'.$param['contant'].'",'.
			//'"'.$param['summary'].'",'.
			'"'.$param['diary_lan'].'",'.
			'"'.$param['add_time'].'",'.
			'"'.$publish.'",'.
			'"'.$param['diary_order'].'",'.
			'"'.$admin_id.'")';
			
	$res = $db->query($sql);
	if($res)
	{	//add global search
		$id = $db->insert_id();
		$url = 'diary_search.php?diary='.$id;
		$sql_1 = 'INSERT INTO '.$ros->table('search'). ' (type,m_id,keywords,depict,url,admin_id,is_publish,lan) '.
			  'VALUES ("52",'.
			  '"'.$id.'",'.
			  '"'.$param['title'].'",'.
			  '"'.$param['keywords'].'",'.
			  '"'.$url.'",'.
			  '"'.$admin_id.'",'.
			  '"'.$publish.'",'.
			  '"'.$param['diary_lan'].'")';
	    $search_res = $db->query($sql_1);
		if($search_res)
		{	
			return true;
		}
		else
		{
			//del add diary 
			$del_add = 'DELETE FROM '.$ros->table('diary').' WHERE diary_id='.$id;
			$res_del = $db->query($del_add);
			return false;
		}
	}
	else
	{
		return false;
	}
	
	$db->free_result($res);		

}

//find diary information


function search_byDid($id)
{
	global $db,$ros;
	
	$sql = 'SELECT * FROM '.$ros->table('diary'). 'WHERE diary_id='.$id;
	$res = $db->getAll($sql);
	
	return $res;

}
// education
function search_byEid($id)
{
	global $db,$ros;
	
	$sql = 'SELECT * FROM '.$ros->table('education'). 'WHERE education_id='.$id;
	$res = $db->getAll($sql);
	
	return $res;

}

//modify diary

function edit_diary($param,$id)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}

	$publish = empty($param['publish']) ? 0 : $param['publish'];

	$sql = 'UPDATE '.$ros->table('diary'). 'SET '.
			' title ="'.$param['title'].'",'.
			' keywords ="'.$param['keywords'].'",'.
			//' summary ="'.$param['summary'].'",'.
			' lan ="'.$param['diary_lan'].'",'.
			' contant ="'.$param['contantr'].'",'.
			' is_publish = "'.$publish.'",'.
			' `order` = "'.$param['diary_order'].'",'.
			' add_time ="'.$param['add_time'].'"'.
			' WHERE diary_id='.$id;

	$res = $db->query($sql);
	
	if($res)
	{
		//update global search
		$upde_search = 'UPDATE '.$ros->table('search').' SET '.
						' keywords ="'.$param['title'].'",'.
						' lan ="'.$param['diary_lan'].'",'.
						' is_publish = "'.$publish.'",'.
						' depict ="'.$param['keywords'].'"'.
						' WHERE type=52 and m_id='.$id;
		
		$res_u = $db->query($upde_search);
		return true;
	}
	else
	{
		return false;
	}
	$db->free_result($res);
}


//del all diary

function del_diary($id)
{
	global $ros,$db;
	
	if(empty($id))
	{
		return false;
	}
	else
	{
	
		$sql = 'DELETE FROM '.$ros->table('diary').' WHERE diary_id='.$id;
		
		$res = $db->query($sql);
		
	}
	
}


?>