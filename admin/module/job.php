<?php

/**
 * admin job funcion 
 * ============================================================================ * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
if (!defined('IN_SK'))
{
    die('Hacking attempt');
}

//add job

function add_job($param)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	
	$sql = 'INSERT INTO '.$ros->table('job'). '(title,contant,lan,add_time,end_time,address,company_type,company_name) '.
			'VALUES ("'.$param['title'].'",'.
			'"'.$param['contant'].'",'.
			'"'.$param['job_lan'].'",'.
			'"'.$param['add_time'].'",'.
			'"'.$param['end_time'].'",'.
			'"'.$param['job_address'].'",'.
			'"'.$param['company_type'].'",'.
			'"'.$param['company_name'].'")';
			
	
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

//find job information


function search_job($id)
{
	global $db,$ros;
	
	
	$sql = 'SELECT * FROM '.$ros->table('job'). 'WHERE job_id='.$id;

	$res = $db->getAll($sql);
	
	return $res;
	

}

//modify job

function edit_job($param,$id)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	
	$sql = 'UPDATE '.$ros->table('job'). 'SET '.
			' title ="'.$param['title'].'",'.
			//' keywords ="'.$param['keywords'].'",'.
			' lan ="'.$param['job_lan'].'",'.
			' contant ="'.$param['contantr'].'",'.
			' end_time ="'.$param['end_time'].'",'.
			' address ="'.$param['job_address'].'",'.
			' company_name ="'.$param['company_name'].'",'.
			' company_type ="'.$param['company_type'].'",'.
			' add_time ="'.$param['add_time'].'"'.
			' WHERE job_id='.$id;

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


//del all job

function del_job($id)
{
	global $ros,$db;
	
	if(empty($id))
	{
		return false;
	}
	else
	{
	
		$sql = 'DELETE FROM '.$ros->table('job').' WHERE job_id='.$id;
		
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
	
}


?>