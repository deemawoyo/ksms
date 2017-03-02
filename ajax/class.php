<?php
//ajax_class.php
require_once("../configuration.php");
require_once("../php/database.php");
require_once("../php/class.php");
require_once("../php/student.php");

$db->connect();
//enumerate students in the class
if( isset($_GET['class'] ) and isset($_GET['form'] ) and isset($_GET['action'] ) ){ 

$form = $_GET['form'];
$action = $_GET['action'];
$_class = $_GET['class'];
//list all valid class entries for a particular form
if( $action == 'list_students' ){
	
$id = 0;
$student = new Student($id);

$sc = new SchoolClass($student );

$res = $sc->getClassStudents($form , $_class ); 
if( ! $res )return false;

//start printing out class list
$y  = sizeof($res);
print "<option>$y Students</option>\n"; 
for($x = 0 ; $x < $y ; $x++ ){
$student->id = $res[$x];
if( ! $student->populate() )continue; //failed to populate
$fullname = $student->firstname . " " . $student->middlename . " " . $student->lastname;
print "<option value=\"{$student->id}\" > $fullname </option>\n";
}
exit;
}
}

//return valid class list for a particular form
if(isset($_GET['form'] ) and isset($_GET['action'] ) ){ 

$form = $_GET['form'];
$action = $_GET['action'];
//list all valid class entries for a particular form
if( $action == 'list' ){
	
$id =0;
if(isset($_GET['id'] ) ){
$id = $_GET['id'];
}


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

}


?>
