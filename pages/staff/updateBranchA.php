<?php
include "dbconnect.php";

if(isset($_POST["submit"]))
{

	$branch_b = $_POST["branchID_a"];
	$branchName_b = $_POST["branchName"];
	$branchCode_b = $_POST["branchCode"];
	$branchLocation_b = $_POST["branchLocation"];
	$telephone_b = $_POST["phone"];
	$fax_b = $_POST["fax"];
	$mail_b = $_POST["mail"];
	
	$sql_update = "UPDATE branch SET branchID=$branch_b, branchName='$branchName_b', branchCode='$branchCode_b', branchLocation='$branchLocation_b', Telephone='$telephone_b', fax='$fax_b', email='$mail_b' WHERE branchID='$branch_b'";  	
	$result = mysql_query($sql_update);
	include "updateBranch.php";
	exit();
}


include "topmenu.php";
$bID_a = $_GET["bID"];
$sql_br = mysql_query("select * from branch where branchID='$bID_a'");
$row_br=mysql_fetch_array($sql_br);

$b_Name = $row_br["branchName"];
$b_Code = $row_br["branchCode"];
$b_L = $row_br["branchLocation"];
$b_T = $row_br["Telephone"];
$b_F = $row_br["Fax"];
$b_email = $row_br["email"];

?>
<script language="javascript" type="text/javascript" src="common.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>

<br /> 

<table width="500"  border="0" align="center" cellpadding="2" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <form method="post" name="updateBranch">
  <tr bgcolor="#CCCCCC" height="30">
    <td colspan="3"><strong><u>Update Branch Name</u></strong></td>
  </tr>
  <tr>
    <td>Choose Branch </td>
    <td>
	<script language="javascript" type="text/javascript">
		function select_branchName()
			{
				choice= document.updateBranch.branchName_a.selectedIndex;

				top.location.href= document.updateBranch.branchName_a.options[choice].value;
			}
	</script>
	<select name="branchName_a" onChange="select_branchName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option value="" selected><?php echo "$b_Name"; ?></option>
		<option value="">-</option>
     		<?php
				// Select depsartment
				$sql  = "SELECT * FROM branch WHERE active=1";
				$result = mysql_query($sql);
				while($rows = mysql_fetch_array($result))
				{
					$branchName_a = $rows['branchName'];
					$branchID = $rows['branchID'];
					echo "<option value='updateBranchA.php?bID=$branchID'>$branchName_a</option><br>";
				}
			?>
   </select>
   
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#1360D2">
    <td colspan="3" hei></td>
    </tr>
  <tr>
    <td>Branch Name </td>
    <td><input type="text" name="branchName" value="<?php echo "$b_Name"; ?>" size="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td><input type="hidden" name="branchID_a" value="<?php echo "$bID_a"; ?>"></td>
  </tr>
  <tr>
    <td>Branch Code </td>
    <td><input type="text" name="branchCode" size="10" value="<?php echo "$b_Code"; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Branch Location </td>
    <td><textarea cols="40" rows="4" name="branchLocation"><?php echo "$b_L"; ?></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Telephone </td>
    <td><input type="text" name="phone" size="20" value="<?php echo "$b_T"; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Fax</td>
    <td><input type="text" name="fax" size="20" value="<?php echo "$b_F"; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Email</td>
    <td><input type="text" name="mail" size="12" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$b_email"; ?>"> @vattanacbank.com</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Update Branch Name" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

</form>
</table>  
