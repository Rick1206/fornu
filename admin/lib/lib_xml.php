<?php
/**
 * admin xml function 
 * ============================================================================
 * powered by EmporioAsia
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: John Wu  
 * $email:john@emporioasia.com
*/
if (!defined('IN_SK'))
{
    die('Hacking attempt');
}

//Milestone XML

function attention_xml()
{
	global $ros,$db,$pic_doc;
	
		$pic_dir = "../uploadfiles/".$pic_doc."/";
		$pic_dir_cn = "uploadfiles/".$pic_doc."/";
		$pic_dir_gb = "../uploadfiles/".$pic_doc."/";
		
		$maindata = "";
		$maindata_cn = "";
		$maindata_gb = "";
		
		/*导出XML文件开始*/
		/*获取数据开始*/
		$query_xml = $db->query("SELECT * FROM ".$ros->table('attention')." ORDER BY orderby, attention_id");
		while ($this_xml = $db->fetch_array($query_xml)) {
			if ($this_xml['name_en']) {
			$maindata .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_en']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_cn']) {
			$maindata_cn .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_cn.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_cn']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_gb']) {
			$maindata_gb .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_gb.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_gb']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
		}
		/*获取数据结束*/
		
		/*正式导出XML开始*/
		$XMLdir = "../../../en/";
		$XMLdir_cn = "../../../";
		$XMLdir_gb = "../../../cnt/";
		$cachedata = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_cn = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_gb = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata .= $maindata;
		$cachedata_cn .= $maindata_cn;
		$cachedata_gb .= $maindata_gb;
		$cachedata .= '</data>'."\r\n";
		$cachedata_cn .= '</data>'."\r\n";
		$cachedata_gb .= '</data>'."\r\n";
		@$fp = fopen($XMLdir.'attention.xml', 'w');
		fwrite($fp, $cachedata);
		fclose($fp);
		@$fp = fopen($XMLdir_cn.'attention.xml', 'w');
		fwrite($fp, $cachedata_cn);
		fclose($fp);
		@$fp = fopen($XMLdir_gb.'attention.xml', 'w');
		fwrite($fp, $cachedata_gb);
		fclose($fp);
		/*正式导出XML开始*/
		/*导出XML文件结束*/
}

function team_xml()
{
	global $ros,$db,$pic_doc;
	
		$pic_dir = "../uploadfiles/".$pic_doc."/";
		$pic_dir_cn = "uploadfiles/".$pic_doc."/";
		$pic_dir_gb = "../uploadfiles/".$pic_doc."/";
		
		$maindata = "";
		$maindata_cn = "";
		$maindata_gb = "";
		
		/*导出XML文件开始*/
		/*获取数据开始*/
		$query_xml = $db->query("SELECT * FROM ".$ros->table('team')." ORDER BY orderby, team_id");
		while ($this_xml = $db->fetch_array($query_xml)) {
			if ($this_xml['name_en']) {
			$maindata .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_en']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_cn']) {
			$maindata_cn .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_cn.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_cn']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_gb']) {
			$maindata_gb .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_gb.$this_xml['photo']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_gb']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
		}
		/*获取数据结束*/
		
		/*正式导出XML开始*/
		$XMLdir = "../../../en/";
		$XMLdir_cn = "../../../";
		$XMLdir_gb = "../../../cnt/";
		$cachedata = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_cn = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_gb = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata .= $maindata;
		$cachedata_cn .= $maindata_cn;
		$cachedata_gb .= $maindata_gb;
		$cachedata .= '</data>'."\r\n";
		$cachedata_cn .= '</data>'."\r\n";
		$cachedata_gb .= '</data>'."\r\n";
		@$fp = fopen($XMLdir.'team.xml', 'w');
		fwrite($fp, $cachedata);
		fclose($fp);
		@$fp = fopen($XMLdir_cn.'team.xml', 'w');
		fwrite($fp, $cachedata_cn);
		fclose($fp);
		@$fp = fopen($XMLdir_gb.'team.xml', 'w');
		fwrite($fp, $cachedata_gb);
		fclose($fp);
		/*正式导出XML开始*/
		/*导出XML文件结束*/
}

function gallery_xml()
{
	global $ros,$db,$pic_doc;
	
		$pic_dir = "../uploadfiles/".$pic_doc."/";
		$pic_dir_cn = "uploadfiles/".$pic_doc."/";
		$pic_dir_gb = "../uploadfiles/".$pic_doc."/";
		
		$maindata = "";
		$maindata_cn = "";
		$maindata_gb = "";
		
		/*导出XML文件开始*/
		/*获取数据开始*/
		$query_xml = $db->query("SELECT * FROM ".$ros->table('gallery')." ORDER BY orderby, gallery_id");
		while ($this_xml = $db->fetch_array($query_xml)) {
			if ($this_xml['name_en']) {
			$maindata .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir.$this_xml['image']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_en']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_cn']) {
			$maindata_cn .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_cn.$this_xml['image']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_cn']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
			if ($this_xml['name_gb']) {
			$maindata_gb .= "\t\t<list>\r\n".
						 "\t\t\t<photo>".$pic_dir_gb.$this_xml['image']."</photo>\r\n".
						 "\t\t\t<title><![CDATA[".$this_xml['name_gb']."]]></title>\r\n".
						 "\t\t\t<url></url>\r\n".
						 "\t\t</list>\r\n";
			}
		}
		/*获取数据结束*/
		
		/*正式导出XML开始*/
		$XMLdir = "../../../en/";
		$XMLdir_cn = "../../../";
		$XMLdir_gb = "../../../cnt/";
		$cachedata = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_cn = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata_gb = '<'.'?'.'xml version="1.0" encoding="utf-8"'.'?'.'>'."\r\n".'<data>'."\r\n";
		$cachedata .= $maindata;
		$cachedata_cn .= $maindata_cn;
		$cachedata_gb .= $maindata_gb;
		$cachedata .= '</data>'."\r\n";
		$cachedata_cn .= '</data>'."\r\n";
		$cachedata_gb .= '</data>'."\r\n";
		@$fp = fopen($XMLdir.'gallery.xml', 'w');
		fwrite($fp, $cachedata);
		fclose($fp);
		@$fp = fopen($XMLdir_cn.'gallery.xml', 'w');
		fwrite($fp, $cachedata_cn);
		fclose($fp);
		@$fp = fopen($XMLdir_gb.'gallery.xml', 'w');
		fwrite($fp, $cachedata_gb);
		fclose($fp);
		/*正式导出XML开始*/
		/*导出XML文件结束*/
}
?>