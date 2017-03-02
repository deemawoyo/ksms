<?php

require_once('../../configuration.php');

require_once('../../php/student.php');
require_once('../../php/payment.php');
require_once('../../php/database.php');

$db->connect();

$id = $_SESSION['student_id'];

$st = new Student( $id );

if( ! $st->populate() ){
die('Invalid student specified');
}
$sp = new Payment( $st );
$sp->populate();

$amount_owed = formatMoney(  $sp->getTotalAmountOwed() ,  true );
$lasp = $sp->getLastPaid();

//get a list of payments the studebt should make


?>

<div id='all_unpaid_window' >

<div  style="padding-bottom: 30px;">
<table  style='width: 100%;'>
<tr>
<td>Amount Owed:</td>
<td><b style='color: red;' >$<?php echo formatMoney($amount_owed); ?></b></td>
</tr>
<td>Last Payment:</td>
<td><b style='color: red;' ><?php echo  "{$lasp['year']}/{$lasp['term']} {$lasp['type_name']} ( {$lasp['date_paid']} ) "; ?> </b></td>
</tr>
</table>

</div>

<form id='list_form' >

<?php

$fully_paid = false;


if( $sp->getTotalAmountOwed() > 0.00 ){
	echo "
	<center><h1>Payments Due:</h1></center>

	<table CELLSPACING='20' CELLPADDING='20' class='table_cool' style='width: 100%;'>
<tr style='font-weight: bold; color: green;'>
<td>Name</td>
<td>Amount Due</td>
<td>Amount Paid</td>
<td>Year / Term</td>
</tr>
	";
	
	$s = sizeof( $sp->pay_list );
	if( $s > 0 ){
	$count = 0;
	$data = '';
	//only show the oldest payment
	for( $x = 0; $x < $s ; $x++ ){
	//now check if student has fully paid that type
	$value = $sp->pay_list[$x]['amount'];
	$name = $sp->pay_list[$x]['name'];
	$year = $sp->pay_list[$x]['year'];
	$term = $sp->pay_list[$x]['term'];	
	$type = $sp->pay_list[$x]['type'];
	$bool = $sp->getAmountOwed( $type );
	if( $bool > 0.00 ){ //not paid
	$tp = $sp->getTypeInfo($type );
	$due = formatMoney($tp['amount'] - $bool); 
	$fully_paid = true;
	$value = formatMoney($value - $due);
 $data .= "
 <tr>
 <td>$name</td>
 <td>\$ $value</td>
 <td>\$ $due</td>
 <td>$year / $term</td>
 </tr>
 \n";
	$count++;
	}	
	}
	
	print($data);
	}
}	

?>
</table>
<br />
<center><h1>Advance Payments</h1></center> 
<br />
<table class='table_cool' style='width:100%;'>
<tr style='font-weight: bold; color: green;'>
<td>Name</td>
<td>Amount Due</td>
<td>Amount Paid</td>
<td>Year / Term</td>
</tr>

<?php


	//lets check advance payments
	$data = '';
	$count = 0;
	$s = sizeof( $sp->advance_pay_list );
	for( $x = 0; $x < $s ; $x++ ){
	//now check if student has fully paid that type
	$value = $sp->advance_pay_list[$x]['amount'];
	$name = $sp->advance_pay_list[$x]['name'];
	$year = $sp->advance_pay_list[$x]['year'];
	$term = $sp->advance_pay_list[$x]['term'];	
	$type = $sp->advance_pay_list[$x]['type'];
	$bool = $sp->getAmountOwed( $type );
	if( $bool > 0.00 ){ //not paid 
	$fully_paid = true;
	$tp = $sp->getTypeInfo($type );
	$due = formatMoney($tp['amount'] - $bool); 
	$bool = formatMoney( $bool );
 $data .= "<tr>
<td>$name</td>
<td>\$ $bool</td>
<td>\$ $due</td>
<td>$year / $term</td>
</tr>
\n";
	$count++;
	}	
	}
	
echo $data;

?>
</table>
</form>

