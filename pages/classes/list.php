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
require_once("../../php/class.php");
require_once("../../php/student.php");

$db->connect();

	
$id = 0;

//return valid class list for a particular form
if(isset($_GET['form'] )  ){ 

$form = $_GET['form'];
//list all valid class entries for a particular form
	
$id =0;

$student = new Student($id);

$sc = new SchoolClass($student );

$res = $sc->getClassList($form);
if( ! $res ){
die("Invalid form number entered or no classes for this form yet");
}
print "<option>Select </option>";
for( $x = 0; $x < sizeof($res) ; $x++ ){
print "<option>{$res[$x]}</option>\n";

}
exit;



}
?>
