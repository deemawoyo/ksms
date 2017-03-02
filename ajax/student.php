<?php
//first return student info
require_once("../configuration.php");
require_once("../php/database.php");
require_once("../php/student.php");
require_once("../php/age.php");
require_once("../php/student.php");
require_once("../php/payment.php" );
require_once("../php/class.php");
require_once("../php/contact.php");

$db->connect();

//this function will for exampple convert superflous to superfl... if superflous is passed as an 
//argument and length is set to 7
function make_short($string , $length = 50 ){

if ( strlen($string) > $length ){

return substr($string , 0 ,  $length   ) . "..."; 
}
return $string;
}

if(isset($_GET['id']) and isset($_GET['type'] ) ){




$id = $_GET['id'];
$type = $_GET['type'];


$student = new Student($id);
if(! $student->populate() )die ("<b style='color: red;'>No student selected !</b>");  
if( $type == 'info'){
$c = new StudentContact($student);
$p = new Payment($student );

if(! $p->populate() ) die("Failed to populate payment structure" );
$addr = "";
$phone = "";

if( ! $c->populate() ){
$addr = "<b>N/A</b>";
$phone = "<b>N/A</b>"; 
}else {
$addr = make_short($c->home_addr , 40);
$phone = $c->home_phone;
}

$fullname = $student->firstname . " ". $student->middlename . " " . $student->lastname;
$sc = new SchoolClass($student);
$class = "Not Enrolled";
if(  $sc->populate() ){
$class = $sc->form + " " + $sc->_class;
}
$a = new Age($student->dob);
$age = $a->getAge();
$gender = $student->sex;
$is_paid = "No";
$paid_color = "red";
$owed = $p->getTotalAmountOwed();
$year =  $student->year_enrolled;
if(  $owed <= 0.00 ){
$is_paid = "Yes";
$paid_color = "green";
}

//before we print the info we need to shorten the strings so only a maximum number of
//characters is shown at a time.

print "	<h3>Info:</h3>
		<b style=\"color: silver;\">FullName: </b><a style=\"color:black;\" >$fullname</a>
		<b style=\"color: silver;\">Enrolled:&nbsp;&nbsp;&nbsp;&nbsp;</b><a style=\"color: black;\" >$year</a><br/>
		<b style=\"color: silver;\">Sex:</b><a style=\"color: black;\" >$gender</a>
		<b style=\"color: silver;\">Age:</b><a style=\"color: black;\" >$age</a><br />
		<b style=\"color: silver;\">I.D: </b> <a style=\"color: black;\" >$id</a><br/>
		<br />
		<b style=\"color: silver;\">Home Address</b> <a style=\"color: black;\" >$addr</a><br/>
		<b style=\"color: silver;\">Home Phone </b> <a style=\"color: black;\" >$phone</a>
		<br/>
		<b style=\"color: silver;\">Fully Paid: </b> <a style=\"color: $paid_color;\" >$is_paid</a>
		<b style=\"color: silver;\">Amount Owed: </b> <a style=\"color: red;\" >$ $owed</a>
		</div>
		";
		


}else if($type == 'info_remove'){
$fullname = $student->firstname . " ". $student->middlename . " " . $student->lastname;
$year =  $student->year_enrolled;
$gender = $student->sex;
$a = new Age($student->dob);
$age = $a->getAge();

print "	
		<b style=\"color: silver;\">FullName: </b><a style=\"color:black;\" >$fullname</a>
		<b style=\"color: silver;\">Enrolled:&nbsp;&nbsp;&nbsp;&nbsp;</b><a style=\"color: black;\" >$year</a><br/>
		<b style=\"color: silver;\">Sex:</b><a style=\"color: black;\" >$gender</a>
		<b style=\"color: silver;\">Age:</b><a style=\"color: black;\" >$age</a><br />
		<b style=\"color: silver;\">I.D: </b> <a style=\"color: black;\" >$id</a><br/>
		<br />
		
<a  class=\"-button red\"  onclick=\"removeStudent(0);\" >Remove Student</a>
		
		";
	
}



}






?>
