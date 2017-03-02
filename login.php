<?php
require_once("configuration.php");

//log all login activity
require_once("php/accesslog.php");
$al = new AccessLog();


if(  $sess->isLoggedIn() ){
header("Location: index.php");
}

if( isset($_POST['id'] ) and isset($_POST['password'] ) ){
//connect to db
$db->connect();

//check if valid 
$users = new Users();

//get user fullname
$u_name = $users->get( $_POST['id']  , "fullname" );

if( ! $u_name ){
$_SESSION['err_msg'] = "Invalid username or password entered.Please try again";
$_SESSION['tmp_user'] = $_POST['id'];//user;
$_SESSION['tmp_password'] = $_POST['password'];
$al->log($user , "Attempted to login with non-existant user {$_POST['id']}");
header("Location: login.php?not_correct");
exit;
}
//get user title 
$u_title = $users->get($_POST['id'] , "title" );
if( ! $u_title ){
$_SESSION['err_msg'] = "Invalid username or password entered.Please try again";
$_SESSION['tmp_user'] = $_POST['id'];//user;
$_SESSION['tmp_password'] = $_POST['password'];
$al->log($user , "Database query failed during login ");
header("Location: login.php?not_correct");
exit;
}

$u_name = $u_title . " " . $u_name;

//get user password
$u_password = $users->get( $_POST['id'] , 'password');
if(! $u_password ){
$_SESSION['err_msg'] = "Invalid username or password entered.Please try again";
$_SESSION['tmp_user'] = $_POST['id'];//user;
$_SESSION['tmp_password'] = $_POST['password'];
$al->log($user , "Database query failed during login. {$_POST['id']}");
header("Location: login.php?not_correct");

exit;
}

//check if user password is the same as listed password
if(  md5($_POST['password']) != $u_password ){
$_SESSION['err_msg'] = "Invalid username or password entered.Please try again";
$_SESSION['tmp_user'] = $_POST['id'];//user;
$_SESSION['tmp_password'] = $_POST['password'];
$al->log($user , "Incorrect password. Login failed");
header("Location: login.php?not_correct");
exit;
}

//otherwise user is logged in

$sess->authInfo(  $_POST['id'], md5($_POST['password']) , $u_name );
$al->log( $sess->user ,  "{$_POST['id']} successfully logged in");
$_SESSION['show_login'] = true;
header('Location: index.php');

}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="icon" href="favicon.png" type="image/x-icon" />
<title>Login to King's School Management System</title>
   <SCRIPT TYPE="text/javascript">
//Disable right click script
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</SCRIPT>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles/login.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.js"></script>
<script>

function setForm($type){
$("#menu").fadeOut(500);
$("#f_l").fadeIn(500);

}



</script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body   >
<center><h1 id='tit2' hidden=true><?php echo $config->school_name; ?></h1></center>
 
<div id="header-wrapper" >
	<div id="logo">
			<h1><a href="#"><?php echo $config->school_name; ?><br />Portal</a></h1>
			
		</div>	
		<div id="menu">
			<ul><!--
				<li ><a href="#" onclick="setForm(1)" accesskey="1" title="Go to school website">School Website</a></li>
				<li><a href="#" onclick="setForm(2)" accesskey="2" title="Students portal. Login here">Students</a></li>
				<li><a href="#" onclick="setForm(3)" accesskey="3" title="Teachers Portal. Login Here">Teachers</a></li>-->
		
			</ul>
		
		</div>
		<center>
<?php 
if(isset($_GET['not_correct'] ) ){
echo "<script></script><h2 style='color: red;'>Invalid username or password entered</h2>"; 
//unset($_SESSION['err_msg'] );
}
?>
<form  id='f_l' action='#' method=post />
<strong id='l_i'>Login</strong>
<table>
<tr><td id='l_id'>
<b >User I.D</b></td>
<td><input id='id' name='id' value="<?php if(isset($_SESSION['tmp_user'] ) )echo $_SESSION['tmp_user']; ?>"  /></td>
</tr>
<tr>
<td><b id='l_p'>Password:</b></td>
<td><input type=password id='password' name='password' /></td>
</tr>

</table><button id='l_butt' >LOGIN </button>
</form>

</center>
	<center>
	<b style='color: red;' > WARNING: </b>This is  private system only authorised and authenticated personell are allowed to use this system.
	
<div style='margin: 20px;' >		<p  style='font-weight: bolder;' rel="nofollow">King's School Management System <?php echo $config->version; ?><br /> (c) 2016 All rights reserved </p></div></center><br /><center>
	</div>
</div>

</body>
</html>
