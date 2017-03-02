<?php
include "dbconnect.php";

?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
-->
</style>
<link type="text/css" rel="stylesheet" href="search.css">
<?php
include "topmenu.php";
?>
<style type="text/css">
<!--
.style2 {font-size: 12}
.style4 {font-size: 14px}
-->
</style>

<br />
<table width="820" border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <tr bgcolor="#CCCCCC" height="30">
    <td>&nbsp; <span class="style1"><U>STAFF DETAIL</U></span><br /></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	
</td>
  </tr>
  <tr>
    <td>
	<br />
	<?php
	
	$staffID = $_GET["staffID"];
	$sql8 = mysql_query("select * from staffinfo where staffID=$staffID");
	$r8 = mysql_fetch_array($sql8);
	
	$fName = $r8["fName"];
	$lName = $r8["lName"];
	
	
	$dID = $r8["departmentID"];
	$sql10 = mysql_query("select * from department where departmentID=$dID");
	$r10 = mysql_fetch_array($sql10);
	$department = $r10["departmentName"];
	
	$dob = $r8["dob"];
	$dobLocation = $r8["dobLocation"];
	$position = $r8["position"];
	$section = $r8["section"];
	$address = $r8["address"];
	$phone = $r8["phone"];
	$email = $r8["email"];
	$ext = $r8["extension"];
	$images = $r8["picture"];
	$datejoined = $r8["dateJoined"];
	$degree = $r8["degree"];
	$major = $r8["major"];
	$staffNumber = $r8["staffNumber"];
	
	?>
	<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td width="20%" rowspan="9" align="center" valign="top"><?php echo "<img src='staff_images/$images' width='80' heigh='108' alt='$lName' class='me' border='0'>"; ?><br />ID: <?php echo "$staffNumber"; ?></td>
        <td width="2%">&nbsp;</td>
        <td width="15%" height="25"><strong>Name</strong></td>
        <td colspan="3"><?php echo "$fName $lName"; ?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
       
        <td width="15%"><strong>Department</strong></td>
        <td><?php echo "$department"; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Date of Birth </strong></td>
        <td colspan="3"><?php echo "$dob"; ?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Place of Birth </strong></td>
        <td colspan="3"><?php echo "$dobLocation"; ?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Position</strong></td>
        <td><?php echo "$position"; ?></td>
        <td><strong>Section</strong></td>
        <td><?php echo "$section"; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Address</strong></td>
        <td colspan="3"><?php echo "$address"; ?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Email</strong></td>
        <td><?php echo "$email"; ?></td>
        <td colspan="2"><strong>Phone :</strong> <?php echo "<font color='#FF0000'>$phone</font>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Extension :</strong> <?php echo "<font color='#FF0000'>$ext</font>"; ?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><strong>Degree</strong></td>
        <td><?php echo "$degree"; ?></td>
        <td><strong>Major</strong></td>
        <td><?php echo "$major"; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><div align="left" class="style2">
          <div align="center"><a href="javascript:history.back(1);"><img src="restore_f2.png" width="32" height="32" border="0"></a></div>
        </div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table><br />
