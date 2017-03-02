<?php
include "dbconnect.php";
include "topmenu.php";
if(isset($_POST["submit"]))
{
	
	$departmentName_b = $_POST["departmentName"];
	$sql_b  = mysql_query("SELECT * FROM department WHERE departmentName='$departmentName_b'");
	$rows_b = mysql_fetch_array($sql_b);
	$departmentID_b = $rows_b["departmentID"];
	
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$sex = $_POST["sex"];
	$dob = $_POST["dob"];
	$dobLocation = nl2br($_POST["dobLocation"]);
	$address = nl2br($_POST["address"]);
	$position = $_POST["position"];
	$section = $_POST["section"];
	$phone = $_POST["phone"];
	$ext = $_POST["ext"];
	$mail = $_POST["mail"];
	$datejoin = $_POST["joinbank"];
	
	$degree = $_POST["degree"];
	$major = $_POST["major"];
	$staffNumber = $_POST["staffNumber"];
	
	$images = uploadStaffImages('fleImage', SRV_ROOT . 'staff_images/');
	$mainImage = $images['image'];
	
	$sql_insert = "INSERT INTO staffinfo( departmentID, fName, lName, sex, dob, dobLocation, position, section, address, phone, email, extension, picture, datejoined,  degree, major, staffNumber) VALUES ( $departmentID_b, '$fName', '$lName', '$sex', '$dob', '$dobLocation', '$position', '$section', '$address', '$phone', '$mail', $ext, '$mainImage', '$datejoin',  '$degree', '$major', '$staffNumber')";
	
	$result = mysql_query($sql_insert);
	
}

function uploadStaffImages($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') 
	{
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		 //maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) 
		{
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $result;
		} 
		else 
		{
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
	}
	return array('image' => $imagePath);
}

function createThumbnail($srcFile, $destFile, $width, $quality = 400)
{
	$thumbnail = '';
	
	if (file_exists($srcFile)  && isset($destFile))
	{
		$size        = getimagesize($srcFile);
		$w           = number_format($width, 0, ',', '');
		$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
		
		$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
	}
	
	// return the thumbnail file name on sucess or blank on fail
	return basename($thumbnail);
}
function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
    {
       $destFile  = substr_replace($destFile, 'jpg', -3);
       $dest      = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } else {
      return false;
    }

    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;

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
<table width="820" height="550" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFCC00">
  <tr>
    <td>
      <table width="800" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#EEFCFD" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
  <tr>
    <td colspan="6"><strong><U>ADD EMPLOYEE</U></strong></td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="addStaff" enctype="multipart/form-data">
  <tr>
    <td width="110">&nbsp;</td>
    <td width="218">&nbsp;</td>
    <td width="96">&nbsp;</td>
    <td width="144">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="144">&nbsp;</td>
  </tr>
  
  <tr>
    <td>Dept Name </td>
    <td><select name="departmentName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
     		<?php
				// Select depsartment
				$bID1 = $_GET["bID"];
				$sql1  = "SELECT * FROM department ";
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
    <td><input type="text" name="fName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>Last Name </td>
    <td><input type="text" name="lName" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>Sex</td>
    <td><select name="sex" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><option>Male</option><option>Female</option></select></td>
  </tr>
  <tr>
    <td>DOB</td>
    <td colspan="3">
		<script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>
	 	<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol.css">
	 		
		<input type="text" name="dob" id="DPC_date1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		dd/mm/yyyy 
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DOB Location </td>
    <td colspan="5"><textarea name="dobLocation" cols="85" rows="4" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></textarea></td>
    </tr>
  <tr>
    <td>Current Address </td>
    <td colspan="5"><textarea name="address" cols="85" rows="4" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></textarea></td>
    </tr>
 <tr>
    <td>Qualification</td>
    <td>
	<select name="degree" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected value="">-</option>
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
		<option selected value="">-</option>
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
		<option selected value="">-</option>
		
		
		<option>Teacher</option>
		<option>Head Of Department</option>
		<option>Temporary Teacher</option>
		<option>Secretary</option>
		<option>Clerk</option>
		<option>Janitor</option>
		<option>Garden boy</option>
		<option>Hostel Staff</option>
		<option>Driver</option>
		<option>Other</option>
		<option>Deputy Headmaster</option>
		<option>Senior Teacher</option>
		<option>Headmaster/mistress</option>
	</select></td>
    <td>Section</td>
    <td colspan="3">
	<select name="section" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
		<option selected value="">-</option>
		<option>Admin Office</option>
		<option>Teacher</option>
		<option>Staff</option>
		<option>Hostel Staff</option>
		<option>Other</option>
		
	</select>	</td>
    </tr>
  <tr>
    <td>Hand Phone</td>
    <td><input type="text" name="phone" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>Work Ext</td>
    <td><input type="text" size="12" name="ext" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" onKeyUp="checkNumber(this);"></td>
    <td>Email</td>
    <td><input type="text" name="mail" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
  </tr>
  <tr>
    <td>Staff Picture</td>
    <td><input type="file" name="fleImage" id="fleImage" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td colspan="2"><span class="style1">* 200kb image size</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Date join bank </td>
    <td><script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>	<input type="text" name="joinbank" id="DPC_calendar1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>Staff Number </td>
    <td><input type="text" name="staffNumber"></td>
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
    <td><input type="submit" name="submit" value="Add Staff Info" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </form>
</table>
</td>
  </tr>
</table>
