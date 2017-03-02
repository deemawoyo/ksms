<?php
require_once("configuration.php");
require_once("php/database.php");
//all functions will be included here so we dont have to worry about including in every script

require_once("php/student.php");
require_once("php/class.php");
require_once("php/payment.php");
require_once("php/age.php");
require_once("php/configreader.php");
require_once("php/contact.php");
require_once("php/users.php");
require_once("php/backup.php");
require_once("php/accesslog.php");
require_once("php/auditor.php");
require_once("php/session.php");
require_once("php/security.php");
require_once("php/textbook_library.php");
require_once("php/student_photo.php");
require_once("php/buffer.php");

$db->connect();

//retrieves a particular code segment

if( ! $sess->isLoggedIn() ){

die("<script>
Messi.alert('You are not logged in');
bypass = true;
window.location = 'login.php';
</script>
");

}

if( ! isset($_GET['page'] ) ){
//return the default main page

?>
<script type="text/javascript" >



</script>

<div class="menu"  >

<a onclick="loadPage('students');" id="student" title="Select, update, add, delete student records"><img src="images/student.jpg"  /><br /><b><h2>Student</h2></b></a>    

<a onclick="loadPage('payments');" id="payments" title="Record, update, delete payment records "><img src="images/book_record.jpg"  /><br /><b><h2>Accounting</h2></b></a> 

<a onclick="loadPage('classes');"  id="classes" title="Manage ,add school classes"><img src="images/students.jpg"  /><br /><b><h2>Classes</h2></b></a> 

<a onclick="showStaff();"  id="documents" title="Upload, download or print student documents">&nbsp;&nbsp;<img src="images/staff.jpg"  /><br /><b><h2>Staff</h2></b></a> 

<a onclick="loadPage('textbooks');"  id="documents" title="View school textbooks borrowed by students"><img src="images/textbook.jpg"  /><br /><b><h2>TextBooks</h2></b></a> 
<!--
<a onclick="loadPage('excel');" id="excel" title="Import records from EXCEL document"><img src="images/excel.png"  /><br /><b><h2>Excel Import</h2></b></a> 
-->
<a onclick="loadPage('settings');"  id="settings" title="Update your settings"><img src="images/settings.jpg"  /><br /><b><h2>Settings</h2></b></a> 


 
</center>

<?php
exit;
}





//now for the real code

$page = $_GET['page'];
//set for subpages
$sub = isset($_GET['sub'] ) ? $_GET['sub'] : false;

//we start with core pages

if( ! $sub ){

require_once("pages/$page.php");


}else{
//its a sub page
require_once("pages/$page/$sub.php");

}

?>
