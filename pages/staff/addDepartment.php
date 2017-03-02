<?php
include "dbconnect.php";

if(isset($_POST["submit"]))
{
	
	
	$deptName = $_POST["deptName"];
	$sql1 = mysql_query("SELECT departmentName FROM department WHERE departmentName='$deptName'");
	$departmentName_check = mysql_num_rows($sql1);
	if($departmentName_check !=0)
	{
		die('Your department is already register. ');
	}
	
	$sql = mysql_query("INSERT INTO department( departmentName, active) VALUES ( '$deptName', 1)");
	if($sql)
	{	
		echo "<center>Department $deptName for branch $branchName Successfully Added</center>";
	}
}
include "topmenu.php";
?>
<style type="text/css">
<!--
.style3 {font-size: 12px; color: #FFFFFF; }
-->
</style>


<br />
<table width="400"  border="0" align="center" cellpadding="2" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <tr height="30" bgcolor="#CCCCCC">
    <td colspan="3"><strong><u>Add Department Name</u></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <tr>
    <td>Department Name </td>
    <td><input type="text" name="deptName" size="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Dpt Name" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#1360D2"><div align="right"><span class="style3">&raquo;</span><a href="updateDepartment.php">Update Department</a>&nbsp;&nbsp; <span class="style3">&raquo;</span><a href="deleteDepartment.php">Delete Department</a></div></td>
    </tr>
  </form>
</table>
