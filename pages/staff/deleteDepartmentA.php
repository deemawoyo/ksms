<link type="text/css" rel="stylesheet" href="search.css">
<?php
include "dbconnect.php";

$bID = $_GET["bID"];
$sql_b = mysql_query("select * from branch where branchID='$bID'");
$row_b = mysql_fetch_array($sql_b);
$bName_b = $row_b["branchName"];

include "topmenu.php";
?>
<style type="text/css">
<!--
.style3 {font-size: 12px; color: #FFFFFF; }
-->
</style>


<br />
<table width="450"  border="0" align="center" cellpadding="2" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; border-bottom:1px solid #CCCCCC; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
  <tr height="30" bgcolor="#CCCCCC">
    <td colspan="3"><strong><u>Delete Department Name</u></strong></td>
  </tr>
  <tr>
    <td width="142">&nbsp;</td>
    <td width="253">&nbsp;</td>
    <td width="33">&nbsp;</td>
  </tr>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="deleteDepartment">
  <tr>
    <td><div align="right">Branch Name</div></td>
    <td>
		<script language="javascript" type="text/javascript">
		function select_branchName()
			{
				choice = document.deleteDepartment.branchName.selectedIndex;

				top.location.href = document.deleteDepartment.branchName.options[choice].value;
			}
	</script>	 <select name="branchName" onChange="select_branchName();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
      <option selected><?php echo"$bName_b"; ?></option>
      <option value="">-</option>
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
    </select> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">
	
	
	
	
	
	
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr height="10">
     <td colspan="5"></td>
  </tr>
                       <tr align="center" valign="middle" bgcolor="#1360D2" height="30"> 
                         <td width="30"><div align="center" class="style7 style2 style3 style4">ID </div></td>
					     <td width="200"><div align="center" class="style2 style3 style4">Branch</div></td>
					     <td width="170"><div align="center" class="style6 style2 style3 style4">Department</div></td>
						 <td width="50"><div align="center" class="style8 style2 style3 style4">Delete</div></td>
  </tr>
	<?php
	
	
		
	/*
		Place code to connect to your DB here.
	*/	// include your code to connect to DB.
				
	$branchID = $_GET["bID"];
	$branchName = $_GET["branchName"];
	$tbl_name="department";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 15;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE branchID=$branchID AND active=1";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "deleteDepartmentA.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE branchID=$branchID AND active=1 ORDER BY branchID desc LIMIT $start, $limit ";
	$result = mysql_query($sql);

		$color="1";
		while($r = mysql_fetch_array($result))
		{
		$departmentID = $r["departmentID"];
		$departmentName = $r["departmentName"];
		
		
						if($color==1)
							 {
								echo "<tr bgcolor=#f1f1f1 onmouseover=\"this.className='hover';\" onmouseout=\"this.className='normal';\">
								  <td height=30 align=center>$departmentID</td>	
								  <td align=center>$branchName</td>	
								  <td align=center>$departmentName</td>
								   <td align=center><a href='deleteDepartmentB.php?dID=$departmentID'><img src='del.png' border='0' alt=''></a></td>
							      </tr>";
								  $color="2";

							}
							else 
							{
								echo "<tr bgcolor=#f1f1f1 onmouseover=\"this.className='hover';\" onmouseout=\"this.className='normal';\">
								  <td height=30 align=center>$departmentID</td>	
								  <td align=center>$branchName</td>	
								  <td align=center>$departmentName</td>
								   <td align=center><a href='deleteDepartmentB.php?dID=$departmentID'><img src='del.png' border='0' alt=''></a></td>
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
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
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
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}
?>
</table>  <center>
<?=$pagination?>
</center>
	
	
	
	
	
	
	</td>
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
