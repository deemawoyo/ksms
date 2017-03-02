<?php
include "dbconnect.php";

$dID = $_GET["dID"];

$sql_update = "UPDATE department SET active=0 WHERE departmentID='$dID'";  	
$result = mysql_query($sql_update);
header ("Location: deleteDepartment.php");
exit();

?>