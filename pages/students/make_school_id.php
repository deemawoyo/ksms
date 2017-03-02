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

$db->connect();

if( ! isset($_SESSION['student_id'] ) ){
die('NO student Selected !');
}

$st = new Student( $_SESSION['student_id'] );
if( ! $st->populate() ){
die('Invalid student ID');
}

//now lets generate an id
$st->config = $config;
$id = $st->generateSchoolID();

if( $id == false ){
die('Failed !!! ');
}

die($id);

?>
