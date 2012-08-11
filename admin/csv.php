<?php
/**
 * this is a center that contorl website information
 * ============================================================================
 * power by Rick
 * http://www.emporioasia.com
 * ----------------------------------------------------------------------------
 * $Author: Calvin Shen  
 * $email:calvin@emporioasia.com
 *
*/
define('IN_SK',true);
require(dirname(__FILE__) . '/includes/init.php');	

$thistype = 'csv';
$attachdir = "../uploadfiles/".$thistype."/";

$phototype = array('csv');

if($_POST['Submit'] == "Import") {
	$photo1 = ($photos = attach_upload($phototype,'photo')) ? 1 : 0;

	if ($photo1) {
		foreach($photos as $photo) {
			$row = 1;
			$wrong_txt = "";
			$handle = fopen ($attachdir.$photo['attachment'],"r");
			while ($data = fgetcsv ($handle, 1000, ",")) {
    			if ($row>1) {
					$title = mb_convert_encoding($data[0],"UTF-8","gb2312,gbk,utf-8");
					$detail = mb_convert_encoding($data[1],"UTF-8","gb2312,gbk,utf-8");
        			$db->query("INSERT INTO ".$ros->table('news')." (news_type, title_cn, description_cn, dateline) VALUES (1, '".$title."', '".$detail."', '".$data[2]."')");
				}
				$row++;
			}
			fclose ($handle);
			@unlink($attachdir.$photo['attachment']);
			echo "All of imported data was successful.";
		}
	}
	else
	{
		echo "Import File upload false.";
	}
} else {
?>
<form action="csv.php" method="post" enctype="multipart/form-data" name="csv" id="csv">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="STYLE1">Import item File:</span>
	  <input type=file name="photo[]" size=20>
	  <input type="submit" name="Submit" value="Import" />
	  <span class="STYLE1">Import file type must be .csv	  </span></td>
    </tr>
  </table>
</form>
<?php
}
?>