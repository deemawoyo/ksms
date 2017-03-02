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

<center>
<?php
if(! isset($_GET['back_button'] ) ){
//only show the record payment header again if not arrived by backbutton
?>
<h3>Record Payment</h3>
<?php
}
?>
<script>
$f_a = 0.00;

$ok_recpt = false;
$ok_amount = false;
$ok_type = false;


function showAllUnpaid(){
Messi.load("pages/payments/all_unpaid.php" , {title: 'Payments Due and Payable' , timeOut: 120000 , modal: true , titleClass: 'info' });

}

function getFeesAmount(){
$id = $('#fees_type').val();

$.get('pages/payments/amount.php' ,
 {  id : $id} ,
  function($data)
  { 
  
   $('#fees_amount').val($data);
   //set global variable to store for comparison
   $f_a = $data;
   $ok_amount = true;
   $('#fees_warn').attr('src' , 'images/smalltick.png' );
    } 
);

if( $id == '-1' ){
$ok_type = false;
	
}

}

function checkAmount(  ){
$typed = $('#fees_amount').val();	
//only check if amount type is ok
if ( $ok_type ){

$.get('pages/payments/check.php' ,
 { 'type' : 'amount' ,
  selected : $typed ,
   from_db : $f_a } 
  , function($data)
  		{ 
  		
  		$('#fees_warn').attr('src' , 'images/' + $data ); 
  		$ok_amount = true;
  		}    
  	);

}
	
}

function checkReceipt(  ){
$typed = $('#fees_recpt').val();	

if( $typed.length < 3 ){
$('#fees_recpt_warn').attr('src' , 'images/smallx.png');
$ok_recpt = false;	
}else{
$ok_recpt = true;	
$('#fees_recpt_warn').attr('src' , 'images/smalltick.png');	
}

}

function resetForm( ){
	
$('#fees_recpt').val('');
$('#fees_amount').val(0.00);
$('#fees_recpt_warn').attr('src' , 'images/smallx.png');
$('#fees_warn').attr('src' , 'images/smallx.png');
$ok_amount = false;
$ok_recpt = false;
$ok_type = false;			
}


function askPayment(){

$errors = '';

if( $('#fees_type').val() == '-1' ){
$ok_type = false;	
}else{
$ok_type = true;	
}

if( ! $ok_type ){
$errors = 'Select a payment to process';	
}
if( ! $ok_amount ){
	
$errors = $errors +  "<br /> Invalid payment amount entered";	
}
if( ! $ok_recpt ){
	
$errors = $errors +  "<br /> Enter a valid receipt number ";	
}

if( $errors != '' ){
new Messi("Please fix the following before continuing <br /><h3 style='color: red; font-weight: bold;'> " + $errors + "</h3>" ,  {title: 'Warning !', titleClass: 'anim warning' , modal: true , buttons: [{id: 0, label: 'Close', val: 'X'  } ] } )	;
return 0;
}	

new Messi('Are you sure you want to process this payment' ,
 {title: 'Confirm Payment' ,
  modal: true ,
   buttons: 
   [
   	{id: 0, label: 'Cancel', val: 'X'  } ,
   	 {id: 1, label: 'Continue', val: 'Y' , class: 'btn-success' }]   
  , callback: function($resp){ if($resp == 'Y') processPayment(); } }  );	
	
}

function processPayment( ){
//do basic checking

//now we execute the command
$data = $('#add_p_form').serialize();
$.get(
'pages/payments/record.php' ,
 $data  ,
 function($data){ $('#add_p_window').html($data); } 
  
 );
	
}

</script>

<div id='add_p_window' >

<div  style="padding-bottom: 30px;">
<table>
<tr>
<td>Amount Owed:</td>
<td><b style='color: red;' >$<?php echo formatMoney($amount_owed); ?></b></td>
</tr>
<td>Last Payment:</td>
<td><b style='color: red;' ><?php echo  "{$lasp['year']}/{$lasp['term']} {$lasp['type_name']} ( {$lasp['date_paid']} ) "; ?> </b></td>
</tr>
</table>

</div>


<form id='add_p_form' >
<table CELLSPACING='20' CELLPADDING='20'>
<tr>
<td>Payment:</td>
<td>
<select id='fees_type' onchange='getFeesAmount();' name='fees_type' style="width: 200px; font-weight: bold; height: 25px;">
<?php

$fully_paid = false;


if( $sp->getTotalAmountOwed() > 0.00 ){
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
	if( $bool ){ //not paid 
	$fully_paid = true;
	if( $count == 0)
 $data .= "<option value=\"$type\" > $year/$term $name </option> \n";
	$count++;
	}	
	}
	if( $count > 0 )	
	$data = "<option value='-1' >$count Payments</option>\n" . $data;
	print($data);
	}


}else{
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
	if( $bool ){ //not paid 
	$fully_paid = true;
	if( $count == 0)
 $data .= "<option value=\"$type\" > $year/$term $name </option> \n";
	$count++;
	}	
	}
	if( $count > 0 ){
	//advance payments can be made
	$data = "<option value='-999' >Fully Paid [ $count Advance Payments possible]</option>\n" . $data;
	echo $data;
	}else{
	echo "<option value='-999' >Student Fully Paid[No payments possible]</option>";
	}

}






?>
</select>&nbsp;&nbsp;<a onclick='showAllUnpaid()' title='Click here to view a list of all payments the student should make' style='font-weight: bold; cursor: pointer; color: blue; ' >[?]</a>
</td>
</tr>
<tr>
<td>Amount:<b>$</b><br /></td>
<td><input type='text' onkeyup='checkNumber(this); checkAmount();' name='fees_amount' id='fees_amount'  style="width: 200px; font-weight: bold; height: 25px;" />
<img src='images/smallx.png'  style=' width: 16px; height: 16px;' id='fees_warn' />
</td>
</tr>
<tr>
<td>Receipt No:<br /></td>
<td><input type='text' onkeyup="checkReceipt();" name='fees_recpt' id='fees_recpt' style="width: 200px; font-weight: bold; height: 25px;" />
<img src='images/smallx.png'  style=' width: 16px; height: 16px;' id='fees_recpt_warn' />

</td>
</tr>
</table>

</form>
<center>

<div style='padding-top: 30px;' >
<button id='submit_fees' onclick='askPayment();'  >Record</button>
&nbsp;&nbsp;&nbsp;
<button id='cancel_fees' onclick='resetForm()' style='' >Reset Form</button>
</div>
</center>

NB: Only the oldest payment is shown
<p>For more info view the Payment Report
</p>
</div>

