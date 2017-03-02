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

require_once("../../configuration.php");
require_once("../../php/database.php");
require_once("../../php/student.php");

require_once("../../php/textbook_library.php");

if( ! isset($_SESSION['student_id'] )  ){
die('No stuednt selected sorry.');	
}

$db->connect();

$st = new Student( $_SESSION['student_id']);

if( ! $st->populate() ){
die('Inavlid student ID passed');	
}

$stbkl = new TextBookManager( $st->id );

//get textbooks owed
$txt = $stbkl->getListAll();




?>
<h3>Textbook Library</h3>


<table class='table_cool' style="padding-top: 15px; color: black;" border="4" cellpadding="15" cellspacing="15"  align="center" bgcolor="#FFFFFF" width="500px">
<tr style=' color: green; font-weight: bold; background-color: white;' >
<td>Title</td>
<td>Book Number</td>
<td>Date Borrowed</td>
<td>Date Returned</td>
<td>Init Condition</td>
<td>Final Condition</td>
</tr>
<tr>
<td>Advanced Level Mathematics, Bostock 2</td>
<td>45</td>
<td>12-12-2016</td>
<td>0101-2015</td>
<td>Good</td>
<td>Good</td>
</tr>

 
</table>
