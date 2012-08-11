<?php 
class Email { 
//---����ȫ�ֱ��� 
var $mailTo = ""; // �ռ��� 
var $mailCC = ""; // ���� 
var $mailBCC = ""; // ���ܳ��� 
var $mailFrom = ""; // ������ 
var $mailSubject = ""; // ���� 
var $mailText = ""; // �ı���ʽ���ż����� 
var $mailHTML = ""; // html��ʽ���ż����� 
var $mailAttachments = ""; // ���� 
/* ����setTo($inAddress) :���ڴ����ʼ��ĵ�ַ ���� $inAddress 
Ϊ����һ�������ִ�,email��ַ����,ʹ�ö������ָ����ʼ���ַ 
Ĭ�Ϸ���ֵΪtrue 
**********************************************************/ 
function setTo($inAddress){ 
//--��explode()�������ݡ�,�����ʼ���ַ���зָ� 
$addressArray = explode( ",",$inAddress); 
//--ͨ��ѭ�����ʼ���ַ�ĺϷ��Խ��м�� 
for($i=0;$i<count($addressArray);$i++){ if($this->checkEmail($addressArray[$i])==false) return false; } 
//--���кϷ���email��ַ���������� 
$this->mailTo = implode($addressArray, ","); 
return true; } 
/************************************************** 
���� setCC($inAddress) ���ó������ʼ���ַ 
���� $inAddress Ϊ����һ�������ʼ���ַ���ִ�,email��ַ����, 
ʹ�ö������ָ����ʼ���ַ Ĭ�Ϸ���ֵΪtrue 
**************************************************************/ 
function setCC($inAddress){ 
//--��explode()�������ݡ�,�����ʼ���ַ���зָ� 
$addressArray = explode( ",",$inAddress); 
//--ͨ��ѭ�����ʼ���ַ�ĺϷ��Խ��м�� 
for($i=0;$i<count($addressArray);$i++){ if($this->checkEmail($addressArray[$i])==false) return false; } 
//--���кϷ���email��ַ���������� 
$this->mailCC = implode($addressArray, ","); 
return true; } 
/*************************************************** 
����setBCC($inAddress) �������ܳ��͵�ַ ���� $inAddress Ϊ����һ����� 
���ʼ���ַ���ִ�,email��ַ����,ʹ�ö������ָ����ʼ���ַ Ĭ�Ϸ���ֵΪ 
true 
******************************************/ 
function setBCC($inAddress){ 
//--��explode()�������ݡ�,�����ʼ���ַ���зָ� 
$addressArray = explode( ",",$inAddress); 
//--ͨ��ѭ�����ʼ���ַ�ĺϷ��Խ��м�� 
for($i=0;$i<count($addressArray);$i++) 
{ if($this->checkEmail($addressArray[$i])==false) 
return false; 
} 
//--���кϷ���email��ַ���������� 
$this->mailBCC = implode($addressArray, ","); 
return true; 
} 
/***************************************************************** 
����setFrom($inAddress):���÷����˵�ַ ���� $inAddress Ϊ�����ʼ� 
��ַ���ִ�Ĭ�Ϸ���ֵΪtrue 
***************************************/ 
function setFrom($inAddress){ 
if($this->checkEmail($inAddress)){ 
$this->mailFrom = $inAddress; 
return true; 
} return false; } 
/********************** 
���� setSubject($inSubject) ���������ʼ��������$inSubjectΪ�ִ�, 
Ĭ�Ϸ��ص���true 
*******************************************/ 
function setSubject($inSubject){ 
if(strlen(trim($inSubject)) > 0){ 
$this->mailSubject = ereg_replace( "\n", "<br>",$inSubject); 
return true; } 
return false; } 
/**************************************************** 
����setText($inText) �����ı���ʽ���ʼ�������� $inText Ϊ�ı�����Ĭ 
�Ϸ���ֵΪtrue 
****************************************/ 
function setText($inText){ 
if(strlen(trim($inText)) > 0){ 
$this->mailText = $inText; 
return true; } 
return false; 
} 
/********************************** 
����setHTML($inHTML) ����html��ʽ���ʼ��������$inHTMLΪhtml��ʽ, 
Ĭ�Ϸ���ֵΪtrue 
************************************/ 
function setHTML($inHTML){ 
if(strlen(trim($inHTML)) > 0){ 
$this->mailHTML = $inHTML; 
return true; } 
return false; } 
/********************** 
���� setAttachments($inAttachments) �����ʼ��ĸ��� ����$inAttachments 
Ϊһ������Ŀ¼���ִ�,Ҳ���԰�������ļ��ö��Ž��зָ� Ĭ�Ϸ���ֵΪtrue 
*******************************************/ 
function setAttachments($inAttachments){ 
if(strlen(trim($inAttachments)) > 0){ 
$this->mailAttachments = $inAttachments; 
return true; } 
return false; } 
/********************************* 
���� checkEmail($inAddress) :�����������ǰ���Ѿ����ù���,��Ҫ���� 
���ڼ��email��ַ�ĺϷ��� 
*****************************************/ 
function checkEmail($inAddress){ 
return (ereg( "^[^@ ]+@([a-zA-Z0-9-]+.)+([a-zA-Z0-9-]{2}|net|com|gov|mil|org|edu|int)$",$inAddress)); 
} 
/************************************************* 
����loadTemplate($inFileLocation,$inHash,$inFormat) ��ȡ��ʱ�ļ����� 
�滻���õ���Ϣ����$inFileLocation���ڶ�λ�ļ���Ŀ¼ 
$inHash ���ڴ洢��ʱ��ֵ $inFormat ���ڷ����ʼ����� 
***********************************************************/ 
function loadTemplate($inFileLocation,$inHash,$inFormat){ 
/* �����ʼ�������������: Dear ~!UserName~, 
Your address is ~!UserAddress~ */ 
//--���С�~!��Ϊ��ʼ��־��~��Ϊ������־ 
$templateDelim = "~"; 
$templateNameStart = "!"; 
//--�ҳ���Щ�ط����������滻�� 
$templateLineOut = ""; //--����ʱ�ļ� 
if($templateFile = fopen($inFileLocation, "r")){ 
while(!feof($templateFile)){ 
$templateLine = fgets($templateFile,1000); 
$templateLineArray = explode($templateDelim,$templateLine); 
for( $i=0; $i<count($templateLineArray);$i++){ 
//--Ѱ����ʼλ�� 
if(strcspn($templateLineArray[$i],$templateNameStart)==0){ 
//--�滻��Ӧ��ֵ 
$hashName = substr($templateLineArray[$i],1); 
//--�滻��Ӧ��ֵ 
$templateLineArray[$i] = ereg_replace($hashName,(string)$inHash[$hashName],$hashName); 
} 
} 
//--����ַ����鲢���� 
$templateLineOut .= implode($templateLineArray, ""); 
} //--�ر��ļ�fclose($templateFile); 
//--���������ʽ(�ı���html) 
if( strtoupper($inFormat)== "TEXT" ) 
return($this->setText($templateLineOut)); 
else if( strtoupper($inFormat)== "HTML" ) 
return($this->setHTML($templateLineOut)); 
} return false; 
} 
/***************************************** 
���� getRandomBoundary($offset) ����һ������ı߽�ֵ 
���� $offset Ϊ���� �C ���ڶ�ܵ��ĵ��� ����һ��md5()������ִ� 
****************************************/ 
function getRandomBoundary($offset = 0){ 
//--��������� 
srand(time()+$offset); 
//--���� md5 �����32λ �ַ����ȵ��ִ� 
return ( "----".(md5(rand()))); } 
/******************************************** 
����: getContentType($inFileName)�����жϸ��������� 
**********************************************/ 
function getContentType($inFileName){ 
//--ȥ��·�� 
$inFileName = basename($inFileName); 
//--ȥ��û����չ�����ļ� 
if(strrchr($inFileName, ".") == false){ 
return "application/octet-stream"; 
} 
//--������չ���������ж� 
$extension = strrchr($inFileName, "."); 
switch($extension){ 
case ".gif": return "image/gif"; 
case ".gz": return "application/x-gzip"; 
case ".htm": return "text/html"; 
case ".html": return "text/html"; 
case ".jpg": return "image/jpeg"; 
case ".tar": return "application/x-tar"; 
case ".txt": return "text/plain"; 
case ".zip": return "application/zip"; 
default: return "application/octet-stream"; 
} 
return "application/octet-stream"; 
} 
/********************************************** 
����formatTextHeader���ı����ݼ���text���ļ�ͷ 
*****************************************************/ 
function formatTextHeader(){ $outTextHeader = ""; 
$outTextHeader .= "Content-Type: text/plain;charset=us-asciin"; 
$outTextHeader .= "Content-Transfer-Encoding: 7bit\n\n"; 
$outTextHeader .= $this->mailText. "\n"; 
return $outTextHeader; 
} /************************************************ 
����formatHTMLHeader()���ʼ��������ݼ���html���ļ�ͷ 
******************************************/ 
function formatHTMLHeader(){ 
$outHTMLHeader = ""; 
$outHTMLHeader .= "Content-Type: text/html;charset=us-asciin"; 
$outHTMLHeader .= "Content-Transfer-Encoding: 7bit\n\n"; 
$outHTMLHeader .= $this->mailHTML. "\n"; 
return $outHTMLHeader; 
} 
/********************************** 
���� formatAttachmentHeader($inFileLocation) ���ʼ��еĸ�����ʶ���� 
********************************/ 
function formatAttachmentHeader($inFileLocation){ 
$outAttachmentHeader = ""; 
//--������ĺ���getContentType($inFileLocation)�ó��������� 
$contentType = $this->getContentType($inFileLocation); 
//--����������ı������ñ�׼��7λ���� 
if(ereg("text",$contentType)){ 
$outAttachmentHeader .= "Content-Type: ".$contentType. ";\n"; 
$outAttachmentHeader .= ' name="'.basename($inFileLocation). '"'. "\n"; 
$outAttachmentHeader .= "Content-Transfer-Encoding: 7bit\n"; 
$outAttachmentHeader .= "Content-Disposition: attachment;\n"; 
$outAttachmentHeader .= ' filename="'.basename($inFileLocation). '"'. "\n\n"; 

$textFile = fopen($inFileLocation, "r"); 
while(!feof($textFile)){ 
$outAttachmentHeader .= fgets($textFile,1000); 
} 
//--�ر��ļ� fclose($textFile); 
$outAttachmentHeader .= "\n"; 
} 
//--���ı���ʽ����64λ���б��� 
else{
$outAttachmentHeader .= "Content-Type: ".$contentType. ";\n"; 
$outAttachmentHeader .= ' name="'.basename($inFileLocation). '"'. "\n"; 
$outAttachmentHeader .= "Content-Transfer-Encoding: base64\n"; 
$outAttachmentHeader .= "Content-Disposition: attachment;\n"; 
$outAttachmentHeader .= ' filename="'.basename($inFileLocation). '"'. "\n\n"; 
//--�����ⲿ����uuencode���б��� 
/*exec( "uuencode -m $inFileLocation nothing_out",$returnArray); 
for ($i = 1; $i<(count($returnArray)); $i++){ 
$outAttachmentHeader .= $returnArray[$i]. "\n"; 
} */
$fp=fopen($inFileLocation,"r"); 
if($fp) 
 { 
 $outAttachmentBody=fread($fp,filesize($inFileLocation)); 
 $outAttachmentBody=base64_encode($outAttachmentBody); 
 $outAttachmentBody=chunk_split($outAttachmentBody); 
 fclose($fp); 
 } 
 $outAttachmentHeader.=$outAttachmentBody."\n"; 

} return $outAttachmentHeader; 
} 
/****************************** 
���� send()���ڷ����ʼ������ͳɹ�����ֵΪtrue 
************************************/ 
function send(){ 
//--�����ʼ�ͷΪ�� 
$mailHeader = ""; 
//--��ӳ����� 
if($this->mailCC != "") 
$mailHeader .= "CC: ".$this->mailCC. "\n"; 
//--������ܳ����� 
if($this->mailBCC != "") 
$mailHeader .= "BCC: ".$this->mailBCC. "\n"; 
//--��ӷ����� 
if($this->mailFrom != "") 
$mailHeader .= "FROM: ".$this->mailFrom. "\n"; 
//---------------------------�ʼ���ʽ------------------------------ 
//--�ı���ʽ 
if($this->mailText != "" && $this->mailHTML == "" && $this->mailAttachments == ""){ 
return mail($this->mailTo,$this->mailSubject,$this->mailText,$mailHeader); 
} 
//--html��text��ʽ 
else if($this->mailText != "" && $this->mailHTML != "" && $this->mailAttachments == ""){ 
$bodyBoundary = $this->getRandomBoundary(); 
$textHeader = $this->formatTextHeader(); 
$htmlHeader = $this->formatHTMLHeader(); 
//--���� MIME-�汾 
$mailHeader .= "MIME-Version: 1.0\n"; 
$mailHeader .= "Content-Type: multipart/alternative;\n"; 
$mailHeader .= ' boundary="'.$bodyBoundary. '"'; 
$mailHeader .= "\n\n\n"; 
//--����ʼ�����ͱ߽� 
$mailHeader .= "--".$bodyBoundary. "\n"; 
$mailHeader .= $textHeader; 
$mailHeader .= "--".$bodyBoundary. "\n"; 
//--���html��ǩ 
$mailHeader .= $htmlHeader; 
$mailHeader .= "\n--".$bodyBoundary. "--"; 
//--�����ʼ� 
return mail($this->mailTo,$this->mailSubject, "",$mailHeader); 
} 
//--�ı���html�Ӹ��� 
else if($this->mailText != "" && $this->mailHTML != "" && $this->mailAttachments != ""){ 
$attachmentBoundary = $this->getRandomBoundary(); 
$mailHeader .= "Content-Type: multipart/mixed;\n"; 
$mailHeader .= ' boundary="'.$attachmentBoundary. '"'. "\n\n"; 
$mailHeader .= "This is a multi-part message in MIME format.\n"; 
$mailHeader .= "--".$attachmentBoundary. "\n"; 
$bodyBoundary = $this->getRandomBoundary(1); 
$textHeader = $this->formatTextHeader(); 
$htmlHeader = $this->formatHTMLHeader(); 
$mailHeader .= "MIME-Version: 1.0\n"; 
$mailHeader .= "Content-Type: multipart/alternative;\n"; 
$mailHeader .= ' boundary="'.$bodyBoundary. '"'; 
$mailHeader .= "\n\n\n"; 
$mailHeader .= "--".$bodyBoundary. "\n"; 
$mailHeader .= $textHeader; 
$mailHeader .= "--".$bodyBoundary. "\n"; 
$mailHeader .= $htmlHeader; 
//$mailHeader .= "\n--".$bodyBoundary. "\n"; 
//--��ȡ����ֵ 
$attachmentArray = explode( ",",$this->mailAttachments); 
//--���ݸ����ĸ�������ѭ�� 
for($i=0;$i<count($attachmentArray);$i++){ 
//--�ָ� $mailHeader .= "\n--".$attachmentBoundary. "\n"; 
//--������Ϣ 
$mailHeader .= "\n--".$bodyBoundary. "\n"; 
$mailHeader .= $this->formatAttachmentHeader($attachmentArray[$i]); 
} 
//$mailHeader .= "--".$attachmentBoundary. ""; 
return mail($this->mailTo,$this->mailSubject, "",$mailHeader); 
} 
return false; 
} 
}//end class 
?> 