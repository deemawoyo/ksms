<?php
include "dbconnect.php";
include "topmenu.php";
if(isset($_POST["submit"]))
{
	$staffID = $_POST["staffID"];
	$branchName_a = $_POST["branchName"];
	$sql_a  = mysql_query("SELECT * FROM branch WHERE branchName='$branchName_a'");
	$rows_a = mysql_fetch_array($sql_a);
	$branchID_a = $rows_a["branchID"];

	$departmentName_b = $_POST["departmentName"];
	$sql_b  = mysql_query("SELECT * FROM department WHERE branchID='$branchID_a' AND departmentName='$departmentName_b'");
	$rows_b = mysql_fetch_array($sql_b);
	$departmentID_b = $rows_b["departmentID"];
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$sex = $_POST["sex"];
	$dob = $_POST["dob"];
	$dobLocation = $_POST["dobLocation"];
	$address = $_POST["address"];
	$position = $_POST["position"];
	$section = $_POST["section"];
	$phone = $_POST["phone"];
	$ext = $_POST["ext"];
	$mail = $_POST["mail"];
	$datejoined = $_POST["joinbank"];
	$picture = $_POST["picture"];
	$jobDes = $_POST["jobDescription"];
	$degree = $_POST["degree"];
	$major = $_POST["major"];
	$staffN = $_POST["staffNumber"];
	
	$sql_update = "UPDATE staffinfo SET branchID=$branchID, departmentID=$departmentID, fName=$fName, lName=$lNames, sex=$sex, dob=$dob, dobLocation=$dobLocation, position=$position, section=$section, address=$address, phone=$phone, email=$email, extension=$extension, picture=$picture, dateJoined='$datejoined' WHERE staffID='$staffID'";  	
	$result = mysql_query($sql_update);
	echo "$result";

}

?>
<script language="javascript" type="text/javascript" src="common.js"></script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	// Notice: The simple theme does not use all options some of them are limited to the advanced theme
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<br />

<?php

$staffID = $_GET["staffID"];
$sql_staff_update = mysql_query("select * from staffinfo where staffID='$staffID'");
$r = mysql_fetch_array($sql_staff_update);

$branchID = $r["branchID"];
$sql2 = mysql_query("select * from branch where branchID='$branchID'");
$r2 = mysql_fetch_array($sql2);
$branchName2 = $r2["branchName"];

$departmentID = $r["departmentID"];
$sql3 = mysql_query("select * from department where departmentID='$departmentID'");
$r3 = mysql_fetch_array($sql3);
$departmentName3 = $r3["departmentName"];

$fName = $r["fName"];
$lName = $r["lName"];
$sex = $r["sex"];
$dob = $r["dob"];
$dobLocation = $r["dobLocation"];
$position = $r["position"];
$section = $r["section"];
$address = $r["address"];
$phone = $r["phone"];
$email = $r["email"];
$extension = $r["extension"];
$picture = $r["picture"];
$datejoined = $r["dateJoined"];
$jobDes = $r["jobdesciption"];
$degree = $r["degree"];
$major = $r["major"];
$staffNumber = $r["staffNumber"];

?>

<table width="820" height="550" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFCC00">
  <tr>
    <td>
      <table width="800" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#EEFCFD" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
  <tr>
    <td colspan="6"><strong><U>UPDATE EMPLOYEE</U></strong></td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="addStaff" enctype="multipart/form-data">
  <tr>
    <td width="90"><input type="hidden" name="staffID" value="<?php echo "$staffID"; ?>"></td>
    <td width="218">&nbsp;</td>
    <td width="96">&nbsp;</td>
    <td width="144">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="164">&nbsp;</td>
  </tr>
  <tr>
    <td>Branch Name </td>
    <td>
	<script>
		function select_branchName()
			{
				choice= document.addStaff.branchName.selectedIndex;
				top.location.href= document.addStaff.branchName.options[choice].value;
			}
	</script>	<select name="branchName" onChange="select_branchName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
      <option selected>
      <?php
				
				echo "$branchName2";
				
				?>
      </option>
      <option value="">-</option>
      <?php
				// Select depsartment
				$sql  = "SELECT * FROM branch";
				$result = mysql_query($sql);
				while($rows = mysql_fetch_array($result))
				{
					$branchName = $rows['branchName'];
					$branchID = $rows['branchID'];
					echo "<option value=updateStaffB.php?bID=$branchID&staffID=$staffID>$branchName</option><br>";
				}
			?>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Dept Name </td>
    <td><select name="departmentName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
			
     		<option selected value="">-</option>
     		<?php
				// Select depsartment
				$bID1 = $_GET["bID"];
				$sql1  = "SELECT * FROM department WHERE branchID='$bID1'";
				$result1 = mysql_query($sql1);
				while($rows1 = mysql_fetch_array($result1))
				{
					$departmentName = $rows1['departmentName'];
					echo "<option>$departmentName</option><br>";
				}
			?>
   </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>First Name </td>
    <td><input type="text" name="fName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$fName"; ?>"></td>
    <td>Last Name </td>
    <td><input type="text" name="lName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$lName"; ?>"></td>
    <td>Sex</td>
    <td><select name="sex" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><option selected><?php echo "$sex"; ?></option><option value="">-</option><option>Male</option><option>Female</option></select></td>
  </tr>
  <tr>
    <td>DOB</td>
    <td colspan="3">
		<script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>
	 	<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol.css">
	 		
		<input type="text" name="dob" id="DPC_date1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$dob"; ?>">
		dd/mm/yyyy 
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DOB Location </td>
    <td colspan="5"><textarea name="dobLocation" cols="75" rows="5" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo "$dobLocation"; ?></textarea></td>
    </tr>
  <tr>
    <td>Current Address </td>
    <td colspan="5"><textarea name="address" cols="75" rows="5" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><?php echo "$address"; ?></textarea></td>
    </tr>
<tr>
    <td>Degree</td>
    <td>
	<select name="degree" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo "$degree"; ?></option>
		<option value="">-</option>
		<option>Diploma</option>
		<option>High School</option>
		<option>Bachelor</option>
		<option>Master</option>
		<option>Phd</option>
		<option>Other</option>
	</select></td>
    <td>Major</td>
    <td colspan="3">
	<select name="major" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo "$major"; ?></option>
		<option value="">-</option>
		<option>Information Technology</option>
		<option>Economic</option>
		<option>Accounting</option>
		<option>Business Administration</option>
		<option>Finance and Banking</option>
		<option>Law</option>
		<option>Architect</option>
		<option>Engineering</option>
		<option>Comunication</option>
		<option>Management</option>
		<option>Audit</option>
		<option>English</option>
		<option>France</option>
		<option>Chines</option>
	</select>	</td>
    </tr>
  <tr>
    <td>Position</td>
    <td>
	<select name="position" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo "$position"; ?></option>
		<option value="">-</option>
		<option>Presedent</option>
		<option>General Manager</option>
		<option>Deputy General Manager</option>
		<option>Director</option>
		<option>Senior Manager</option>
		<option>Branch Manager</option>
		<option>Head of Department</option>
		<option>Senoir A</option>
		<option>Senoir B</option>
		<option>Officer</option>
		<option>Special Grade</option>
		<option>Clerk</option>
		<option>Non Clerk</option>
		<option>Maid</option>
	</select></td>
    <td>Section</td>
    <td colspan="3">
	<select name="section" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo "$section"; ?></option>
		<option value="">-</option>
		<option>IT</option>
		<option>Finance</option>
		<option>Accountant</option>
		<option>Business Development</option>
		<option>Human Resource</option>
		<option>Marketing</option>
		<option>Card Support</option>
		<option>Customer Service</option>
	</select>	</td>
    </tr>
  <tr>
    <td>Hand Phone</td>
    <td><input type="text" name="phone" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);" value="<?php echo "$phone"; ?>"></td>
    <td>Work Ext</td>
    <td><input type="text" size="12" name="ext" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);" value="<?php echo "$extension"; ?>"></td>
    <td>Email</td>
    <td><input type="text" name="mail" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$email"; ?>"></td>
  </tr>
  <tr>
    <td>Staff Picture</td>
    <td><input type="file" name="fleImage" id="fleImage" disabled style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td colspan="2"><span class="style1">* 200kb image size </span></td>
    <td><input type="hidden" name="picture" value="<?php echo "$picture"; ?>"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Date join bank </td>
    <td><script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>	
	<input type="text" name="joinbank" id="DPC_calendar1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$datejoined"; ?>"></td>
    <td>Staff Number </td>
    <td colspan="3"><input type="text" name="staffNumber" id="staffNumber" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$staffNumber"; ?>"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Update Staff Info" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </form>
</table>
</td>
  </tr>
</table>