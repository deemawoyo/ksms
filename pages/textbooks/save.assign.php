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
require_once('../../php/textbook_library.php');
require_once('../../php/database.php');

$db->connect();

if( ! isset($_SESSION['student_id'] ) ){
die('Student id is not set');
}

//now check if all required vars are set
$check = array('txt_title' , 'txt_number' , 'txt_condition' );

foreach( $check as $k ){
if( ! isset($_GET[$k] ) ){
die('Unset variable');
}

}

//now add the student's book
$txtmgr = new TextBookManager();
$txtmgr->student_id = $_SESSION['student_id'];

//do some basic error checking

if( strlen($_GET['txt_title'] ) < 5 ){
die('Enter a valid textbook title');
}
if( strlen($_GET['txt_number'] ) < 1 ){
die('Enter a valid textbook title');
}
 if( strlen($_GET['txt_condition'] ) < 4 ){
die('Enter a valid coondition');
}
  
//now lets add the book

$txtbk = new TextBook();
$txtbk->student_id = $_SESSION['student_id'];
$txtbk->number = $_GET['txt_number'];
$txtbk->title = $_GET['txt_title'];
$txtbk->init_condition = $_GET['txt_condition'];

//now add the textbook

if( $txtmgr->add( $txtbk ) ){

echo "
<script>
function loadAssPage(){
$('#add_t_window').load('pages/textbooks/assign.php');	
	
}


</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' > Book now loaned </p>
<table>
<tr>
<td>Books Unreturned:</td>
<td><b style='color: purple; font-weight: bold;' > " . sizeof( $txtmgr->getListBorrowed() ) . "</b></td>
</tr>
</table> 
<br />
<br />
<center>
<h4><button onclick='loadAssPage();' >Go Back</button></h4>
</center>

";
die();

}else{
die('Error Database Error, Please Try again');

}

?>
