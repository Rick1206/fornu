<?php
class page 
{
	var $num = '';
	var $perpage = '';
	var $curr_page = '';
	var $mpurl = '';
	
  	function page_num($num, $perpage, $curr_page, $mpurl) 
	{
		$multipage = '';
		if($num > $perpage) 
		{
			$page = 10;
			$offset = 2;
			$pages = ceil($num / $perpage);
			$from = $curr_page - $offset;
			$to = $curr_page + $page - $offset - 1;
			
			if($page > $pages) 
			{
				$from = 1;
				$to = $pages;
			
			}else{
			
				if($from < 1) 
				{
					$to = $curr_page + 1 - $from;
					$from = 1;
					if(($to - $from) < $page && ($to - $from) < $pages) 
					{
						$to = $page;
					}
				}
				elseif($to > $pages)
				{
					$from = $curr_page - $pages + $to;
					$to = $pages;
					if(($to - $from) < $page && ($to - $from) < $pages) 
					{
						$from = $pages - $page + 1;
					}
				}
			}
			if (stristr($mpurl,"?")) {
				$multi_type = "&";
			} else {
				$multi_type = "?";
			}
			$multipage .= '<a href="'.$mpurl.$multi_type.'page=1">&lt;&lt;</a> &nbsp;';
			for($i = $from; $i <= $to; $i++) 
			{
				if($i != $curr_page) 
				{
					$multipage .= '<a href="'.$mpurl.$multi_type.'page='.$i.'">['.$i.']</a>&nbsp;';
				}else{
					$multipage .= '<u><b>['.$i.']</b></u>&nbsp;';
				}
			}
			$multipage .= $pages > $page ? " ... <a href=\"".$mpurl.$multi_type."page=$pages\"> [$pages]</a> <a href=\"".$mpurl.$multi_type."page=$pages\">&gt;&gt;</a>" : " <a href=\"".$mpurl.$multi_type."page=$pages\">&gt;&gt;</a>";
		}
		return $multipage;
	}


}

class page_1 extends page
{
	//sql  curr_page当前分页数 $page_num 分页显示数据
	function page_all_num($table,$where)
	{
		global $db,$ros;
		
		$sql = "SELECT * FROM ".$ros->table($table). $where;
		
		$row = $db->query($sql);
		
		$all_num = $db->num_rows($row);
		
		return $all_num;
	}
	
	/**
	 *$table 表格  curr_page 当前分页数  page_num 每页显示数 page_url 分页页面  	$where url查询时候的参数
	*/
	
	function page_array($table,$where,$order,$curr_page,$page_num)
	{
		global $db,$ros;
		
		//如果连接地址为空
		$sql_where = empty($where) ? '' : $where;
		
		$sql_order	= empty($order) ? '' : $order;
		
		//如果当前页面是1 ，这SQL从零开始
		//$curr_page = ( ( ( empty($curr_page) ) ? 0 : $curr_page ) == 1 ) ? 0 : $curr_page ;
		
		//$curr_page = ( $curr_page==0 ) ? 0 : $curr_page;
		
		//$curr_page = ( $curr_page==1) ? 1 : $curr_page;

		//开始查询数据
		$sql = 'SELECT * FROM '.$ros->table($table). $sql_where . $sql_order . ' LIMIT '.$curr_page .' , '.$page_num;
		
		//echo $sql;
		$a	 = $db->getAll($sql);
		
		return $a;
	}
	

}

function multi_en($num, $perpage, $curr_page, $mpurl) {
	$multipage = '';
	if($num > $perpage) {
		$page = 10;
		$offset = 2;
		$pages = ceil($num / $perpage);
		$from = 1;
		$to = $pages;
		if (stristr($mpurl,"?")) {
			$multi_type = "&";
		} else {
			$multi_type = "?";
		}
		for($i = $from; $i <= $to; $i++) {
			if($i != $curr_page) {
				$multipage .= '<a href="'.$mpurl.$multi_type.'page='.$i.'">'.$i.'</a>';
			} else {
				$multipage .= '<a href="'.$mpurl.$multi_type.'page='.$i.'" class="now">'.$i.'</a>';
			}
		}
		$multipage = "<a href=\"".($curr_page>1 ? $mpurl.$multi_type."page=".($curr_page-1) : "javascript:void(0);")."\" class=\"pageleft".($curr_page>1 ? "" : " disable")."\">Prov</a><a href=\"".($curr_page<$pages ? $mpurl.$multi_type."page=".($curr_page+1) : "javascript:void(0);")."\" class=\"pageright".($curr_page<$pages ? "" : " disable")."\">Next</a>";
	}
	return $multipage;
}

function multi_cn($num, $perpage, $curr_page, $mpurl) {
	$multipage = '';
	if($num > $perpage) {
		$page = 10;
		$offset = 2;
		$pages = ceil($num / $perpage);
		$from = 1;
		$to = $pages;
		if (stristr($mpurl,"?")) {
			$multi_type = "&";
		} else {
			$multi_type = "?";
		}
		for($i = $from; $i <= $to; $i++) {
			if($i != $curr_page) {
				$multipage .= '<a href="'.$mpurl.$multi_type.'page='.$i.'">'.$i.'</a>';
			} else {
				$multipage .= '<a href="'.$mpurl.$multi_type.'page='.$i.'" class="now">'.$i.'</a>';
			}
		}
		$multipage = "<a href=\"".($curr_page>1 ? $mpurl.$multi_type."page=".($curr_page-1) : "javascript:void(0);")."\" class=\"pageleft".($curr_page>1 ? "" : " disable")."\">上一页</a><a href=\"".($curr_page<$pages ? $mpurl.$multi_type."page=".($curr_page+1) : "javascript:void(0);")."\" class=\"pageright".($curr_page<$pages ? "" : " disable")."\">下一页</a>";
	}
	return $multipage;
}

class page_2{
	
	function getNext($table,$uid,$id){
			
			global $db,$ros;
			
			$sql = 'SELECT '.$uid.', dateline, orderby FROM '.$ros->table($table).' WHERE '.$uid.' = '.$id.' limit 0,1';
			
			$row = $db->query($sql);
			
			$now = $db->fetch_array($row);
			
			$curtime = "'".$now['dateline']."'";
			
			$curorder = $now['orderby'];
			
			$sql = 'SELECT '.$uid.' FROM '.$ros->table($table).' WHERE orderby >= '.$curorder.' and dateline <= '.$curtime.' ';
			
			return $sql;
			
			$row = $db->query($sql);
			
			$res = $db->fetch_array($row);
			
			//$now = null;
			
			return $res[$uid];
			
	}

}

?>