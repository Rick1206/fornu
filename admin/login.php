<?php
//user login backend
define('IN_SK',true);
require(dirname(__FILE__) . '/includes/init.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $system_name;?></title>
<link rel="stylesheet" href="style/main.css" />
<style>
#user_login{
	position:relative;
	width:800px;
	margin:0px auto;
	padding:0px;
}
</style>
<!--<script src="../js/j132m.js" language="javascript"></script>-->
<script language="javascript" src="../js/jquery-1.5.1.min.js"></script>
<script>
 function check_login()
 {
 	f = document;
	
	if(f.getElementById('user').value == '')
	{
		alert('用户名不能为空');
		f.getElementById('user').focus();
		return false;
	}
	else if(f.getElementById('psw').value == '')
	{
		alert('密码不能为空');
		f.getElementById('psw').focus();
		return false;
	}
	else
	{
		return true;
	}
 
 }
</script>
</head>

<body>
<table width="100%" height="406" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="82">&nbsp;</td>
  </tr>
  <tr>
    <td height="144">
    <form id="form1" name="form1" method="post" action="login.php">
      <div id="user_login">
      <table width="40%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="70" colspan="3" valign="top"><!--<img src="images/logo.png" />--></td>
        </tr>
        <tr>
          <td width="30" height="30" align="right" bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="bottom" bgcolor="#FFFFFF" class="m_title">用户名<span id="user_a"></span></td>
          <td width="30" valign="bottom" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="40" align="right" bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">
          <input name="user" type="text" id="user" size="36" />
		  <script> document.getElementById('user').focus();</script>
          </td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="bottom" bgcolor="#FFFFFF" class="m_title">密 码</td>
          <td valign="bottom" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="40" align="right" bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><input name="psw" type="password" id="psw" size="36" /></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="65" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF">
            <input type="image" src="images/login_os.jpg" value="login" onclick="return check_login();" /></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
      </div>
      </form>
	   <?php
    	//get user psw to select admin
		$user = isset($_POST['user']) ? $_POST['user'] : '';
		$psw = isset($_POST['psw']) ? $_POST['psw'] : '';
		
		if(!empty($user) & !empty($psw)){
			$psw =  md5($psw);
			//echo $psw;
			$back_data	= login_backend($user,$psw);
			if( empty($back_data))
			{
		?>
		<script>
		$(document).ready(function(){
				$('#user_login').animate({left:60},100)
								.animate({left:-60},100)
								.animate({left:60},70)
								.animate({left:-60},70)
								.animate({left:0},60);
		})
		</script>
		<?php
			}
			else
			{	
				$_SESSION['admin_name'] = $user;
				$_SESSION['admin_id'] = $back_data;
				header('Location: index.php');
				exit;
			}
		}
		?>
    </td>
  </tr>
</table>
</body>
</html>
