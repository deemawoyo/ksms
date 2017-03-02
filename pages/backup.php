<?php
/**
 * Copyright 2016
 *
 * @author Delight Mawoyo
 *
 * @info
 * 
 *
 * @important 
 *
 * @license
 * 
*/

?>
<div id='backup_start' >
	        <h1 style='color:red;'>Database Backup</h1>
                
	<img src="images/backup.bmp" title="BackUp Database"/>
	

	
	<center>
Backup the entire school database to your local computer.
	<button  id="buttonBackup" onclick=" $('#backup_start').load('pages/backup/start.php');  $('#backup_start').load('pages/backup/backup.php?backup=true&urgent=true&auto=true');" > Start </button>
	</center>


</div>



