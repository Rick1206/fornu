<?php
/**
 * admin news funcion 
 * ============================================================================
 * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
if (!defined('IN_SK'))
{
    die('Hacking attempt');
}

//add news

function add_news($param)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	
	$sql = 'INSERT INTO '.$ros->table('news'). '(title,keywords,contant,lan,add_time) '.
			'VALUES ("'.$param['title'].'",'.'"'.$param['keywords'].'",'.'"'.$param['contant'].'",'.'"'.$param['news_lan'].'",'.'"'.$param['add_time'].'")';
			
	
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

//find news information


function search_infor($id)
{
	global $db,$ros;
	
	$sql = 'SELECT * FROM '.$ros->table('news'). 'WHERE news_id='.$id;
	$res = $db->getAll($sql);
	
	return $res;
}

//modify news

function edit_news($param,$id)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	
	$sql = 'UPDATE '.$ros->table('news'). 'SET '.
			' title ="'.$param['title'].'",'.
			' keywords ="'.$param['keywords'].'",'.
			' lan ="'.$param['news_lan'].'",'.
			' contant ="'.$param['contantr'].'",'.
			' add_time ="'.$param['add_time'].'"'.
			' WHERE news_id='.$id;

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


//del all news

function del_news($id)
{
	global $ros,$db;
	
	if(empty($id))
	{
		return false;
	}
	else
	{
	
		$sql = 'DELETE FROM '.$ros->table('news').' WHERE news_id='.$id;
		
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