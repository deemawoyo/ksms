<?php
/**********************************************************
Author: Delight Mawoyo

Name: Update student Records

************************************************************/
require_once("../configuration.php");
require_once("../php/database.php");
require_once("../php/student.php");
require_once("../php/class.php");
require_once("../php/payment.php");
require_once("../php/contact.php");
require_once("../php/age.php");

if((! isset($_GET['id'] ) ) or ( ! isset($_GET['type'] ) ) ){
die("");
} 

$db->connect();

$id = $_GET['id'];
$type= $_GET['type'];

if ( $type == "basic" ){

$st = new Student($id);
if( ! $st->populate() ) die ("Invalid student I.D passed");

$sc = new StudentContact($st);
$sc->populate();

$pri_c = $sc->home_phone;
$pri_h = $sc->home_addr;
$form = 
"
<center><a style=\"color: red;\">Basic Details</a>
 </center>
 <table >
 <tr>
<td><b style=\"color: blue;\">Home Address</b></td>

<td><input id='rec1' style=\"width: 400px;\" value=\"$pri_h\"/><br /></td>
</tr>
<tr></tr>
<tr>
<td><b style=\"color: blue;\">Home Phone</b></td>
<td><input id='rec2' value=\"$pri_c\"/></td>
</tr>
</table>
<br />
<center>
<a  class=\"-button silver\" onclick=\"confirmUpdateInfo()\" ><span class=\"-tick\"> Update </span></a>
</center>
";

print $form;
exit;
}
if ($type == "contact" ){


$st = new Student($id);
if( ! $st->populate() ) die ("Invalid student I.D passed");

$sc = new StudentContact($st);
$sc->populate();

$pri_c = $sc->home_phone;
$pri_h = $sc->home_addr;
$sec_c = $sc->contact_phone;
$sec_h = $sc->contact_addr;
$form = 
"
<center><a style=\"color: red;\">Contact Details</a>
 </center>
 <table >
 <tr>
<td><b style=\"color: blue;\">Home Address</b></td>

<td><input id='rec1' style=\"width: 300px;\" value=\"$pri_h\"/><br /></td>

<td><b style=\"color: blue;\">Home Phone</b></td>
<td><input id='rec2' value=\"$pri_c\"/></td>
</tr>
 <tr>
<td><b style=\"color: blue;\">Sec. Address</b></td>

<td><input id='rec1' style=\"width: 300px;\" value=\"$sec_h\"/><br /></td>

<td><b style=\"color: blue;\">Sec. Phone</b></td>
<td><input id='rec2' value=\"$sec_c\"/></td>
</tr>
</table>
<br />
<center>
<a  class=\"-button silver\" onclick=\"confirmUpdateInfo()\" ><span class=\"-tick\"> Update </span></a>
</center>
";

print $form;
exit;


}
if ( $type == "academic" ){

$st = new Student($id);
if( ! $st->populate() ) die ("Invalid student I.D passed");

$sc = new StudentContact($st);
$sc->populate();

$pri_c = $sc->home_phone;
$pri_h = $sc->home_addr;
$sec_c = $sc->contact_phone;
$sec_h = $sc->contact_addr;
$form = 
"
<center><a style=\"color: red;\">Academic Details</a>
 </center>
 <br />
 <table >
 <tr>
 <b style='color: red;'><center> You can change more student details by going under <a href='admin.php' >Settings</a> and Selecting Update under Student.<br />You must be logged in as Administrator </center> </b>
</tr>
</table>
<br />

";

print $form;
exit;



}
if( $type == "s_academic"){
	
//get enrolment info
$st = new Student($id);
if( ! $st->populate() ){
	die("The specified user no longer exists in the database");
}

$sql = "SELECT * FROM enroll_info_form1 WHERE id = \"$id\" ";
$res = mysql_query($sql);


$form = '';


if(  mysql_affected_rows() ){
$a = mysql_fetch_array($res , MYSQL_ASSOC);
	
$primary_school = $a['primary_school'];
$m_p = $a['maths_units'];
$e_p = $a['english_units'];
$l_p = $a['language_units'];
$gp_p = $a['content_units'];
$ed12 = $a['ed12_number'];
$toty = $a['total_units']; 	



}else{
echo "<h2>NO enrollment info was found</h2>";	
	
}	
echo "
<table>
<tr>
<td><b style='color: blue;' >ED12 Number:</b></td>
<td><input type=text disabled=true value=\"$ed12\" /></td>
</tr>
<tr>
<td><b style='color: blue;' >Primary School</b></td>
<td><input type=text  value=\"$primary_school\" id=\"enroll_pri_sch\"/></td>
</tr>
<tr>
<td><b style='color: blue;' >Total Units:</b></td>
<td><input type=text disabled=true value=\"$toty\" /></td>
</tr>
";
echo '
<td>
<b style="color: black;" >Mathematics&nbsp;&nbsp;</b>
	<select id="enroll_maths_u" style="width:90px; height: 35px; " >
	';
//print out the selected value
echo "<option value='$m_p'>$m_p</option>\n";
		for($x = 1; $x < 10 ;$x++)
		echo "<option value='$x'>$x</option>\n";
echo '</select>
</td><td>	
<b style="color: black;" >English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br />
	<select id="enroll_english_u" style="width:90px; height: 35px; " >
';
echo "<option value='$e_p'>$e_p</option>\n";
		for($x = 1; $x < 10 ;$x++)
		echo "<option value='$x'>$x</option>\n";

echo '</select>
</td>

';
echo '
<td>
<b style="color: black;" >General Paper&nbsp;&nbsp;</b>
	<select  id="enroll_gp_u" style="width:90px; height: 35px; " >
	';
//print out the selected value
echo "<option value='$gp_p'>$gp_p</option>\n";
		for($x = 1; $x < 10 ;$x++)
		echo "<option value='$x'>$x</option>\n";
echo '</select>
</td><td>	
<b style="color: black;" >Language&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
	<select  id="enroll_language_u" style="width:90px; height: 35px; " >
';
echo "<option value='$l_p'>$l_p</option>\n";
		for($x = 1; $x < 10 ;$x++)
		echo "<option value='$x'>$x</option>\n";

echo '</select>
</td>
</tr>
</table>
<center>
<a  class="-button silver" onclick="updateAcademicInfo()" ><span class="-tick"> Update </span></a>
</center>
';	
	
}

if( $type == "payments" ){
$st = new Student($id);	
if (! $st->populate() )die("Invalid student ID passed"); 	
//create payment structure
$p = new Payment($st);
$p->populate();

//now start printing out the paylist
$data = "
<h2>Payments Received</h2>
<table style=\"padding-top: 3px; color: black;\" border=\"4\" cellpadding=\"5\" cellspacing=\"5\"  align=\"center\" bgcolor=\"#FFFFFF\" width=\"90%\">
<tr >
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

$amount = $p->pay_records[$x]['amount'];	
$year = $p->pay_records[$x]['year'];
$term = $p->pay_records[$x]['term'];	
$db_id = $p->pay_records[$x]['db_id'];

$name = $p->getTypeInfo($p->pay_records[$x]['type'])['name'];
$rcpt = 	$p->pay_records[$x]['receipt'];

$data .= "
<tr >
<td><b>$name</b></td>
<td><b>$year</b>/<b>$term</b></td>
<td><b>$ $amount</b></td>
<td><b>$rcpt</b></td>

<td><b><a onclick=\"editPayment($db_id);\" style='color: orange;' >Edit</a>&nbsp;/&nbsp;<a onclick=\"removePayment($db_id);\" style='color: red;' >Remove</a></b></td>
</tr>
";
}


$data .= "
</table>

";	
echo $data;
}
//retrive info about a payment record
if( $type == "payment_record"){
$st = new Student(0);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//print out the info

$del = isset($_GET['del']) ? $_GET['del'] : false;
$msg1 = '';
$msg2 = '';
if($del == 'true' ){ //delete the payment
	$msg1 = "<p style='color:red'>Delete The current payment.</p>";
	$msg2 = '	<a  class="-button red"  onclick="delPayment(' . $id . ')" >Delete</a>';

}else{
	$msg1 = "<p style='color:red'>Edit The current payment.</p>";
	$msg2 = '	<a  class="-button orange"  onclick="edPayment(' . $id . ')" >Update</a>';
	
//edit must be in the form of a form
echo 
"
<center>
$msg1
<table style='color: black;'>
<tr>
<td><b>Name: </b></td>
<td><input type=text disabled=true value=\"{$info['name']} {$info['year']}/{$info['term']}\" /></td>
</tr>
<tr>
<td><b>* Amount: </b></td>
<td><b><input type=text id=\"e_new_amount\"  value=\"{$info['amount']}\" /></td>
</tr>
<tr>
<td><b>* Receipt: </b></td>
<td><input type=text value=\"{$info['receipt']}\" id=\"e_new_receipt\" /></td>
</tr>
<tr>
<td><b>Date Paid: </b></td>
<td><input type=text disabled=true value=\"{$info['date']}\" /></td>
</tr>
</table>
<br />
$msg2 
<a onclick='getStudentRecord();' >BACK</a>
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
<a onclick='getStudentRecord();' >BACK</a>
</center>
";

//echo $data;	
}
if( $type == 'del_payment'){
$st = new Student(0);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//ok so it exists now we must delete if

if( $p->deletePayment($id) ){
	$au = new Auditor();
	$au->add("DELETE" , "Deleted payment " . print_r($info) );
die("<center><h2 style='color: red;' >Payment has been removed<br /></h2><a onclick='getStudentRecord();' >BACK</a></center>");	
}else{
	
die('Failed to delete record from database');	
}
	
	
	
}	
if( $type == 'edit_payment'){
	
if( (! isset($_GET['amount'])) or (! isset($_GET['receipt'])) ){
	
die("Invalid number of arguments passed");	
}
	
$st = new Student(0);
$p = new Payment($st);	

$info = $p->getPaymentByDbID($id);

if( ! $info )die('THe payment you have specified is invalid');	
//ok so it exists now we must update it
$amount = (int)$_GET['amount'];
$receipt = $_GET['receipt'];

//now update db
$au = new Auditor();
if( $p->editPayment($id , 'amount' , $amount) )
if( $p->editPayment($id , 'receipt' , $receipt) ){
$au->add("UPDATE" , "Changed payment record {$info['name']} [{$info['receipt']}][{$info['amount']}] to  $amount , $receipt" )	;

die("<center><h2 style='color: green;' >Payment has been updated<br /></h2><a onclick='getStudentRecord();' >BACK</a></center>");	
	
}
die("<center><h2 style='color: red;' >Failed to update one or more entries, Check for updates<br /></h2><a onclick='getStudentRecord();' >BACK</a></center>");	

}

if( $type == 'edit_enroll_1' ){
//first 
$check = array('pri_sch' , 'id' , 'm_u' , 'l_u' , 'e_u' , 'gp_u');	
foreach( $check as $k){
if( ! isset($_GET[$k]) )die('Invalid number of arguments passed');	
	
}
	
//all variables exist

//now to update the database
$eng = $_GET['e_u'];
$gp = $_GET['gp_u'];
$lang = $_GET['l_u'];
$math = $_GET['m_u'];
$tot = $eng + $gp + $lang + $math;
$pri = $_GET['pri_sch'];

if( strlen($pri) < 5){
die("PLease enter a valid primary school");	
}
if( $tot > 36){
	
die("Student units cannot exceed 36");	
}



$sql = "UPDATE enroll_info_form1 
SET maths_units = $math , english_units = $eng ,content_units = $gp , language_units = $lang , primary_school = \"$pri\" , total_units = $tot 
    WHERE id = \"$id\" ";

$res = mysql_query($sql);

if( ! $res){
die("<center><h1 style='color: red;'>Failed to update database</h1><a onclick='getStudentRecord();' >BACK</a></center>");	
} 
	
//done :)	

die("<center><h1 style='color: green;' >Enrollment Details Updated !</h1><a onclick='getStudentRecord();' >BACK</a></center>");
}

?>