<?php
require_once("../configuration.php");
require_once("../php/database.php");
require_once("../php/student.php");
require_once("../php/class.php");
require_once("../php/payment.php");
require_once("../php/auditor.php");
require_once("../php/configreader.php");


$ss = new Session();
if( ! $ss->isLoggedIn() ){
header("Location: login.php");
}

$action = isset( $_GET['action'] ) ? $_GET['action'] : 'none';
$id = isset( $_GET['id']) ? $_GET['id'] : '';

//connect to database
$db->connect();

//update student password
if( $action == 'password' ){
if( isset($_GET['old_pass']) and isset($_GET['new_pass']) and isset($_GET['confirm_pass'])	){


if( strlen($_GET['new_pass']) < 6 ){
die("<center><b style='color: red;'>Password must be at least 6 characters long</b></center>");	
	}

if( md5($_GET['new_pass'] ) != md5( $_GET['confirm_pass'] )   ){
die("<center><b style='color: red;'>The two passwords do not match</b></center>");	
}

$pass = $_GET['new_pass'];


$cr = new ConfigReader();
$cr->populate();
//get password from session

$ss->populate();
//now compare
if ( $ss->md5_pass == md5($_GET['old_pass']) ){
//ok we can update the password	
//now update password
$ss->md5_pass = md5($pass);
$_SESSION['md5_pass'] = $ss->md5_pass;
//update configs
if(! $cr->set( $ss->user . "_password" , $pass  ) ){
die('Failed to update database ' . $ss->user);	
}
//now create new auditor
$au = new Auditor(1 , "all" , $ss->user);
//record action
$au->add( "USER" , "Password changed" );
//done :)
die("<center><b style='color: green;'>Successfully changed password</b></center>");

}else{
//invalide curent password
die("<center><b style='color: red;'>Incorrect password entered</b></center>");
	
}


	
}else{
die('Invalid number of arguments passed');	
}	
	
	
}
//add a new fee
else if( $action == 'add_fee' ) {

if( isset($_GET['year']) and isset($_GET['term']) and isset($_GET['amount']) and isset($_GET['name'])	){
$year = $_GET['year'];
$term = $_GET['term'];
$name = $_GET['name'];
$amount = $_GET['amount'];


//additional error checking
if ( $amount > 1000 or $amount < 1.00 ){
die("<h1 style='color: red;'>The amount range specified is invalid</h1>");	
	}
if ( $term > 3 or $term < 1){
die("<h1 style='color: red;'>Please enter a valid term</h1>");	
	}
if( $year > $config->year+2) {
die("<h1 style='color: red;'>Year entered is too far away</h1>");
}
if( $year < $config->year){
die("<h1 style='color: red;'>You cannot add payments for past years</h1>");	
	}
if(  strlen($name) < 3 ){
die("<h1 style='color: red;'>Please enter a valid payment name</h1>");	
	}
	

//ok its okay
$st = new Student(0);
$p = new Payment( $st );
if ( ! $p->addFeeRequirement( $name , $amount ,$year , $term  ) ){
die("<h1 style='color: red;'>Database error ! Failed to add fee</h1>");	
}
//now log this activity
$au = new Auditor();
$au->add("FEES_STRUCTURE" , "Added a new payment $name [$ $amount] $year / $term"  ); 
die("<h2 style='color:green;'>Payment Added to Structure </h2>");		
}else{
die("<h1 style='color: red;'>Invalid number of arguments passed</h1>");	
	}
}


//remove a student
else if( $action == 'remove_student' ) {
if ( ( ! isset($_GET['id']) ) or ( ! isset($_GET['transfer'])) ){
die("Invalid number of arguments passed");	
}

$id = $_GET['id'];
$do_transfer = $_GET['transfer'];


$st = new Student($id);
$sc = new SchoolClass($st);
if( ! $st->populate() )die ("<h1>The specified student does not exist</h1>");
$sc->populate();
$status = false;
//now update the student
switch($do_transfer) {
case '0': //remove student
$status = $st->update("is_transferred" , true);
break;
case '1': //delete student
$status = $st->update("deleted" , true);
break;
}
if( $status and $sc->update('transfered' , '1') ){

$au = new Auditor(1 , "all" , $ss->user);
//record action
$au->add( "STUDENT" , "Removed student ( " . $st->id . " ) from Database ");
//done :)	
die("<center><h1 style='color: green;'>Student has been removed from the database</h1></center><script>getStudentListR();</script>");	
}else{
//check if we had removed the student
if( $status )
switch($do_transfer) {
case '0': //untransfer student
$status = $st->update("is_transferred" , false);
break;
case '1': //undelete student
$status = $st->update("deleted" , false);
break;
}	
die("<center><h1 style='color: red;'>Failed to remove student from database !</h1></center>");	
}

}

//unknow
var_dump($_GET);
?>
