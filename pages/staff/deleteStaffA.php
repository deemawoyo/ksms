<?php

include "dbconnect.php";

$staffID = $_GET["id"];
$sql = mysql_query("DELETE FROM staffinfo WHERE staffID=$staffID");
echo "$sql";
include "deleteStaff.php";

?>