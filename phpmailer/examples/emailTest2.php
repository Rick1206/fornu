<html>
<head>
<title>Email</title>
</head>
<body>
<?php

require_once('../class.phpmailer.php');

$mail                = new PHPMailer();
$body                = file_get_contents('contents.html');
$body             	 = preg_replace("/[\/]/",'',$body);


$mail->IsSMTP();
$mail->SetLanguage('zh_cn');
$mail->SMTPSecure 	 = "ssl";
$mail->SMTPAuth      = true;                  // enable SMTP authentication
$mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
$mail->Host          = "smtp.exmail.qq.com"; 		  // sets the SMTP server
$mail->Port          = 465;                    // set the SMTP port for the GMAIL server
$mail->Username      = "max.liu@foreverloveinchina.com";    // SMTP account username
$mail->Password      = "forever123456";            // SMTP account password

$mail->SetFrom('max.liu@foreverloveinchina.com', 'jbnEmail');

//$mail->AddReplyTo('shy_1206@hotmail.com', 'List manager');

$mail->Subject       = "测试邮件!";

//$mail->MsgHTML("tt");

$mail->Body = "Hello,这是测试邮件!!";

$address = "1491361147@qq.com";
$mail->AddAddress($address, "");


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}


?>

</body>
</html>
