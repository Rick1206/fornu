<?php
/**
 * backend public function
 * ============================================================================
 * power by Rick
 * http://www.digitalcn.net
 * ----------------------------------------------------------------------------
 * $Author: Rick Shi  
 * $email:1491361147@qq.com
 * $Id: index.php 2009-09-15 14:39
*/


if (!defined('IN_SK')){
    die('Hacking attempt');
}

//show msg box
function show_msg($infor,$url){
   
	if(empty($url))
	{
		$message1= "";
		$message2 = "
			<script>
  			var secs =3; 
			for(var i=secs;i>=0;i--)   
			{   
			window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000);   
			}   
			function doUpdate(num)   
			{   
				document.getElementById('showTime').innerHTML = num + '秒后自动跳转' ;   
				if(num == 0) { window.history.go(-1); }   
            }
			</script>";
	}
	else
	{
		$message1 = "<br>如果您的浏览器没有跳转，请点击<a href=\"$url\">这里</a>。";
		$message2 = "
				<script>
				var secs =3; //automatically Jump   
				var URL ='$url';   
				for(var i=secs;i>=0;i--)   
				{   
				window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000);   
				}   
				function doUpdate(num)   
				{   
					document.getElementById('showTime').innerHTML = num + '秒后自动跳转' ;   
					if(num == 0) { window.location=URL; }   
				}
				</script>
				";
	}
	$table = '<br><br>
	            <table width="300" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
				  <tr>
					<td height="20" bgcolor="#999999">&nbsp;</td>
				  </tr>
				  <tr>
					<td align="center" valign="top"><br />
					<strong>'.$infor.'</strong><br /><br />
					'.$message1.'<br />
					'.$message2.'
					<p id="showTime"></p>
					</td>
				  </tr>
			  </table>';

	echo  $table;
	exit;
}
//计算数据库占用大小
function sizecount($filesize) {
	if($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 . ' G';
	} elseif($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 . ' M';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' K';
	} else {
		$filesize = $filesize . ' bytes';
	}
	return $filesize;
}

//文件名字
function fileext($filename) {
	return trim(substr(strrchr($filename, '.'), 1));
}

//上传名
function random($length, $numeric = 0) {
	mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

//上传图片
function attach_upload($extension, $filename = '') {
	global $_FILES, $attachdir, $attachdesc;
	$filename = $filename != '' ? $filename : 'attach';
	$attachments = $attacharray = array();
	if(!(@file_exists($attachdir) && is_dir($attachdir))) {
		mkdir($attachdir, 0777);
	}
	
	if(isset($_FILES[$filename]) && is_array($_FILES[$filename])) {
		foreach($_FILES[$filename] as $key => $var) {
			foreach($var as $id => $val) {
				$attachments[$id][$key] = $val;
			}
		}
	}
	foreach($attachments as $key => $attach) {
		$attach_saved = false;

		if(!($attach['tmp_name'] != 'none' && $attach['tmp_name'] && $attach['name'])) {
			continue;
		}

		$attach['ext'] = strtolower(fileext($attach['name']));
		$attach['attachment'] = time().'_'.random(10).'.'.$attach['ext'];
		$target = $attachdir.stripslashes($attach['attachment']);

		if(is_array($extension) && !in_array($attach['ext'], $extension)) {
			
			@show_msg("图片支持的格式是 ".implode(',', $extension)."，请重新上传。");
		}
		
		if(@copy($attach['tmp_name'], $target) || (function_exists('move_uploaded_file') && @move_uploaded_file($attach['tmp_name'], $target))) {
			@unlink($attach['tmp_name']);
			$attach_saved = true;
		}
		
		if(!$attach_saved && @is_readable($attach['tmp_name'])) {
			@$fp = fopen($attach['tmp_name'], 'rb');
			@flock($fp, 2);
			@$attachedfile = fread($fp, $attach['size']);
			@fclose($fp);

			@$fp = fopen($target, 'wb');
			@flock($fp, 2);
			if(@fwrite($fp, $attachedfile)) {
				@unlink($attach['tmp_name']);
				$attach_saved = true;
			}
			@fclose($fp);
		}

		if($attach_saved) {
			$attach['description'] = cut_str(dhtmlspecialchars($attachdesc[$key]), 100);
			$attacharray[] = $attach;
		}
	}
	return !empty($attacharray) ? $attacharray : false;
}
//处理htmlspecialchars
function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = str_replace('&', '&amp;', $string);
		$string = str_replace('"', '&quot;', $string);
		$string = str_replace('<', '&lt;', $string);
		$string = str_replace('>', '&gt;', $string);
		$string = preg_replace('/&amp;(#\d{3,5};)/', '&\\1', $string);
	}
	return $string;
}

/**
 *生成缩略图
 * $f file name 
 * $s thumb name  
 * $w width 
 * $h height
 * $add address save images
*/
function resize_image($fr,$sr,$w,$h,$add){
	
	$f = $add.$fr;
	$s = $add.$sr;
	
	
	$data= getimagesize($f);
	
	switch($data[2]){
		case 1:
			$im=@imagecreatefromgif( $f );
			break;
		case 2:
			$im=@imagecreatefromjpeg( $f );
			break;
		case 3:
			$im=@imagecreatefrompng( $f );
			break;
	}
	$sw=$data[0];
	$sh=$data[1];
	if( $sw>$w || $sh>$h )
	{
		
		if( $sw>$w && $sh>$h )
		{
			if( ($sh/$h) > ($sw/$w) )
			{
				$dh=$h;
				$dw=round( ($sw*$h)/$sh );
			}
			else
			{
				$dw=$w;
				$dh=round( ($sh*$w)/$sw );
			}
			
		}
		elseif( $sw > $w)
		{
			$dw=$w;
			$dh=round( ($sh*$w)/$sw );
		}
		elseif ($sh>$h)
		{
			$dh=$h;
			$dw=round(($sw*$h)/$sh);
		}
		
		$ni=imagecreatetruecolor($w,$h);
		$color_white=imagecolorallocate($ni,255,255,255);
		imagefill($ni,0,0,$color_white);
		imagecopyresampled($ni,$im,0,0,0,0,$dw,$dh,$sw,$sh);
		switch($data[2]){
		case 1:
			imagegif($ni,$s);
			break;
		case 2:
			imagejpeg($ni,$s);
			break;
		case 3:
			imagepng($ni,$s);
			break;
		}
		
		imagedestroy($im);
		imagedestroy($ni);
	}
	else
	{
		copy($f, $s);
	}
	
	
	return $sr;
}

function flashspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = flashspecialchars($val);
		}
	} else {
		$string = str_replace('&ldquo;', '“', $string);
		$string = str_replace('&rdquo;', '”', $string);
		$string = str_replace('&lsquo;', '‘', $string);
		$string = str_replace('&rsquo;', '’', $string);
		$string = str_replace('&mdash;', '—', $string);
		$string = str_replace('&hellip;&hellip;', '……', $string);
		$string = str_replace('&bull;', '•', $string);
		$string = str_replace('&middot;', '•', $string);
		$string = str_replace('&ouml;', 'ö', $string);
		$string = str_replace('&szlig;', 'ß', $string);
		$string = str_replace('&auml;', 'ä', $string);
		$string = str_replace('&ndash;', '—', $string);
		$string = str_replace('&uuml;', 'ü', $string);
		$string = str_replace('&bdquo;', '„', $string);
		$string = str_replace('&ntilde;', 'ñ', $string);
		$string = str_replace('&agrave;', 'à', $string);
		$string = str_replace('&oacute;', 'ó', $string);
		$string = str_replace('strong>', 'b>', $string);
		$string = str_replace('em>', 'i>', $string);
	}
	return $string;
}
//xls
function attach_upload_xls($extension, $filename = '',$str,$xlsName) {
	global $_FILES, $attachdir, $attachdesc;
	$filename = $filename != '' ? $filename : 'attach';
	$attachments = $attacharray = array();
	if(!(@file_exists($attachdir) && is_dir($attachdir))) {
		mkdir($attachdir, 0777);
	}
	
	if(isset($_FILES[$filename]) && is_array($_FILES[$filename])) {
		foreach($_FILES[$filename] as $key => $var) {
			foreach($var as $id => $val) {
				$attachments[$id][$key] = $val;
			}
		}
	}
	foreach($attachments as $key => $attach) {
		
		$attach_saved = false;

		if(!($attach['tmp_name'] != 'none' && $attach['tmp_name'] && $attach['name'])) {
			continue;
		}

		$attach['ext'] = strtolower(fileext($attach['name']));
		
		//$attach['attachment'] = time().'_'.random(10).'.'.$attach['ext'];
		
		$attach['attachment'] = $xlsName.'.'.$attach['ext'];
		
		$target = $attachdir.stripslashes($attach['attachment']);

		if(is_array($extension) && !in_array($attach['ext'], $extension)) {
			
			return $str.implode(',', $extension)."，请重新上传。";
		}
		
		if(@copy($attach['tmp_name'], $target) || (function_exists('move_uploaded_file') && @move_uploaded_file($attach['tmp_name'], $target))) {
			@unlink($attach['tmp_name']);
			$attach_saved = true;
		}
		
		if(!$attach_saved && @is_readable($attach['tmp_name'])) {
			@$fp = fopen($attach['tmp_name'], 'rb');
			@flock($fp, 2);
			@$attachedfile = fread($fp, $attach['size']);
			@fclose($fp);

			@$fp = fopen($target, 'wb');
			@flock($fp, 2);
			if(@fwrite($fp, $attachedfile)) {
				@unlink($attach['tmp_name']);
				$attach_saved = true;
			}
			@fclose($fp);
		}

		if($attach_saved) {
			$attach['description'] = cut_str(dhtmlspecialchars($attachdesc[$key]), 100);
			$attacharray[] = $attach;
		}
	}
	return !empty($attacharray) ? $attacharray : false;
}

?>