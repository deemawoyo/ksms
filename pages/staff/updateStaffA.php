<?php
include "dbconnect.php";

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
	
	$sql_update = "UPDATE staffinfo SET staffID=$staffID, branchID=$branchID_a, departmentID=$departmentID_b, fName='$fName', lName='$lName', sex='$sex', dob='$dob', dobLocation='$dobLocation', position='$position', section='$section', address='$address', phone='$phone', email='$mail', extension=$ext, picture='$picture', dateJoined='$datejoined', jobdescription='$jobDes', degree='$degree', major='$major', stuffNumber='$staffN' WHERE staffID='$staffID'";  	
	$result_update = mysql_query($sql_update);
	echo "<script>alert('You have successful update');</script>";
	include "updateStaff.php";
	exit();

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
<?php include "topmenu.php"; ?>
<br />

<?php

$staffID = $_GET["id"];
$sql_staff_update = mysql_query("select * from staffinfo where staffID='$staffID'");
$r = mysql_fetch_array($sql_staff_update);


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
 
    <td>Dept Name </td>
    <td><select name="departmentName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
			<option selected><?php echo "$departmentName3"; ?></option>
     		<option value="">-</option>
     		<?php
				// Select depsartment
				$bID1 = $_GET["bID"];
				$sql1  = "SELECT * FROM department WHERE branchID='$branchID'";
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
	<tr>
    <td>Qualification</td>
    <td>
	<select name="degree" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected><?php echo "$degree"; ?></option>
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
 
    <td>Section</td>
    <td colspan="3">
	<select name="section" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected ><?php echo $section; ?></option>
		<option>Admin Office</option>
		<option>Teacher</option>
		<option>Staff</option>
		<option>Hostel Staff</option>
		<option>Other</option>
		
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
    <td><input type="text" name="staffNumber" id="DPC_calendar1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" value="<?php echo "$staffNumber"; ?>"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
