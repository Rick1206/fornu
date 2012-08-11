<?php

/**
 * backend param funcion 
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
*/
//system paramtion

$param = $_POST;

//web manage
$u_group	= array('1'=>'网站管理员');

//select langauge
$lan = array(
				'1'=>'中文',
				'2'=>'English'
			);


//to contorl the information's display
$publish= array(
					'1' =>'是',
					'0' => '否' 
				
				);


//os language
$_L		= array(
					'edit' => '编辑',
					'refu' => '刷新',
					'show' => '查看'
				);
				
				
//os set 

$_S		= array(
					'publish' =>'1'
				);				
				
$now_date	= date('Y-m-d');

//admin finance
$_Ftype		= array(
					'0' => '收入',
					'1' => '支出'
				);
				
				
$_user_job = array(
					'0' => '保育',
					'1' => '教育',
					'2' => '后勤',
					'3' => '医护',
					'4' => '营养师'
				);


?>