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

?>
<script type="text/javascript" >
function updatePassword(){
	
$old = $("#old_pass").val();
$new = $("#new_pass").val();	
$con = $("#confirm_pass").val();

$url = "pages/settings/save.password.php?old_pass=" + $old + "&new_pass=" + $new + "&confirm_pass=" + $con;
$("#password_change_status").load($url);
 $("#old_pass").val('');
 $("#new_pass").val('');	
 $("#confirm_pass").val('');	
}

</script>

<center>
	<h3>Change Password</h3>
	<h2 id='password_change_status' ></h2>
	<table  >
		<tr><td><h3>Old Password</h3></td><td><input style='height: 25px; font-weight: bold;' type=password name='old_pass' id='old_pass' value="" /></td></tr>
	<tr><td><h3>New Password</h3></td><td><input style='height: 25px; font-weight: bold;' type=password name='new_pass' id='new_pass' value=""  /></td></tr>
	<tr><td><h3>Confirm Password</h3></td><td><input style='height: 25px; font-weight: bold;' type=password name='confirm_pass' id='confirm_pass' value="" /></td></tr>
	</table>
	<button  onclick="updatePassword()" >Update</button>
	
</center>