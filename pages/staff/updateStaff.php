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
	$total_pages = mysql_affected_rows();
	
	/* Setup vars for query. */
	$targetpage = "updateStaff.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = 99999; //all in one page
	if($page) 
		$start = 0; 			//first item to display on this page
	else
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
                                    <div align="left" class="style1"><u>UPDATE STAFF </u></div>
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
						 <td width="50"><div align="center" class="style8 style2 style3 style4">Update</div></td>
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
								  <td height=30 align=center><a href='updateStaffA.php?id=$staffID'><img src='staff_images/$picture' width='25' alt='$lName' class='me' border='0'></a></td>	
								  <td align=left>&nbsp;{$r['fName']} {$r['lName']}</td>	
								  
								  <td align=center>$departmentName</td>
								  <td align=center>$position</td>
								   <td align=center><a href='updateStaffA.php?id=$staffID'><img src='update.png' border='0' alt=''></a></td>
							      </tr>";
								  $color="2";

							}
							else 
							{
								echo "<tr bgcolor=#feffee onmouseover=\"this.className='hover';\" onmouseout=\"this.className='normal';\">
								  <td height=30 align=center><a href='updateStaffA.php?id=$staffID'><img src='staff_images/$picture' width='25' alt='$lName' class='me' border='0'></a></td>	
								  <td align=left>&nbsp;{$r['fName']} {$r['lName']}</td>	
								  <td align=center>$branchName</td>
								  <td align=center>$departmentName</td>
								  <td align=center>$position</td>
								   <td align=center><a href='updateStaffA.php?id=$staffID'><img src='update.png' border='0' alt=''></a></td>
							      </tr>";
								  $color="1";
							}
	
		}
	?>
<tr height="15"> 
     <td colspan="6">
	</td>
</tr>


<?php	
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
			$pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
		else
			$pagination.= "<span class=\"disabled\">� previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
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
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
		else
			$pagination.= "<span class=\"disabled\">next �</span>";
		$pagination.= "</div>\n";		
	}
?>
</table>  <center>
<?=$pagination?>
</center>	</td>
  </tr>

<br />
</table>
