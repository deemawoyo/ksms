<?php
//ajax_backup.php
require_once("../../configuration.php");
require_once("../../php/database.php");

if(isset($_GET['backup'] ) ){
if( ! $db->connect() ){
die("<h1>FAILED TO CONNECT TO DATABASE !!! </h1>");
}
$text = $db->backup();
sleep(5);//

print "

	        <h3>Database Backup</h3>
<center>
	<img src=\"images/success128.png\" title=\"BackUp Database\"/>

	<h3 style=\"color: green;\"> Backup successful !</h3> 
	<button onclick='window.location=\"$text\";' >Download File</button>
	
<br />	
	
</center>	
	"; 
}
	
?>
