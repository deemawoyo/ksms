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
require_once("../../php/student.php");
require_once("../../php/payment.php");
require_once("../../php/class.php");
require_once("../../php/auditor.php");
require_once("../../php/textbook_library.php");
require_once("../../php/database.php");
require_once("../../php/age.php");

$db->connect();

if( isset($_GET['confirm'])  ){
//now  we transfer the student	
$st = new Student( $_SESSION['student_id'] );	
if( $st->populate()  ){
	
//first we must check if the student owes us anything
$errors = '';
$sp = new Payment( $st );
$sp->populate();

$amount = $sp->getTotalAmountOwed();

if( $amount != 0.00 ){
$errors .= "<h2>Student Is not fully paid</h2><br />";	
}	
//now check textbooks
$txt_mgr = new TextBookManager();
$txt_mgr->student_id = $st->id;
$list = $txt_mgr->getListBorrowed();

if( $list ){
$errors .= '<h1>Student owes the school some textbooks</h1><br />'; 		
}
if($errors != '' ){
die('
<img src=\'images/warning.png\' style=\'float: left; \' />

<center>
<h2 style="color: red; font-weight: bold;" >Operation Failed !</h2>
' . $errors );

}	
	
	$st->transfer();
	$sc = new SchoolClass( $st );
	$sc->populate();
	$sc->update('transfered' , '1' );
	//auditor log
	$au = new Auditor();

$au->add("TRANSFER" , "[{$st->id}] Transferred from school " )	;

	//print success page
echo "
<script>
function loadBack(){
loadPage('select.student');
}
</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' > Student succesfully transfered </p>
<table>
<tr>
<td><small>To restore this student find him/her under the Student's archive</small>
</td>
</tr>
</table> 
<br />
<br />
<center>
<h4><button onclick='loadBack()' >Go Back</button> </h4>
</center>

";

exit;
		
}	
}

?>
<script type="text/javascript" >
function confirmTransfer(){

new Messi('Are you sure you want to TRANSFER this student ?' , {title: 'Confirm Transfer Student' ,  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} , {id: 0, label: 'Yes', val: 'Y'}   ]     
    , modal: true , callback: 
function(resp){ 
if( resp == 'Y' ){
$("#u_record_edit").load("pages/students/transfer.php?confirm=true");

}	

} 


});	
	
	
}

</script>

<div id='u_record_edit' >
<img src='images/data_remove.png' style='float: left; ' />
<center>
<h3>Transfer Student</h3>
<p>
Are you sure you want to transfer this student from the school ?
</p>
<button onclick='confirmTransfer();'>Transfer Student</button>
</center>
</div>