<?php
include "dbconnect.php";

$bID = $_GET["bID"];

$sql_update = "UPDATE branch SET active=0 WHERE branchID='$bID'";  	
$result = mysql_query($sql_update);
header ("Location: deleteBranch.php");

?>