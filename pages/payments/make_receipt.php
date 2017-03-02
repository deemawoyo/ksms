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

//first undefine paths


//require_once('../../php/html2fpdf.php');
require_once('../../php/student.php');
require_once('../../php/class.php');

require_once('../../php/payment.php');
require_once('../../php/database.php');
//include script to generate pdf

//payment db id must be set


$p_id = isset($_GET['pid']) ? $_GET['pid'] : false;  

if( $p_id == false ){
die('Error encountered. Database Payment ID is not set');
}







$db->connect();

if( ! isset($_GET['exec'] ) ){
//print out the select print options page

?>
<script>

function makePDF( $p_id ){
var url = 'pages/payments/make_receipt.php?exec=html&pdf=true&pid=' + $p_id;

 window.open( url, "Payment Receipt", "menubar=0,location=0,height=700,width=700" );

}

function popupPrint( $p_id ){
var url = 'pages/payments/make_receipt.php?exec=html_print&pid=' + $p_id;

 window.open( url, "Payment Receipt", "menubar=0,location=0,height=700,width=700" );
    
}



</script>
<center>
<h4>Select Print Options</h4>
<?php

echo "
<table style='width: 100%; '>
<tr>

<td>
<center>
<a onclick='popupPrint($p_id);' title='Open interactive print dialog' >
<img src='images/printer64.png' style='width: 64px; height: 64px; cursor: pointer;' />
<br />
<b>
DIRECT
</b>  
</a>
</center>
</td>
</tr>
</table>

";

?>
<?php
exit;
}

$exec = $_GET['exec'];
$pdf = isset($_GET['pdf'] ) ? true : false;

//generate the html form 

$st = new Student($_SESSION['student_id'] );
if( ! $st->populate() ){

die('INvalid student ID passed');
}
$sp = new Payment( $st );
$sp->populate();

$total_amount_owed = formatMoney($sp->getTotalAmountOwed() );
$total_advance = formatMoney( $sp->getTotalAdvancePaymentsPaid() );//$sp->getTotalAdvance();

$last_payment = $sp->getLastPaid();

//now get payment info from database

$pi = $sp->getPaymentByDBID( $p_id );

if( ! $pi ){

die('INvalid Payment');
}


$today = date('Y-m-d');

$name = $pi['name'];
$amount = formatMoney($pi['amount'] );
$date = $pi['date'];
$year = $pi['year'];
$term = $pi['term'];
$receipt = $pi['receipt'];

//get info the payment
$listed_pi = $sp->getTypeInfo( $pi['type'] );
$amount_listed = formatMoney( $listed_pi['amount'] );
$amount_due = formatMoney($sp->getAmountOwed( $pi['type'] ) );



$sc = new SchoolClass( $st );
$sc->populate();
$class = $sc->form . " " . $sc->_class ;



$data =  "


<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN\" \"http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head profile=\"http://dublincore.org/documents/dcmi-terms/\"><meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=utf-8\"/><title xml:lang=\"en-US\">Payment Receipt For {$st->fullname} ( $class )</title><meta name=\"DCTERMS.title\" content=\"\" xml:lang=\"en-US\"/><meta name=\"DCTERMS.language\" content=\"en-US\" scheme=\"DCTERMS.RFC4646\"/><meta name=\"DCTERMS.source\" content=\"http://xml.openoffice.org/odf2xhtml\"/><meta name=\"DCTERMS.creator\" content=\"root \"/><meta name=\"DCTERMS.issued\" content=\"2016-02-09T10:24:00.508014993\" scheme=\"DCTERMS.W3CDTF\"/><meta name=\"DCTERMS.contributor\" content=\"root \"/><meta name=\"DCTERMS.modified\" content=\"2016-02-09T10:45:15.976243689\" scheme=\"DCTERMS.W3CDTF\"/><meta name=\"DCTERMS.provenance\" content=\"\" xml:lang=\"en-US\"/><meta name=\"DCTERMS.subject\" content=\",\" xml:lang=\"en-US\"/><link rel=\"schema.DC\" href=\"http://purl.org/dc/elements/1.1/\" hreflang=\"en\"/><link rel=\"schema.DCTERMS\" href=\"http://purl.org/dc/terms/\" hreflang=\"en\"/><link rel=\"schema.DCTYPE\" href=\"http://purl.org/dc/dcmitype/\" hreflang=\"en\"/><link rel=\"schema.DCAM\" href=\"http://purl.org/dc/dcam/\" hreflang=\"en\"/><style type=\"text/css\">
	@page {  }
	table { border-collapse:collapse; border-spacing:0; empty-cells:show }
	td, th { vertical-align:top; font-size:12pt;}
	h1, h2, h3, h4, h5, h6 { clear:both }
	ol, ul { margin:0; padding:0;}
	li { list-style: none; margin:0; padding:0;}
	<!-- \"li span.odfLiEnd\" - IE 7 issue-->
	li span. { clear: both; line-height:0; width:0; height:0; margin:0; padding:0; }
	span.footnodeNumber { padding-right:1em; }
	span.annotation_style_by_filter { font-size:95%; font-family:Arial; background-color:#fff000;  margin:0; border:0; padding:0;  }
	* { margin:0;}
	.P1 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.P10 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; }
	.P11 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; }
	.P12 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.P13 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; font-weight:bold; }
	.P14 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; font-weight:bold; }
	.P15 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; font-weight:bold; }
	.P16 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.P17 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; font-weight:bold; }
	.P2 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; }
	.P3 { font-size:14pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; text-decoration:underline; font-weight:bold; }
	.P4 { font-size:14pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; text-decoration:underline; font-weight:bold; }
	.P5 { font-size:14pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; text-decoration:underline; font-weight:bold; }
	.P6 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; text-decoration:none ! important; font-weight:normal; }
	.P7 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:left ! important; text-decoration:none ! important; font-weight:bold; }
	.P8 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; text-decoration:none ! important; font-weight:bold; }
	.P9 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.Table1 { width:6.6931in; float:none; }
	.Table2 { width:6.6931in; float:none; }
	.Table3 { width:6.6931in; float:none; }
	.Table4 { width:6.6931in; float:none; }
	.Table5 { width:6.6931in; float:none; }
	.Table1_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table1_D1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table2_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table2_A2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table2_C1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table2_C2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-width:thin; border-right-style:solid; border-right-color:#000000; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table3_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table3_C1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table4_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table4_A2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table4_B1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table4_B2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-width:thin; border-right-style:solid; border-right-color:#000000; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table5_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table5_A2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table5_B1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table5_B2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-width:thin; border-right-style:solid; border-right-color:#000000; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table1_A { width:1.6736in; }
	.Table2_A { width:2.2313in; }
	.Table3_A { width:2.2313in; }
	.Table4_A { width:3.3465in; }
	.Table5_A { width:3.3465in; }
	<!-- ODF styles with no properties representable as CSS -->
	.T1  { }
	</style>
</head>
<body dir=\"ltr\" style=\"max-width:8.2681in;margin-top:0.7874in; margin-bottom:0.7874in; margin-left:0.7874in; margin-right:0.7874in; writing-mode:lr-tb; \">
<p class=\"P4\">{$config->school_name}
<p class=\"P5\">{$config->school_motto}</p>
<p class=\"P1\"> </p><p class=\"P9\">Payment Receipt. Generated {$today}.</p>
<p class=\"P2\"> </p>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"Table1\">
<colgroup><col width=\"186\"/><col width=\"186\"/><col width=\"186\"/><col width=\"186\"/></colgroup>
<tr><td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A1\">
<p class=\"P13\">Receipt Number:</p></td>
<td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A1\"><p class=\"P11\">$receipt</p></td>
<td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A1\">
<p class=\"P13\">Date Paid:</p></td><td style=\"text-align:left;width:1.6736in; \" class=\"Table1_D1\">
<p class=\"P10\"><span title=\"time\">$date</span></p></td></tr></table>
<p class=\"P2\"> </p><p class=\"P2\"> </p>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"Table2\">
<colgroup><col width=\"248\"/><col width=\"248\"/><col width=\"248\"/></colgroup>
<tr><td style=\"text-align:left;width:2.2313in; \" class=\"Table2_A1\">
<p class=\"P14\">Fullname</p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table2_A1\">
<p class=\"P15\"> <span class=\"T1\">Class</span></p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table2_C1\">
<p class=\"P14\">Student ID</p></td></tr><tr>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table2_A2\">
<p class=\"P11\"> {$st->fullname} </p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table2_A2\"><p class=\"P11\"> $class </p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table2_C2\"><p class=\"P10\"> 
<span class=\"T1\">{$st->school_id}</span></p></td></tr>
</table>
<p class=\"P2\"> </p>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"Table3\">
<colgroup><col width=\"248\"/><col width=\"248\"/><col width=\"248\"/></colgroup>
<tr><td style=\"text-align:left;width:2.2313in; \" class=\"Table3_A1\">
<p class=\"P14\">Payment Type:</p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table3_A1\">
<p class=\"P11\">$name</p></td>
<td style=\"text-align:left;width:2.2313in; \" class=\"Table3_C1\">
<p class=\"P10\"> <span class=\"T1\">$year / $term</span></p></td>
</tr></table><p class=\"P2\"> </p><p class=\"P3\">$name $year / $term</p>
<p class=\"P2\"> </p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"Table4\">
<colgroup><col width=\"371\"/><col width=\"371\"/></colgroup>
<tr><td style=\"text-align:left;width:3.3465in; \" class=\"Table4_A1\">
<p class=\"P13\">Amount Listed:</p></td>
<td style=\"text-align:left;width:3.3465in; \" class=\"Table4_B1\"><p class=\"P12\">$ $amount_listed</p></td>
</tr><tr><td style=\"text-align:left;width:3.3465in; \" class=\"Table4_A2\">
<p class=\"P13\">Amount Paid:</p></td>
<td style=\"text-align:left;width:3.3465in; \" class=\"Table4_B2\"><p class=\"P12\">$ $amount</p></td></tr>
<tr><td style=\"text-align:left;width:3.3465in; \" class=\"Table4_A2\">
<p class=\"P13\">Amount Due:</p></td><td style=\"text-align:left;width:3.3465in; \" class=\"Table4_B2\">
<p class=\"P12\">$ $amount_due</p></td></tr></table>
<p class=\"P2\"> </p><p class=\"P3\">Account Summary</p>
<p class=\"P3\"> </p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"Table5\">
<colgroup><col width=\"371\"/><col width=\"371\"/></colgroup>
<tr><td style=\"text-align:left;width:3.3465in; \" class=\"Table5_A1\">
<p class=\"P17\">Total Amount Owed:</p></td>
<td style=\"text-align:left;width:3.3465in; \" class=\"Table5_B1\">
<p class=\"P16\">$ $total_amount_owed</p></td></tr>
<tr><td style=\"text-align:left;width:3.3465in; \" class=\"Table5_A2\">
<p class=\"P17\">Total Advance Payments:</p></td>
<td style=\"text-align:left;width:3.3465in; \" class=\"Table5_B2\">
<p class=\"P16\">$ $total_advance</p></td></tr>

</table>
<p class=\"P6\"> </p><p class=\"P7\"> </p><p class=\"P8\"> </p>
<p class=\"P8\">NB: Receipt is not valid unless it is stamped with {$config->school_name}
 stamp with the date of {$today}. </p><p class=\"P8\"> </p><p class=\"P8\"> </p>
</body>
</html>";

if( $exec == 'html_print' ){
$data .= "
<html>
<script>

window.print();

</script>
";




echo $data;
exit;
}
if( $pdf == true ){
//generate pdf and print 

$_SESSION['to_pdf_data'] = $data;
//now redirect to report.php
header("Location: ../../report.php?id=0");
exit;
}



?>


