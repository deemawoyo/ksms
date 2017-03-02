<?php
/*******************************************************************************
Author: Delight Mawoyo

Name: HTML Report Printer for Class List , Student Info , Students Owing list 

Description: Modular programming employed along with OOP

NB: Must have included configuration.php 
*********************************************************************************/
require_once("configuration.php");
require_once("php/html2fpdf.php");
require_once("php/database.php");
require_once("php/student.php");
require_once("php/class.php");
require_once("php/contact.php");
require_once("php/payment.php");
require_once("php/age.php");


//must connect to db

/**
 * Function prints out students information. If verbose is stated then all RELEVANT
  *info is printed.
*/  
class Report{

private $config;

public function __construct($cfg){
$this->config = $cfg;
}



public function printStudentInfo($id , $verbose = false ){
$st = new Student($id);
if( ! $st->populate() )return false; //student does not exist
$sc = new SchoolClass($st);
$sc->populate();
$sct = new StudentContact($st);
$sct->populate();
$sp = new Payment($st);
$sp->populate();

$o_bool = "No";
$o_color = "red";

$amount_owed =  $sp->getTotalAmountOwed();
if( ! $amount_owed ){
$o_bool = "Yes";
$o_color = "green";
}

$form = $sc->form;
$class = $sc->_class;

$fullname = $st->firstname . " " . $st->middlename . " " . $st->lastname;
//set report filename
$_SESSION['report_name'] = "$fullname $form $class Info " . date('Y-m-d');

$a = new Age($st->dob);
$age = $a->getAge();

$sname = $this->config->school_name;
$smotto = $this->config->school_motto;

$l_info = $sp->getLastPaid();
$payment_name = $l_info['type_name'];

$st_info = "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<HTML>
<HEAD>
	<META HTTP-EQUIV=\"CONTENT-TYPE\" CONTENT=\"text/html; charset=utf-8\">
	<TITLE></TITLE>
	<META NAME=\"GENERATOR\" CONTENT=\"King's School Management System\">
	<META NAME=\"AUTHOR\" CONTENT=\"King's School Management System\">
	<TITLE> $sname </TITLE>
</HEAD>
<BODY LANG=\"en-US\" DIR=\"LTR\">
<H1 ALIGN=CENTER>{$sname}</H1>
<P ALIGN=CENTER><B>Student Details For $fullname</B> 
</P>
<P><U><B>Basic Details</B></U></P>
<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE=\"page-break-inside: avoid\">
	<COL WIDTH=128*>
	<COL WIDTH=128*>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>Fullname:</B>       $fullname</P>
		</TD>
		<TD WIDTH=50% STYLE=\"border: 1px double #808080; padding: 0.04in\">
			<P><B>Form</B>        $form $class</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>D.O.B: </B>          {$st->dob}</P>
		</TD>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P><B>Age:</B>         $age               <B>Sex:</B> {$st->sex}</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>I.D Number:</B>   {$st->id}/P>
		</TD>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P><B>Enrolled:</B>  {$st->year_enrolled}  
			</P>
		</TD>
	</TR>
</TABLE>
<P><BR><BR>
</P>
<P><U><B>Contact Details</B></U></P>
<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE=\"page-break-inside: avoid\">
	<COL WIDTH=128*>
	<COL WIDTH=128*>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>Address: </B><SPAN STYLE=\"font-weight: normal\">{$sct->home_addr}</SPAN></P>
		</TD>
		<TD WIDTH=50% STYLE=\"border: 1px double #808080; padding: 0.04in\">
			<P><B>Phone: </B><SPAN STYLE=\"font-weight: normal\"> {$sct->home_phone}</SPAN></P>
		</TD>
	</TR>
</TABLE>
<P><BR><BR>
</P>
<P><U><B>Payment Summary</B></U></P>
<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE=\"page-break-inside: avoid\">
	<COL WIDTH=128*>
	<COL WIDTH=128*>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>Amount Owed(as of 2012-02-13 )</B>  $ $amount_owed</P>
		</TD>
		<TD WIDTH=50% STYLE=\"border: 1px double #808080; padding: 0.04in\">
			<P><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P><B>Last Payment:</B> $payment_name( {$l_info['date_paid']} )</P>
		</TD>
		<TD WIDTH=50% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P><B>Amount:</B>  $ {$l_info['amount']}</P>
		</TD>
	</TR>
</TABLE>
<P><BR><BR>
</P>
<P><BR><BR>
</P>

</BODY>
</HTML>
";


return $st_info;
}




public function printStudentPaymentInfo($id ){
$st = new Student($id);
if( ! $st->populate() )return false; //student does not exist
$sc = new SchoolClass($st);
$sc->populate();
$sct = new StudentContact($st);
$sct->populate();
$sp = new Payment($st);
$sp->populate();
$owing = "Yes";
$owing_color = "red";
$amount_owed =  $sp->getTotalAmountOwed();
if(  $amount_owed  ){
$owing = "No";
$owing_color = "green";
}

$form = $sc->form;
$class = $sc->_class;

$fullname = $st->firstname . " " . $st->middlename . " " . $st->lastname;
//set report filename
$_SESSION['report_name'] = "Payment Report for $fullname $form $class as of " . date('Y-m-d');

$a = new Age($st->dob);
$age = $a->getAge();

$sname = $this->config->school_name;
$smotto = $this->config->school_motto;

$l_info = $sp->getLastPaid();
$payment_name = $l_info['type_name'];


$data = "

<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
<title>Payment Info</title>
<meta name=\"generator\" content=\"Bluefish 1.0.7\">
<meta name=\"author\" content=\"root\">
<meta name=\"date\" content=\"2013-12-13T13:15:24+0200\">
<meta name=\"copyright\" content=\"\">
<meta name=\"keywords\" content=\"\">
<meta name=\"description\" content=\"\">
<meta name=\"ROBOTS\" content=\"NOINDEX, NOFOLLOW\">
<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
<meta http-equiv=\"content-type\" content=\"application/xhtml+xml; charset=UTF-8\">
<meta http-equiv=\"content-style-type\" content=\"text/css\">
<meta http-equiv=\"expires\" content=\"0\">
<meta http-equiv=\"refresh\" content=\"5; URL=http://\">
<style>

</style>
<script type=\"text/javascript\">
<!--

// -->
</script>
</head>
<body>
<center><h2>{$sname}</h2></center>
<h2>Basic Details</h2>
<table cellpadding=\"5\" cellspacing=\"5\" align=\"center\" bgcolor=\"#FFFFFF\" width=\"100%\">
<tr>
<td><b>Fullname</b></td>
<td>$fullname</td>
<td><b>Sex</b></td>
<td>$st->sex</td>
</tr>
<tr>
<td><b>Class</b></td>
<td>$form $class</td>
</tr>
</table>
<h2>Summary</h2>
<table style=\"padding-top: 10px;\" border=\"4\" cellpadding=\"5\" cellspacing=\"5\"  align=\"center\" bgcolor=\"#FFFFFF\" width=\"100%\">
<tr>
<td><b>Fully paid</b></td>
<td><i style=\"color: $owing_color;\">$owing</i></td>
</tr>
<tr>
<td><b>Amount Owed</b></td>
<td>$ $amount_owed</td>
</tr>
<tr>
<td><center><b>Latest Payment Info</b></center></td>
</tr>
<tr>
<td><b>Amount Paid</b></td>
<td>$ {$l_info['amount']}</td>
</tr>
<tr>
<td><b>Payment Name</b></td>
<td>$payment_name</td>
</tr>
<tr>
<td><b>Date Paid</b></td>
<td>{$l_info['date_paid']}</td>
</tr>
</table>
<h2>Owing</h2>
<table style=\"padding-top: 10px;\" border=\"4\" cellpadding=\"5\" cellspacing=\"5\"  align=\"center\" bgcolor=\"#FFFFFF\" width=\"100%\">
<tr >
<td><b>Name</b></td>
<td><b>Year</b></td>
<td><b>Term</b></td>
<td><b>Amount $</b></td>
</tr>
";
//start printingg pasyments owed

$total_owed = $sp->getTotalAmountOwed();
$count_p = 0;

if( floatval($total_owed) != 0.00 ){

$num = sizeof( $sp->pay_list );
for( $x = 0; $x < $num ; $x++ ){
	//now check if student has fully paid that type
	//only show less than 10
	
	
	$value = $sp->pay_list[$x]['amount'];
	$name = $sp->pay_list[$x]['name'];
	$year = $sp->pay_list[$x]['year'];
	$term = $sp->pay_list[$x]['term'];	
	$type = $sp->pay_list[$x]['type'];
	$bool = formatMoney( $sp->getAmountOwed( $type ) );
	if( $bool == '0.00' )continue;
	$data .= "
	<tr>
	<td>$name</td>
	<td>$year</td>
	<td>$term</td>
	<td>$ $bool </td>
	</tr>
	
	"	;
	$count_p++; 
}



}


$sql = "SELECT type, for_year , for_term , amount , receipt, date_paid FROM payment WHERE (id = \"$st->id\" ) ORDER BY date_paid DESC LIMIT 10";
$res = mysql_query($sql);
if( mysql_affected_rows() ){
$data .= "</table>

<h2>Payments Received</h2>
<table style=\"padding-top: 10px;\" border=\"4\" cellpadding=\"5\" cellspacing=\"5\"  align=\"center\" bgcolor=\"#FFFFFF\" width=\"100%\">
<tr >
<td><b>Name</b></td>
<td><b>Year</b></td>
<td><b>Term</b></td>
<td><b>Amount $</b></td>
<td><b>Receipt</b></td>
<td><b>Date Paid</b></td>
</tr>
";

$count = mysql_affected_rows();
for($x = 0 ; $x < $count ; $x++ ){
$arry = mysql_fetch_row($res);
$pname_a = $sp->getTypeInfo( $arry[0] );
$pname = $pname_a['name'];
$data .= "
<tr >
<td><b>$pname</b></td>
<td><b>{$arry[1]}</b></td>
<td><b>{$arry[2]}</b></td>
<td><b>$" . formatMoney( $arry[3] ) . "</b></td>
<td><b>{$arry[4]}</b></td>
<td><b>{$arry[5]}</b></td>
</tr>
";

}


$data .= "
</table>

";
}
$data .= "
<p>NB: Only the last <b>10</b> received payments are shown.And <b>all</b> owed payments are shown  </p>
</body>
</html>
";

return $data;
}

public function printClassList($form , $class , $verbose = false ){
	
$id = 0;
$student = new Student($id);

$sc = new SchoolClass($student );

$res = $sc->getClassStudents($form , $class ); 
if( ! $res )return "<h1>INVALID CLASS/ NO RECORDS EXIST IN DATABASE YET !</h1>";

//start printing out class list
$y  = sizeof($res);
//set report filename
$_SESSION['report_name'] = "Class List for $form $class as of " . date('Y-m-d');

$sch = $this->config->school_name;
$data = "
<html>
<head>
<title>Class list for Form $form $class ({$config->year})</title>
</head>
<body>
<center><h1>$sch $form $class ({$config->year})</h1></center>
<table>
<tr>
<td><b>$y</b></td>
<td><b>Students </b></td>

</tr>
</table>
<table cellpadding=\"4\" cellspacing=\"4\" border=\"0\"  width=\"100%\" frame=\"vsides\" rules=\"all\">
<tr>

<td><b>Full Name</b></td>
<td><b>Age</b></td>
<td><b>Gender</b></td>
</tr>

";

//we need to sort students by name

//the array below will contain all the student data before it is sorted and printed
$student_data[0]['fullname']  = 0;

for($x = 0 ; $x < $y ; $x++ ){
$student->id = $res[$x];
if( ! $student->populate() )continue; //failed to populate
$fullname = $student->firstname . " " . $student->middlename . " " . $student->lastname;
$a = new Age($student->dob);
$age = $a->getAge();
$sex = $student->sex;
$student_data[$x]['fullname'] = $fullname;
$student_data[$x]['age'] = $age;
$student_data[$x]['sex'] = $sex;
}

//now sort the array 
//@todo Add code to sort data


for($x = 0 ; $x < $y ; $x++ ){
$fullname = $student_data[$x]['fullname'] ;
$age = $student_data[$x]['age'];
$sex = $student_data[$x]['sex'] ;

$data .=  "<tr>
<td>$fullname</td>
<td><b>$age</b></td>
<td><b>$sex</b></td>
</tr>
";
}

$data .= "
</table>
</body>
</html>";

return $data;



}


public function printLast100Payments(  $today = 0){
if(! $today )
$today = date("Y-m-d h:m:s");
$sch = $this->config->school_name;
//set report filename
$_SESSION['report_name'] = "Last 100 payments as of " . date('Y-m-d');

$data = "<html><head><title>Last 100 payments </title></head>
<body>
<center><h1>$sch <br /> Last 100 Payments <br/>As of $today </h1></center>
";

$sql = "SELECT id , amount , receipt , for_year , for_term , type , date_paid FROM payment  ORDER BY date_paid DESC LIMIT 100";
$res = mysql_query($sql);
if( ! $res ){
return "Query failed";
}
$num = mysql_affected_rows();
if(! $num ){
$data .= "<h1><center>No payment issued Today ! .</center></h1> ";
}


$data .= "
<table cellpadding=\"4\" cellspacing=\"4\" border=\"0\"  width=\"100%\" frame=\"vsides\" rules=\"all\">

<tr>
<td><b>Student Name</b></td>
<td><b>Payment </b></td>
<td> <b>Year /Term </b></td>
<td> <b>Receipt </b></td>
<td><b>Amount </b></td>
<td> <b> Date</b></td>
</tr>

";
for( $x = 0; $x < $num ; $x++ ){
$arry = mysql_fetch_row($res);
$st = new Student($arry[0] );
$st->populate();
$fullname = $st->firstname . " " . $st->middlename . " " . $st->lastname;
$p = new Payment($st);
$n = $p->getTypeInfo($arry[5] );
$name = $n['name'];
$amount = $arry[1];
$receipt = $arry[2];
$year = $arry[3];
$term = $arry[4];
$when = $arry[6];
$sc = new SchoolClass($st);
$sc->populate();
$form = $sc->form . " " . $sc->_class; 
$data .= "
<tr>
<td>$fullname ($form)</td>
<td>$name </td>
<td> $year / $term </td>
<td> $receipt </td>
<td><b>$</b> $amount </td>
<td> $when </td>
</tr>
";

}
$data .= "</table></body> </html>";
return $data;
}


public function printStudentsOwingList($class = "all" ){
//very complex code :(
$today = date("Y-m-d");
$sch = $this->config->school_name;
//set report filename
$_SESSION['report_name'] = "Unpaid Students as of " . date('Y-m-d');
$data = "<html>
<head><title>List of unpaid students </title></head>
<body>
<center><h1>$sch <br /> Unpaid students <br/>As of $today </h1></center>

";
//owing list will contain list of students owing money

//$all_students = 0;
if( $class == "all" ){

$sc = new SchoolClass(0);

for( $x = 1; $x <= $this->config->max_form ; $x++ ){
$classes = $sc->getClassList($x);
$data .= "<h1>Form $x </h1>";
$size = sizeof($classes);
	for($y = 0; $y < $size ; $y++ ){
//get all students in that class

//check if the class has any students owing money before printing out form
$has_owing = false;
$stud_list = $sc->getClassStudents( $x , $classes[$y] );  
//now loop again!!!!!!!!! to print out student info :)
$stud_size = sizeof($stud_list);
			for( $z = 0; $z < $stud_size ; $z++ ){
				//get student
				$st = new Student( $stud_list[$z] );
				if( ! $st->populate() )continue;
				//$st->populate();
				//create a payments structure
				$sp = new Payment($st);
				//now check for how mush the student owes
				
				if(! $sp->populate() )continue;
				$owed = $sp->getTotalAmountOwed();
				
if(  $owed > 0 ){

if( ! $has_owing ){
$data .= "<center><b>$x {$classes[$y] } List</b></center>
<table cellpadding=\"4\" cellspacing=\"4\"   width=\"100%\" frame=\"vsides\" style=\"padding-bottom: 10px;\" rules=\"all\">

<tr>
<td><b>Full Name</b></td>
<td><b>Amount Owed</b></td>
</tr>

";
$has_owing = true;
}
$name= $st->firstname . " " . $st->middlename . " " . $st->lastname;
$owed = formatMoney($owed);
$data .= "
<tr>
<td>$name</td>
<td><b>$</b>$owed</td>
</tr>
";
$owed = 0;
}

}

$data .= "</table><br />";

}


}

}

return $data;
}
//send output as pdf file to browser
public function sendPDF($data ){

$pdf=new HTML2FPDF();

$pdf->AddPage();

$data .= "<html><P ALIGN=CENTER><U><B>Generated using <a>King's School Management System (c) 2016</a></B></U></P></html>";


$pdf->WriteHTML($data);

$pdf->Output("php/temp/buffer.pdf");
//open file for reading
$fh = fopen("php/temp/buffer.pdf" , "r");
$fsize = filesize("php/temp/buffer.pdf");
$fdata = fread( $fh , $fsize);
//close the file
fclose($fh);
$report_name = isset($_SESSION['report_name'] ) ? $_SESSION['report_name'] : "KSMS Report";

//empty file
//send headers

$headers = array(
"Server: King's School Management System"

,"Content-Transfer-Encoding: binary"
,"Content-Disposition: filename=\"$report_name.pdf\""
,"Expires: 0"
,"Cache-Control: must-revalidate, post-check=0, pre-check=0"
,"Pragma: public"
,"Content-Length: $fsize"
,"Connection: close"
,"Content-Type: application/pdf"
);
foreach( $headers as $v ){
header($v);
} 
print $fdata;

}

};

//test code
$db->connect();
$rep = new Report($db->config);

//some page already generated the html and wants to print out
if( isset($_SESSION['to_pdf_data'] ) ){
$data = $_SESSION['to_pdf_data'];
//works only once
unset( $_SESSION['to_pdf_data'] );

$rep->sendPDF(  $data );

}

if( ! isset($_GET['action'] ) )exit;
$action = $_GET['action'];
$id = 0;
if(isset($_SESSION['student_id'] ) )
$id = $_SESSION['student_id'] ;

$is_pdf = 0;
if(isset($_GET['pdf'] ) )
$is_pdf = $_GET['pdf'];

$data = "";

switch($action){
	case "student" :
	
	$data = $rep->printStudentInfo($id);
	
	break;
	case "student_payment":
	
	$data = $rep->printStudentPaymentInfo($id);
	
	break;
	case "last100":
	$data = $rep->printLast100Payments();
	
	break;
	case "owinglist":
		$data = $rep->printStudentsOwingList();
	
	break;
	case "class_list":
	$form = $_GET['form'];
	$class = $_GET['class'];
	$data = $rep->printClassList($form , $class);
	
	break;
	default:
	die("<h1>Error</h1>");
	break;
	
}
if($is_pdf ){
	$rep->sendPDF($data);
	}else{
	
	print $data;
}
exit;
?>
