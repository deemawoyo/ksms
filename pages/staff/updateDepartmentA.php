<?php
include "dbconnect.php";

$bID = $_GET["bID"];
$sql_b = mysql_query("select * from branch where branchID='$bID'");
$row_b = mysql_fetch_array($sql_b);
$bName_b = $row_b["branchName"];

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
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="updateDepartment">
  <tr>
    <td>Branch Name </td>
    <td>
		<script language="javascript" type="text/javascript">
		function select_branchName()
			{
				choice = document.updateDepartment.branchName.selectedIndex;

				top.location.href = document.updateDepartment.branchName.options[choice].value;
			}
	</script>
	<select name="branchName" onChange="select_branchName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo"$bName_b"; ?></option>
		<option value="">-</option>
     		<?php
				// Select depsartment
				$sql  = "SELECT * FROM branch WHERE active=1";
				$result = mysql_query($sql);
				while($rows = mysql_fetch_array($result))
				{
					$branchName_a = $rows['branchName'];
					$branchID = $rows['branchID'];
					echo "<option value='updateDepartmentA.php?bID=$branchID'>$branchName_a</option><br>";
				}
			?>
   </select>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Department Name </td>
    <td>
	
	<script language="javascript" type="text/javascript">
		function select_departmentName()
			{
				choice = document.updateDepartment.departmentName.selectedIndex;

				top.location.href = document.updateDepartment.departmentName.options[choice].value;
			}
	</script>
	<select name="departmentName" onChange="select_departmentName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">

		<option value="" selected>-</option>
     		<?php
				// Select depsartment
				$sql_d  = "SELECT * FROM department WHERE branchID='$bID' AND active=1";
				$result_d = mysql_query($sql_d);
				while($rows_d = mysql_fetch_array($result_d))
				{
					$departmentName_a = $rows_d['departmentName'];
					$departmentID_a = $rows_d['departmentID'];
					$branchID_a = $rows_d['branchID'];
					echo "<option value='updateDepartmentB.php?bID=$branchID_a&departmentID=$departmentID_a'>$departmentName_a</option><br>";
				}
			?>
   </select>
	
	
	</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Dpt Name" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" disabled></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#1360D2"><div align="right"> <span class="style3">&raquo;</span><a href="deleteDepartment.php">Delete Department</a></div></td>
    </tr>
  </form>
</table>
