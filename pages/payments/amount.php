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

require_once('../../configuration.php');

require_once('../../php/student.php');
require_once('../../php/payment.php');
require_once('../../php/database.php');

$db->connect();


if( ! isset($_GET['id'] ) ){
die(0);
}
$id = $_SESSION['student_id'];
$type = $_GET['id'];

$st = new Student($id);
if( ! $st->populate() ) die("Sorry the specified student is non-existant !");
$sp = new Payment($st);
if( ! $sp->populate() )die("Sorry the specified student is non-existant !");
	


$sp->populate(); //so we have the list
$info = $sp->getTypeInfo($type);
$amount =  $info['amount'];
$paid = 0; //amount already paid by student
$size = sizeof($sp->pay_records);   
for( $x = 0; $x < $size ; $x++ ){
   //now add up all amounts paid relating to that particular type
   if( $sp->pay_records[$x]['type'] == $type){
   $paid += $sp->pay_records[$x]['amount'];	
   }	
}
   //now get the balance
   print formatMoney( $amount - $paid );
?>
