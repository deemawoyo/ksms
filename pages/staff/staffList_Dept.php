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

<table width="820" border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC; ">
  <tr bgcolor="#CCCCCC" height="30">
    <td>&nbsp; <span class="style1"><U>SEACH BY BRANCH </U></span><br /></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	<?PHP
		$sql_branch = mysql_query("SELECT * FROM branch where active=1");
		while($rows_branch=mysql_fetch_assoc($sql_branch))
		{
			$branch_name = $rows_branch["branchName"];
			$branch_ID = $rows_branch["branchID"];
			
			
			
			echo "<table width='90%' border='0' cellspacing='0' cellpadding='0' align='center'>
  				  <tr>
				  	<td><span class='style1'><U>$branch_name</span></U></td>
				  </tr>
				  <tr>
				    <td>";
					
				$sql_department = mysql_query("SELECT * FROM department WHERE branchID='$branch_ID' AND active=1");
				echo "<table width='600' border='0' cellspacing='0' cellpadding='0' align='center'>";
				echo "<tr><td height='10'>&nbsp;</td><td>&nbsp;</td></tr>";
 		  
				$td="1";
			
				while($rows_department=mysql_fetch_assoc($sql_department))
				{
					$s_departmentName = $rows_department["departmentName"];
					$s_departmentID = $rows_department["departmentID"];
					$s_branchID = $rows_department["branchID"];
					
					$sql_count = mysql_query("SELECT * FROM staffinfo WHERE branchID='$s_branchID' AND departmentID='$s_departmentID'");
					$staff_num = mysql_num_rows($sql_count);
					
					if($td==1)
					{
				 		echo "<tr height='20'>
								<td width='50%' align='left' valign='top'>
								<a href='staffList_Dept.php?bID=$s_branchID&dID=$s_departmentID' class='branch'>$s_departmentName ($staff_num)</a>
			  					</td>";
			 					$td="2";
					}
					elseif($td==2)
					{
						echo "<td align='center' width='50%' valign='top'>
								<a href='staffList_Dept.php?bID=$s_branchID&dID=$s_departmentID' class='branch'>$s_departmentName ($staff_num)</a>
					  			</td></tr>";
			  				$td="1";
					}
				
				
				}		
			echo "</table>";
			echo"&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				  </tr>
					</table> <br />
				  ";
		}
	?>
	
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
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
	$bID1 = $_GET["bID"];
	$dID1 = $_GET["dID"];
	
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE branchID=$bID1 AND departmentID=$dID1";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "staffList_Dept.php?bID=$bID1&dID=$dID1"; 	//your file name  (the name of this file)
	$limit = 9; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE branchID=$bID1 AND departmentID=$dID1 ORDER BY staffID desc LIMIT $start, $limit ";
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
		$branchID = $rows["branchID"];
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
		$datejoin = $rows["datejoined"];
		
		
		if($td==1)
		{
	 	echo "<tr><td align='left' valign='top'>
					<table width='200' border='0' cellspacing='0' cellpadding='0' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;'>
						<tr>
						    <td height='20'></td>
					    </tr>
  						<tr>
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'>$lName</td>
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
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'>$lName</td>
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
						    <td align='center'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='staffDetail.php?staffID=$staffID'><img src='staff_images/$images' width='80' heigh='108' alt='$lName' class='me' border='0'></a></td>
					    </tr>
						<tr>
						    <td align='center'>$lName</td>
					    </tr>
						
					 </table>
			  </td></tr>";
			  $td="1";
		}
	}
	echo "</tr>";
	
/*
===== pagegination =====
*/

	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage&page=$prev\">« Previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« Previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage$page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&page=$next\">Next »</a>";
		else
			$pagination.= "<span class=\"disabled\">Next »</span>";
		$pagination.= "</div>\n";		
	}
/*
======= Finished Step 2 ========
*/

	
	
	echo "</table>";
?>
<br />
	
	<table width='600' border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td align="center"><?=$pagination?></td>
	</tr>
</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table><br />
