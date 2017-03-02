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
require_once('../../php/auditor.php');

//first check if logged in
$db->connect();

if( ! isset($_SESSION['student_id'])  ){
	
die("No student Selected ! ");	
}

$st = new Student( $_SESSION['student_id']);
if( ! $st->populate() ){
die("Invalid student ID passed");	
}	

$sp = new Payment($st);
$sp->populate();

//now check for the parameters

$amount = $_GET['fees_amount'];

//to rid this world of dumb people

$amount = str_replace( ',' , '.' , $amount  );
$amount = floatval($amount);


$recpt = $_GET['fees_recpt'];
$type = $_GET['fees_type'];

//check if valid type
$tpi = $sp->getTypeInfo($type );
if( ! $tpi ){
die('Invalid payment type passed ');

}
$name = $tpi['name'];

//new payment object

$spb = new PaymentInfo();

//check if the type was fully paid


if( $sp->getAmountOwed($type) == 0.00 ){
	
die("The specified payment has already been paid in full, Please try again" );	
}
//now populate structure

$spb->amount = $amount;
$spb->receipt = $recpt;
$spb->id = $st->id;


//get the payment info

$spb->type = $type;

$pi = $sp->getTypeInfo( $type );


$spb->term = $pi['term'];
$spb->year = $pi['year'];


//now check if the amount we have is greater than the specified amount

if( $spb->amount > $pi['amount'] ){
	
die("Warning: You cannot pay more money for a fee than specified in the database" );	
}



$bool = $sp->addPayment( $spb );

//ok now we 
if( $bool ){
	$au = new Auditor($sess->user);
	$au->add("RECORD_PAYMENT" , "[{$st->id}]Recorded payment of \${$amount} for {$name} {$spb->year}/{$spb->term}" );
	$sp->populate();
echo "
<script>
function loadPayPage(){
$('#add_p_window').load('pages/payments/add.php?back_button=0');	
	
}

function loadPrintPage(\$db_id ){

$('#add_p_window').load('pages/payments/make_receipt.php?pid=' + \$db_id );	

}
</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' > Payment succesfully recorded </p>
<table>
<tr>
<td>Now Owed:</td>
<td><b style='color: purple; font-weight: bold;' > $ " . formatMoney($sp->getTotalAmountOwed() ) . "</b></td>
</tr>
</table> 
<br />
<br />
<center>
<h4><button onclick='loadPayPage();' >Go Back</button> -
<button onclick='loadPrintPage($bool);' >Print</button></h4>
</center>

";
die();
	
}else{
	
echo $sp->getError() ;
die();
}

	


?>	
