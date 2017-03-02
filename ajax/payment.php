<?php
require_once("../configuration.php");
require_once("../php/database.php");
require_once("../php/student.php");
require_once("../php/payment.php"); 

$db->connect();

//add a payment
if( isset($_POST['amount'] ) and isset($_POST['id'] ) and isset($_POST['type'] ) and isset($_POST['receipt'] ) ){
	$type = $_POST['type'];
	$id = $_POST['id'];
	$receipt = $_POST['receipt'];
	$amount = $_POST['amount'];
	$st = new Student($id);
	if( ! $st->populate() ) die("Sorry the specified student is non-existant !");
	$p = new Payment($st);
	if( ! $p->populate() )die("Sorry the specified student is non-existant !");
	
	if( ( $amount > 10000 ) or ($amount < 0.50 ) ){
	die("Invalid payment amount specified !");
	}
	if( strlen($receipt) > 25){
	die("Invalid receipt number passed ");
	}
	$ti = $p->getTypeInfo($type);
	if ( ! $ti ){
	die("Invalid payment type !");
	}
	//make payment structure
	$ps = new PaymentInfo();
	$ps->id = $id;
	$ps->type = $type;
	$ps->year = $ti["year"];
	$ps->amount = $amount;
	$ps->term = $ti["term"];
	$ps->receipt = $receipt;
	//add payment
	if (! $p->addPayment($ps) ){
	die ("Error in database connection.Please try again");	
	
	}
	print "1";
}

//get a fee amount
if( isset($_GET['action'] ) and isset($_GET['id'] ) and isset($_GET['type'] ) ){
	$type = $_GET['type'];
	$id = $_GET['id'];
	$action = $_GET['action'];
	$st = new Student($id);
	
	$p = new Payment($st);
		
	if($action == "amount" ){
	if(! isset($_GET['type'] ) )die ("Invalid fee type");
	$p->populate(); //so we have the list
	$info = $p->getTypeInfo($type);
   $amount =  $info['amount'];
   $paid = 0; //amount already paid by student
	$size = sizeof($p->pay_records);   
   for( $x = 0; $x < $size ; $x++ ){
   //now add up all amounts paid relating to that particular type
   if( $p->pay_records[$x]['type'] == $type){
   $paid += $p->pay_records[$x]['amount'];	
   }	
   }
   //now get the balance
   print ( $amount - $paid );
	exit;
}
	

}

//get list of payments the student should make
 else if( isset($_GET['action'] ) and isset($_GET['id'] ) ){
	$id = $_GET['id'];
	$action = $_GET['action'];
	$st = new Student($id);
	
	if( ! $st->populate() ) die("<b>No such student exists</b>") ;
	$p = new Payment($st);
	$p->populate();
	
	if( $action == "unpaid" ){
	//now populate list of all payments student should make
	
	if( $p->getTotalAmountOwed() == 0 ){
	print "<option>Student is Fully Paid</option>";
	exit;
	} 
	$s = sizeof( $p->pay_list );
	$count = 0;
	$data = '';
	for( $x = 0; $x < $s ; $x++ ){
	//now check if student has fully paid that type
	$value = $p->pay_list[$x]['amount'];
	$name = $p->pay_list[$x]['name'];
	$year = $p->pay_list[$x]['year'];
	$term = $p->pay_list[$x]['term'];	
	$type = $p->pay_list[$x]['type'];
	$bool = $p->getAmountOwed( $type );
	if( $bool ){ //not paid 
 $data .= "<option value=\"$type\" >$year/$term $name </option> \n";
	$count++;
	}	
	}	
	$data = "<option>$count Payments</option>\n" . $data;
	die($data);
	
	}

}
	







?>
