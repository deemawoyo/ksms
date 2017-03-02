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
<br />

<br />
<table width="820" border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <tr bgcolor="#CCCCCC" height="30">
    <td>&nbsp; <span class="style1"><U>STAFF LIST</U></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Please click on image to view detail<br /></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	
	<?php
/*
	Pagenation
*/
	$tbl_name="staffinfo";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 8;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	
	
	/* Setup vars for query. */
	$targetpage = "staffList.php"; 	//your file name  (the name of this file)
	$limit = 9999; 								//how many items to show per page
	
	
		$start = 0; 			//first item to display on this page
									//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name ORDER BY staffID desc LIMIT $start, $limit ";
	$result = mysql_query($sql);

/*
======= Finished Step 1 ========
*/
	echo "<table width='600' border='0' cellspacing='0' cellpadding='0'>";
	echo "<tr><td height='10'>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
 		  
	$td="1";
	while($rows=mysql_fetch_assoc($result))
	{
		
		$staffID = $rows['staffID'];
		
		$departmentID = $rows["departmentID"];
		$fName = $rows["fName"];
		$lName = $rows["lName"];
		$sex = $rows["sex"];
		$dob = $rows["dob"];
		$dobLocation = $rows["dobLocation"];
		$position = $rows["position"];
		$section = $rows["section"];
		$address = $rows["address"];
		$phone = $rows["phone"];
		$email = $rows["email"];
		$extension = $rows["extension"];
		$images = $rows["picture"];
		$datejoin = $rows["dateJoined"];
		
		
		if($td==1)
		{
	 	echo "<tr><td align='left' valign='top'>
					<table width='200' border='0' cellspacing='0' cellpadding='0' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;'>
						<tr>
						    <td height='20'></td>
					    </tr>
  						<tr>
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$fName $lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'> $fName $lName</td>
					    </tr>
						
					 </table>
			  </td>";
			 $td="2";
		}
		elseif($td==2)
		{
			echo "<td align='center' valign='top'>
					<table width='200' border='0' cellspacing='0' cellpadding='0' class='bg_pro' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;'>
						<tr>
						    <td height='20'></td>
					    </tr>
  						<tr>
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$fName $lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'>$fName  $lName</td>
					    </tr>
						
						
					 </table>
			  </td>";
			  $td="3";
		}
		elseif($td==3)
		{
			echo "<td align='right' valign='top'>
					<table width='200' border='0' cellspacing='0' cellpadding='0' class='bg_pro' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;'>
						<tr>
						    <td height='20'></td>
					    </tr>
  						<tr>
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$fName $lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'>$fName $lName</td>
					    </tr>
						
					 </table>
			  </td></tr>";
			  $td="1";
		}
	}
	echo "</tr>";

	
	echo "</table>";
?>
<br />
	
	<table width='600' border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td align="center"></td>
	</tr>
</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table><br />
