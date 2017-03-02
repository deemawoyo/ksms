<?php
require_once("../../configuration.php");
require_once("../../php/database.php");
require_once("../../php/student.php");
require_once("../../php/class.php");
require_once("../../php/payment.php");
require_once("../../php/auditor.php");
require_once("../../php/configreader.php");



$id = isset( $_GET['id']) ? $_GET['id'] : '';

//connect to database
$db->connect();

//update student password

if( isset($_GET['old_pass']) and isset($_GET['new_pass']) and isset($_GET['confirm_pass'])	){


if( strlen($_GET['new_pass']) < 8 ){
die("<center><h3 style='color: red;'>Password must be at least 8 characters long</h3></center>");	
	}

if( md5($_GET['new_pass'] ) != md5( $_GET['confirm_pass'] )   ){
die("<center><h3 style='color: red;'>The two passwords do not match</h3></center>");	
}

$pass = $_GET['new_pass'];


$us = new Users();
//get password from session

$sess->populate();
//now compare
if ( $us->get( $sess->user , "password" ) == md5($_GET['old_pass']) ){
//ok we can update the password	
//now update password
$sess->md5_pass = md5($pass);
$_SESSION['md5_pass'] = $sess->md5_pass;
//update configs
if(! $us->set( $sess->user ,  "password"  ,  md5($pass)   ) ){
die('Failed to update database ' . $sess->user);	
}
//now create new auditor
$au = new Auditor(1 , "all" , $sess->user);
//record action
$au->add( "USER" , "Password changed" );
//done :)
die("<center><h3 style='color: green;'>Successfully changed password</h3></center>");

}else{
//invalide curent password
die("<center><h3 style='color: red;'>Incorrect password entered</h3></center>");
	
}


	
}else{
die('Invalid number of arguments passed');	
}	
	
	


?>