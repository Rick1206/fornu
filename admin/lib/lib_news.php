<?php
/**
 * admin news function 
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

//add news

function add_news($param,$admin_id)
{

	global $db,$ros;
	
	foreach($param as $index => $value)
	{
	
		$param[$index] = htmlspecialchars($value);	
	
	}
	$publish = $param['publish'];
	$sql = 'INSERT INTO '.$ros->table('news'). '(`title`,`keywords`,`contant`,`lan`,`add_time`,`is_publish`,`order`,`admin_id`) '.
			'VALUES ("'.$param['title'].'",'.
			'"'.$param['keywords'].'",'.
			'"'.$param['contant'].'",'.
			//'"'.$param['summary'].'",'.
			'"'.$param['news_lan'].'",'.
			'"'.$param['add_time'].'",'.
			'"'.$publish.'",'.
			'"'.$param['news_order'].'",'.
			'"'.$admin_id.'")';
			
	$res = $db->query($sql);
	if($res)
	{	//add global search
		$id = $db->insert_id();
		$url = 'news_search.php?news='.$id;
		$sql_1 = 'INSERT INTO '.$ros->table('search'). ' (type,m_id,keywords,depict,url,admin_id,is_publish,lan) '.
			  'VALUES ("52",'.
			  '"'.$id.'",'.
			  '"'.$param['title'].'",'.
			  '"'.$param['keywords'].'",'.
			  '"'.$url.'",'.
			  '"'.$admin_id.'",'.
			  '"'.$publish.'",'.
			  '"'.$param['news_lan'].'")';
	    $search_res = $db->query($sql_1);
		if($search_res)
		{	
			return true;
		}
		else
		{
			//del add news 
			$del_add = 'DELETE FROM '.$ros->table('news').' WHERE news_id='.$id;
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

	$publish = empty($param['publish']) ? 0 : $param['publish'];

	$sql = 'UPDATE '.$ros->table('news'). 'SET '.
			' title ="'.$param['title'].'",'.
			' keywords ="'.$param['keywords'].'",'.
			//' summary ="'.$param['summary'].'",'.
			' lan ="'.$param['news_lan'].'",'.
			' contant ="'.$param['contantr'].'",'.
			' is_publish = "'.$publish.'",'.
			' `order` = "'.$param['news_order'].'",'.
			' add_time ="'.$param['add_time'].'"'.
			' WHERE news_id='.$id;

	$res = $db->query($sql);
	
	if($res)
	{
		//update global search
		$upde_search = 'UPDATE '.$ros->table('search').' SET '.
						' keywords ="'.$param['title'].'",'.
						' lan ="'.$param['news_lan'].'",'.
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
		
	}
	
}


?>