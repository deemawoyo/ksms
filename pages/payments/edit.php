<?php

require_once('../../configuration.php');
require_once('../../php/student.php');
require_once('../../php/payment.php');
require_once('../../php/database.php');


$db->connect();

if( ! isset($_SESSION['student_id']))
die('Student ID is not set');

$st = new Student( $_SESSION['student_id']);
$st->populate();

?>

<div  style=" width: 100%; float: left; padding-left:10px; padding-right: 10px;" name="u_record_edit" id="u_record_edit" >
<script>
function reloadPage(){
 
 $('#payments_made').load('pages/payments/edit.php?part_only=1&year=' + $('#year').val() );	
	
}

function popupPrint( $p_id ){
var url = 'pages/payments/make_receipt.php?exec=html_print&pid=' + $p_id;

 window.open( url, "Payment Receipt", "menubar=0,location=0,height=700,width=700" );
    
}



function makeRecpt(){
new Messi('The receipt will be sent to the first printer\'s queue or you can save it as a pdf document ' , { title: 'Payment Receipt' , modal : true} );
	
}
</script>	

<?php

if( (! isset($_GET['part_only'])  ) and (! isset($_GET['year'] ) ) ){
	
?>
<h3>Payments made by <?php echo $st->fullname; ?> </h3>	
<table  style='width: 100%;'>
<tr>
<td><b style='font-weight: bolder;' >Year:</b>
<select id='year' onchange="reloadPage();" style="width: 200px; font-weight: bold; height: 25px;" >
<?php


echo "<option value='" . date('Y') . "' > " . date('Y') . " </option> ";


for($x = (date('Y')-1)  ; $x >= $st->year_enrolled ; $x-- ){
	
echo "<option value='$x' >$x</option>";	
}
$next = date('Y') + 1;
echo "<option value='$next'>$next</option>";

?>
</select>
 </td>
 
</tr>

</table>
<br />

<?php


}

?>

<script>



function editPayment($db_id){
$("#u_record_edit").load("pages/payments/process_edit.php?id=" + $db_id + "&type=payment_record&del=false");	
	
}

function removePayment($db_id){
$("#u_record_edit").load("pages/payments/process_edit.php?id=" + $db_id + "&type=payment_record&del=true");

}

function popupPrint( $p_id ){
var url = 'pages/payments/make_receipt.php?exec=html_print&pid=' + $p_id;

 window.open( url, "Payment Receipt", "menubar=0,location=0,height=700,width=700" );
    
}
	
	
function delPayment($db_id ){


new Messi('Are you sure you want to DELETE this payment ?' , {title: 'Confirm' ,  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} , {id: 0, label: 'Yes', val: 'Y'}   ]     
    , modal: true , callback: 
function(resp){ 
if( resp == 'Y' ){
$("#u_record_edit").load("pages/payments/process_edit.php?id=" + $db_id + "&type=del_payment");

}	

} 


});

}



function edPayment( $db_id ){
$amnt = $("#e_new_amount").val();
$rcpt = $("#e_new_receipt").val();
if( $amnt == 0 ){
new Messi('A fee cannot be $0,00' , {title: 'Error' , modal: true} );	
return 0;
}
if( $amnt < 1){
	new Messi('Fees amount is too small' , {title: 'Error' , modal: true} );
	return 0;
}
if ($amnt == '' || $rcpt == '' ){
new Messi('Empty values are not allowed' , {title: 'Error' , modal: true} );
return 0;	
}	

new Messi('Are you sure you want to update this payment ?' , {title: 'Confirm' ,  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} , {id: 0, label: 'Yes', val: 'Y'}   ]     
    , modal: true , callback: 

function(resp){ 
if( resp == 'Y' ){
$("#u_record_edit").load("pages/payments/process_edit.php?id=" + $db_id + "&type=edit_payment&amount=" + $amnt + "&receipt=" + $rcpt);

}	

} 

}
);
	
	
	
}

</script>

<?php


if( ! isset($_SESSION['student_id'])  ){
	
die("No student Selected ! ");	
}

$id = $_SESSION['student_id'];

$_year = isset($_GET['year'] ) ? $_GET['year'] : date('Y');


$st = new Student($id);	
if (! $st->populate() )die("Invalid student ID passed"); 	
//create payment structure
$p = new Payment($st);
$p->populate();

//now start printing out the paylist
$data = "
<div id='payments_made' >
<h2>Payments Received</h2>
<table class='table_cool' style=\"padding-top: 15px; color: black;\" border=\"4\" cellpadding=\"15\" cellspacing=\"15\"  align=\"center\" bgcolor=\"#FFFFFF\" width=\"100%\">
<tr style=' color: green; font-weight: bold; background-color: white;' >
<td><b>Name</b></td>
<td><b>Year</b>/
<b>Term</b></td>
<td><b>Amount </b></td>
<td><b>Receipt</b></td>
<td><b>Action</b></td>

</tr>
";

$size = sizeof( $p->pay_records);

for ( $x = 0; $x < $size ; $x++){

$amount = formatMoney( $p->pay_records[$x]['amount'] );	
$year = $p->pay_records[$x]['year'];
$term = $p->pay_records[$x]['term'];	
$db_id = $p->pay_records[$x]['db_id'];

$name = $p->getTypeInfo($p->pay_records[$x]['type'])['name'];
$rcpt = 	$p->pay_records[$x]['receipt'];
if( $_year ==  $year ){
$data .= "
<tr >
<td><b>$name</b></td>
<td><b>$year</b>/<b>$term</b></td>
<td><b>$ $amount</b></td>
<td><b>$rcpt</b></td>

<td><b><a onclick=\"editPayment($db_id);\" style='color: orange;' >Edit</a>&nbsp;/&nbsp;<a onclick=\"removePayment($db_id);\" style='color: red;' >Remove</a>&nbsp;/&nbsp;<a onclick=\"popupPrint($db_id);\" style='color: purple;' >Print</a></b></td>

</tr>
";

}

}


$data .= "
</table>
</div>
";	
echo $data;

?>
</div>





          
