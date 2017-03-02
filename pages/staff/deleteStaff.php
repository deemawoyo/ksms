<link type="text/css" rel="stylesheet" href="search.css">
<?php
include "dbconnect.php";
include "topmenu.php";


	/*
		Place code to connect to your DB here.
	*/	// include your code to connect to DB.

	$tbl_name="staffinfo";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 15;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	
	
	/* Setup vars for query. */
	$targetpage = "deleteStaff.php"; 	//your file name  (the name of this file)
	$limit = 9999; 								//how many items to show per page
	
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name ORDER BY staffID desc LIMIT $start, $limit ";
	$result = mysql_query($sql);
	 



?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style4 {font-size: 12px}
-->
</style>

<br />
<table width="820" height="550" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFCC00">
<br />
  <tr>
    <td align="center" valign="top">
	
	
	<table width="800" border="0" align="center" cellpadding="0" cellspacing="1">
		<tr height="30"> 
                  <td colspan="6" height="30"><div align="center">
                                    <div align="left" class="style1"><u>DELETE STAFF </u></div>
                                  </div>                                    </td>
  </tr>
  <tr height="10">
     <td colspan="5"></td>
  </tr>
                       <tr align="center" valign="middle" bgcolor="#1360D2" height="30"> 
                         <td width="100"><div align="center" class="style7 style2 style3 style4">Picture</div></td>
					     <td width="200"><div align="center" class="style2 style3 style4">Name</div></td>
				
                         <td width="240"><div align="center" class="style8 style2 style3 style4">Department</div></td>
					     <td width="150"><div align="center" class="style8 style2 style3 style4">Position</div></td>
						 <td width="50"><div align="center" class="style8 style2 style3 style4">Delete</div></td>
  </tr>
	<?php
		$color="1";
		while($r = mysql_fetch_array($result))
		{
		
		
		$staffID = $r['staffID'];
		
		
		
		
		$departmentID = $r["departmentID"];
		$sql_department = mysql_query("select * from department where departmentID='$departmentID'");
		$row_departmentName = mysql_fetch_array($sql_department);
		$departmentName = $row_departmentName["departmentName"];
		
		$picture = $r["picture"];
		$lName = $r["lName"];
		$position = $r["position"];
							 if($color==1)
							 {
								echo "<tr bgcolor=#f1f1f1 onmouseover=\"this.className='hover';\" onmouseout=\"this.className='normal';\">
								  <td height=30 align=center><img src='staff_images/$picture' width='25' alt='$lName' class='me'></td>	
								  <td align=left>&nbsp;{$r['fName']} {$r['lName']}</td>	
								  
								  <td align=center>$departmentName</td>
								  <td align=center>$position</td>
								   <td align=center><a href='deleteStaffA.php?id=$staffID'><img src='del.png' border='0' alt=''></a></td>
							      </tr>";
								  $color="2";

							}
							else 
							{
								echo "<tr bgcolor=#feffee onmouseover=\"this.className='hover';\" onmouseout=\"this.className='normal';\">
								  <td height=30 align=center><img src='staff_images/$picture' width='25' alt='$lName' class='me'></td>	
								  <td align=left>&nbsp;{$r['fName']} {$r['lName']}</td>	
								  <td align=center>$branchName</td>
								  <td align=center>$departmentName</td>
								  <td align=center>$position</td>
								   <td align=center><a href='deleteStaffA.php?id=$staffID'><img src='del.png' border='0' alt=''></a></td>
							      </tr>";
								  $color="1";
							}
	
		}
	?>
<tr height="15"> 
     <td colspan="6">
	</td>
</tr>

</table>  <center>

</center>	</td>
  </tr>

<br />
</table>
