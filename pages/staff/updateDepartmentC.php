<?php
	include "dbconnect.php";
	$bID = $_POST["branchName"];
	$sql = mysql_query("select * from branch where branchName='$bID'");
	$row = mysql_fetch_array($sql);
	$branchID = $row["branchID"];
	
	
	
	
	$dID = $_POST["departmentName"];
	$sql1 = mysql_query("select * from department where departmentName='$dID'");
	$row1 = mysql_fetch_array($sql1);
	$departmentID = $row1["departmentID"];
	
	$u_dName = $_POST["u_Dept"];
	
	$sql_update = "UPDATE department SET departmentID=$departmentID, branchID=$branchID, departmentName='$u_dName', active=1 WHERE departmentID=$departmentID";  	
	$result = mysql_query($sql_update);
	include "updateDepartment.php";
	exit();
?>