<?php
include "dbconnect.php";

if(isset($_POST["submit"]))
{
	$branchName = $_POST["branchName"];
	
	$sql1 = mysql_query("SELECT branchName FROM branch WHERE branchName='$branchName'");
	$branchName_check = mysql_num_rows($sql1);
	if($branchName_check !=0)
	{
		die('Your branch is already register. ');
	}
	
	$branchCode = $_POST["branchCode"];
	$branchLocation = $_POST["branchLocation"];
	$phone = $_POST["phone"];
	$fax = $_POST["fax"];
	$mail = $_POST["mail"];
	
	$sql = mysql_query("INSERT INTO branch(branchName, branchCode, branchLocation, Telephone, Fax, email, active) VALUES ('$branchName', '$branchCode', '$branchLocation', '$phone', '$fax', '$mail', 1 )");
	if($sql)
	{	
		echo "<center>Department $deptName for branch $branchName Successfull Added</center>";
	}
}
include "topmenu.php";
?>
<script language="javascript" type="text/javascript" src="common.js"></script>
<style type="text/css">
<!--
.style3 {font-size: 12px; color: #FFFFFF; }
-->
</style>

<br />
<table width="500"  border="0" align="center" cellpadding="2" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <tr bgcolor="#CCCCCC" height="30">
    <td colspan="3"><strong><u>Add Branch Name</u></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <tr>
    <td>Branch Name </td>
    <td><input type="text" name="branchName" size="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Branch Code </td>
    <td><input type="text" name="branchCode" size="10" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Branch Location </td>
    <td><textarea cols="40" rows="4" name="branchLocation"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Telephone </td>
    <td><input type="text" name="phone" size="20" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Fax</td>
    <td><input type="text" name="fax" size="20" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Email</td>
    <td><input type="text" name="mail" size="12" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"> @vattanacbank.com</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Branch Name" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td colspan="3" bgcolor="#1360D2"><div align="right"><span class="style3">&raquo;</span> <a href="updateBranch.php">Update Branch</a>&nbsp;&nbsp; <span class="style3">&raquo;</span> <a href="deleteBranch.php">Delete Branch</a></div></td>
    </tr>
  </form>
</table>
