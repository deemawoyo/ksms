<?php
/**
 * Copyright 2016
 *
 * @author Delight Mawoyo
 *
 * @info
 * 
 *
 * @important 
 *
 * @license
 * 
*/
//require_once("../configuration.php");


?>
<br />
<script type="text/javascript" >

function changePassword(){
Messi.load('pages/settings/change.password.php' ,{  title: 'Change Password' , modal: true }  );	
	
}

</script>
<center><h1>Settings</h1>
<p id="descr" style="color: red; " >

</p>
<!--Add a search feature -->
	
<div class="submenu" " >

<a onclick=" Messi.load('pages/settings/account.php' ,{  title: 'Account Info' , modal: true }  ); "  id="account" title="View account info "><img src="images/staff.jpg"  /><br /><b><h2>My Account</h2></b></a> 


<a  title="Logout of the KSMS Platform" onclick="bypass = true; Messi.alert('You are beign logged out.' , {modal: true , title : 'Logging out...'}); window.location = 'logout.php';"><img src="images/users.jpg"   /><br /><b><h2>LOGOUT</h2></b></a> 

<a onclick=" Messi.load('pages/settings/css.php' ,{  title: 'Colour Theme' , modal: true }  ); "  id="backup" title="Backup your database "><img src="images/appearence.png"  /><br /><b><h2>Appearence</h2></b></a> 
<br />


<a onclick=" Messi.load('pages/backup.php' ,{  title: 'Backup' , modal: true }  ); "  id="backup" title="Backup your database "><img src="images/backup.jpg"  /><br /><b><h2>Backup</h2></b></a> 

<a  title="Switch to admin panel" onclick="bypass = true; window.location = 'admin/index.php';"><img src="images/admin.png"   /><br /><b><h2>Admin Panel</h2></b></a> 


<a  onclick="changePassword();" id="student" title="Change your password"><img src="images/access.jpg"  /><br /><b><h2>Password</h2></b></a>    



<a  title="Open the Help document" onclick="Messi.alert('To be implemented' , {modal: true , title : 'Help'});"><img src="images/help.png"   /><br /><b><h2>Help</h2></b></a> 



<br />

</div>

</center>
