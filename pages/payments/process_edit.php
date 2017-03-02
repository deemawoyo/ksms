<?php
/**********************************************************
Author: Delight Mawoyo

Name: Update student Records

************************************************************/
require_once("../../configuration.php");
require_once("../..//php/database.php");
require_once("../../php/student.php");
require_once("../../php/class.php");
require_once("../../php/auditor.php");
require_once("../../php/payment.php");
require_once("../../php/contact.php");
require_once("../../php/age.php");

if((! isset($_GET['id'] ) ) or ( ! isset($_GET['type'] ) ) ){
die("");
} 

$db->connect();

$id = $_GET['id'];
$type= $_GET['type'];


$db->connect();

if( $type == "payment_record"){
$st = new Student(0);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//print out the info
$info['amount'] = formatMoney( $info['amount'] );

$del = isset($_GET['del']) ? $_GET['del'] : false;
$msg1 = '';
$msg2 = '';
if($del == 'true' ){ //delete the payment
	$msg1 = "<p style='color:red'>Delete The current payment.</p>";
	$msg2 = '	<button    onclick="delPayment(' . $id . ')" >Delete</button>';

}else{
	$msg1 = "<p style='color:red'>Edit The current payment.</p>";
	$msg2 = '	<button  onclick="edPayment(' . $id . ')" >Update</button>';
	
//edit must be in the form of a form
echo 
"
<script>
function loadBack(){
$('#u_record_edit').load(\"pages/payments/edit.php?back_button=0\");	
	
}
</script>
<center>
$msg1
<img src='images/warning.png' style='width: 64px; height: 64px; float: left;' />
<form id='edit_pay_form' method='get' >
<table style='color: black;'>
<tr>
<td><b>Name: </b></td>
<td><input type=text disabled=true value=\"{$info['name']} {$info['year']}/{$info['term']}\" /></td>
</tr>
<tr>
<td><b>* Amount: </b></td>
<td><b><input type=text id=\"e_new_amount\" name==\"e_new_amount\"  value=\"{$info['amount']}\" onkeyup=\"checkNumber(this);\"/></td>
</tr>
<tr>
<td><b>* Receipt: </b></td>
<td><input type=text value=\"{$info['receipt']}\" id=\"e_new_receipt\" name==\"e_new_receipt\" /></td>
</tr>
<tr>
<td><b>Date Paid: </b></td>
<td><input type=text disabled=true value=\"{$info['date']}\" /></td>
</tr>
</table>
</form>
<br />
$msg2 
<button onclick='loadBack();' >BACK</button>
</center>
";	
exit;
}
	
echo 
"
<center>
$msg1
<table style='color: black;'>
<tr>
<td><b>Name: </b></td>
<td><b>{$info['name']} {$info['year']}/{$info['term']}</b></td>
</tr>
<tr>
<td><b>Amount: </b></td>
<td><b>$ {$info['amount']}</b></td>
</tr>
<tr>
<td><b>Receipt: </b></td>
<td><b>{$info['receipt']}</b></td>
</tr>
<tr>
<td><b>Date Paid: </b></td>
<td><b>{$info['date']}</b></td>
</tr>
</table>
<br />
$msg2 
<button onclick='loadBack();' >BACK</button>
</center>
";

//echo $data;	
}
if( $type == 'del_payment'){
$st = new Student($_SESSION['student_id']);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//ok so it exists now we must delete if

if( $p->deletePayment($id) ){
	$au = new Auditor($sess->user);
	$amount = formatMoney($info['amount']);
	$au->add("DELETE_PAYMENT" , "[{$st->id}] Deleted payment {$info['name']} {$info['year']}/{$info['term']} $ {$amount} "  );

echo "
<script>
function loadBack(){
$('#u_record_edit').load(\"pages/payments/edit.php?back_button=0\");	
	
}
</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' > Payment succesfully deleted </p>
<table>
<tr>
</tr>
</table> 
<br />
<br />
<center>
<h4><button onclick='loadBack()' >Go Back</button> </h4>
</center>

";

exit;

}else{
	
die('Failed to delete record from database');	
}
	
	
	
}	
if( $type == 'edit_payment'){
	
if( (! isset($_GET['amount'])) or (! isset($_GET['receipt'])) ){
	
die("Invalid number of arguments passed");	
}
	
$st = new Student($_SESSION['student_id']);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//ok so it exists now we must update it

//to rid this world of dumb people
$amount = $_GET['amount'] ;
$amount = str_replace( ',' , '.' , $amount  );
$amount = floatval($amount);


$receipt = $_GET['receipt'];
//first check if the new payment is not too much

if( $amount  >  $p->getTypeInfo($info["type"])["amount"]  ){
die("Error ! Entered amount is greater than maximum payable amount for this fee type");
}
//check if student has overpayed
/*
if( $amount > $p->getAmountOwed($info['type']) ){
die('The amount entered will result in the student been overcharged for the payment made !');
}

*/

//now update db
$au = new Auditor($sess->user);
if( $p->editPayment($id , 'amount' , $amount) )
if( $p->editPayment($id , 'receipt' , $receipt) ){
$au->add("UPDATE_PAYMENT" , "[{$st->id}]Changed payment record {$info['name']} [$ {$info['amount']} to $ $amount ]  Receipt [ {$info['receipt']} to $receipt ] " )	;

echo "
<script>
function loadBack(){
$('#u_record_edit').load(\"pages/payments/edit.php?back_button=0\");	
	
}
</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' > Payment succesfully updated </p>
<table>
<tr>
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
die("<center><h2 style='color: red;' >Failed to update one or more entries, Check for updates<br /></h2><button onclick='loadBack();' >BACK</button></center>");	

}

?>
