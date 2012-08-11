<?php
define('IN_SK',true);

require_once('./includes/init.php');

if($_POST["type"] != ""){	
	$fornuType = $_POST["type"];
}

//echo $fornuType;
error_reporting(E_ALL);

switch($fornuType){
	case "users":
	//--- 财力 ---//
	
	
	$updateSql = $db->query("INSERT INTO ".$ros->table('users')." (umobile, unickname, uemail, upsw, umname, ulocation, uaddress, uphone, uzipcode, unow, umaga, uactivity, ucontact, dateline) VALUES ('". $_POST["umobile"]."', '".$_POST["unickname"]."', '".$_POST["uemail"]."', '".$_POST["upsw"]."', '".$_POST["umname"]."', '".$_POST["ulocation"]."', '".$_POST["uaddress"]."', '".$_POST["uphone"]."', '".$_POST["uzipcode"]."', '".$_POST["unow"]."', '".$_POST["umaga"]."', '".$_POST["uactivity"]."', '".$_POST["ucontact"]."', '".date('Y-m-d')."')");	
	
	if($updateSql){
		echo "1";	
	}else{
		echo "0";
	}

	
	break;
	
	case "email":
	
	require_once('./phpmailer/class.phpmailer.php');
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SetLanguage('zh_cn','phpmailer/language/');
    $mail->CharSet 		 = "utf-8"; 
    $mail->Encoding		 = "base64";
	$mail->SMTPSecure 	 = "ssl";
	$mail->SMTPAuth      = true;                  
	$mail->SMTPKeepAlive = true;                  
	$mail->Host          = "smtp.exmail.qq.com"; 		  
	$mail->Port          = 465;                    
	$mail->Username      = "max.liu@foreverloveinchina.com";    
	$mail->Password      = "forever123456";            
	
	$mail->SetFrom('max.liu@foreverloveinchina.com', 'JBNEmail');
	
	$mail->Subject       = "家百浓邮件";
	
	$body = preg_replace("/[\/]/",'',$_POST["email_body"]);
	
	$mail->MsgHTML($body);
	
	$address = $_POST["email_address"];
	
	$mail->AddAddress($address, "");
	
	$mail->AddCC('cindy.cheng@foreverloveinchina.com','cindy');
	
	$mail->AddCC('max.liu@foreverloveinchina.com','max');
	
	if(!$mail->Send()) {
	  echo "1";
	} else {
	  echo "0";
	}
	break;
	
	case "check":
	if( $_POST["ucheckcode"] == $_SESSION["Checknum"]){
		echo "1";
	}else{
		echo "0";
	}
	
	
	break;
	
	
	
}


	
?>
