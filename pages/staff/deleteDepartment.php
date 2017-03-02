<?php
include "dbconnect.php";
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
    <td colspan="3"><strong><u>Delete Department Name</u></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="deleteDepartment">
  <tr>
    <td>Branch Name</td>
    <td>
	<script language="javascript" type="text/javascript">
		function select_branchName()
			{
				choice = document.deleteDepartment.branchName_a.selectedIndex;

				top.location.href = document.deleteDepartment.branchName_a.options[choice].value;
			}
	</script>
	<select name="branchName_a" onChange="select_branchName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option value="" selected>-</option>
     		<?php
				// Select depsartment
				$sql  = "SELECT * FROM branch WHERE active=1";
				$result = mysql_query($sql);
				while($rows = mysql_fetch_array($result))
				{
					$branchName_a = $rows['branchName'];
					$branchID = $rows['branchID'];
					echo "<option value='deleteDepartmentA.php?bID=$branchID&branchName=$branchName_a'>$branchName_a</option><br>";
				}
			?>
   </select>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#1360D2"><div align="right"> <span class="style3">&raquo;</span><a href="updateDepartment.php">Update Department</a>&nbsp;&nbsp;<span class="style3">&raquo;</span><a href="addDepartment.php">Add Department</a></div></td>
    </tr>
  </form>
</table>
