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
require_once('../../../configuration.php');

//first undefine paths


//require_once('../../../php/html2fpdf.php');
require_once('../../../php/student.php');
require_once('../../../php/class.php');

require_once('../../../php/payment.php');
require_once('../../../php/database.php');
//include script to generate pdf

//payment db id must be set

$range_lo = isset( $_GET['r_lo']) ? $_GET['r_lo'] : date('Y-m-d');
$range_hi = isset( $_GET['r_hi'] ) ? $_GET['r_hi'] : date('Y-m-d');

$db->connect();


//print out the select print options page

$sql = "SELECT id , type , amount , for_year , for_term , date_paid FROM payment WHERE ( date_paid LIKE \"{$range_lo}%\" OR date_paid LIKE \"{$range_hi}%\" ) ";

$res = mysql_query($sql );

$count = mysql_affected_rows();   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN" "http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!--This file was converted to xhtml by LibreOffice - see http://cgit.freedesktop.org/libreoffice/core/tree/filter/source/xslt for the code.-->
<head profile="http://dublincore.org/documents/dcmi-terms/">
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>

<title xml:lang="en-US">
<?php

echo "KSMS Auditor Log [ $range_hi ] | {$config->school_name} ";  
?>
</title>

<meta name="DCTERMS.title" content="" xml:lang="en-US"/><meta name="DCTERMS.language" content="en-US" scheme="DCTERMS.RFC4646"/><meta name="DCTERMS.source" content="http://xml.openoffice.org/odf2xhtml"/><meta name="DCTERMS.issued" content="2016-03-03T19:37:50.569223967" scheme="DCTERMS.W3CDTF"/><meta name="DCTERMS.modified" content="2016-03-03T19:48:23.109551102" scheme="DCTERMS.W3CDTF"/><meta name="DCTERMS.provenance" content="" xml:lang="en-US"/><meta name="DCTERMS.subject" content="," xml:lang="en-US"/><link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" hreflang="en"/><link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" hreflang="en"/><link rel="schema.DCTYPE" href="http://purl.org/dc/dcmitype/" hreflang="en"/><link rel="schema.DCAM" href="http://purl.org/dc/dcam/" hreflang="en"/><style type="text/css">
	@page {  }
	table { border-collapse:collapse; border-spacing:0; empty-cells:show }
	td, th { vertical-align:top; font-size:12pt;}
	h1, h2, h3, h4, h5, h6 { clear:both }
	ol, ul { margin:0; padding:0;}
	li { list-style: none; margin:0; padding:0;}
	<!-- "li span.odfLiEnd" - IE 7 issue-->
	li span. { clear: both; line-height:0; width:0; height:0; margin:0; padding:0; }
	span.footnodeNumber { padding-right:1em; }
	span.annotation_style_by_filter { font-size:95%; font-family:Arial; background-color:#fff000;  margin:0; border:0; padding:0;  }
	* { margin:0;}
	.P1 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; font-weight:bold; }
	.P2 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; text-decoration:underline; font-weight:bold; }
	.P3 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.P4 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; }
	.P5 { font-size:12pt; font-family:Liberation Serif; writing-mode:page; text-align:center ! important; font-weight:bold; }
	.Table1 { width:6.6931in; float:none; }
	.Table2 { width:6.6931in; float:none; }
	.Table1_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table1_A2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table1_D1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table1_D2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-width:thin; border-right-style:solid; border-right-color:#000000; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table2_A1 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-width:thin; border-top-style:solid; border-top-color:#000000; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table2_A2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-style:none; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table2_B1 { padding:0.0382in; border-width:thin; border-style:solid; border-color:#000000; }
	.Table2_B2 { padding:0.0382in; border-left-width:thin; border-left-style:solid; border-left-color:#000000; border-right-width:thin; border-right-style:solid; border-right-color:#000000; border-top-style:none; border-bottom-width:thin; border-bottom-style:solid; border-bottom-color:#000000; }
	.Table1_A { width:1.6736in; }
	.Table2_A { width:1.6736in; }
	.Table2_B { width:5.0201in; }
	<!-- ODF styles with no properties representable as CSS -->
	 { }
	</style>
	</head>
	<body dir="ltr" style="max-width:8.2681in;margin-top:0.7874in; margin-bottom:0.7874in; margin-left:0.7874in; margin-right:0.7874in; writing-mode:lr-tb; ">
	<p class="P1"><?php echo $config->school_name; ?></p><p class="P1"><?php echo $config->school_motto; ?>
	</p><p class="P1"> </p>
	<p class="P1">Payments received and recorded by KSMS from
	 <?php echo $range_lo; ?> to <?php echo $range_hi; ?></p>
	 <p class="P1"> </p><p class="P2">
	 NB: This report contains payments made BEFORE <?php echo date('r'); ?> ONLY.</p>
	 <p class="P1"> 
	 </p>
	 <table border="0" cellspacing="0" cellpadding="0" class="Table1">
	 <colgroup><col width="186"/>
	 <col width="186"/><col width="186"/><col width="186"/></colgroup>
	 <tr><td style="text-align:left;width:1.6736in; " class="Table1_A1">
	 <p class="P5">Student </p></td>
	 <td style="text-align:left;width:1.6736in; " class="Table1_A1">
	 <p class="P5">Name</p></td>
	 <td style="text-align:left;width:1.6736in; " class="Table1_A1">
	 <p class="P5">Year/Term</p></td>
	 <td style="text-align:left;width:1.6736in; " class="Table1_D1">
	 <p class="P5">$ Amount</p></td></tr>
	 
	 
<?php	 
	 //start priniting out payments made that particular day
	 $summation = 0.00;
for( $x = 0; $x < $count ; $x++ ){
	$row = mysql_fetch_row($res);
	$summation += floatval($row[2]);
	$amount = formatMoney( $row[2] );
	$st = new Student( $row[0]);
	$st->populate();
	$sc =  new SchoolClass($st );
	$sc->populate();
	$class = $sc->form . " " . $sc->_class;
	$sp = new Payment($st);
	$name = $sp->getTypeInfo( $row[1])['name'];
	$year = $row[3];
	$term = $row[4];
	
	
	echo " 
	 <tr><td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A2\">
	 <p class=\"P4\">{$st->fullname} [ $class ]</p>
	 <p class=\"P4\">[ {$st->school_id} ]</p>
	 </td><td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A2\">
	 <p class=\"P4\">$name</p>
	 </td><td style=\"text-align:left;width:1.6736in; \" class=\"Table1_A2\">
	 <p class=\"P4\">$year / $term</p></td>
	 <td style=\"text-align:left;width:1.6736in; \" class=\"Table1_D2\">
	 <p class=\"P4\">$amount</p></td></tr>
	 ";
	 
}
?>	 
	 
	 </table>
	 <p class="P1"> </p><p class="P1"> </p>
	 <p class="P1">Payments Summary</p>
	 <table border="0" cellspacing="0" cellpadding="0" class="Table2">
	 <colgroup><col width="186"/><col width="557"/></colgroup>
	 <tr><td style="text-align:left;width:1.6736in; " class="Table2_A1">
	 <p class="P5">Number of Payments</p></td>
	 <td style="text-align:left;width:5.0201in; " class="Table2_B1">
	 <p class="P5">Total Received $</p></td></tr>
	 <tr><td style="text-align:left;width:1.6736in; " class="Table2_A2">
	 <p class="P3"><?php echo $count; ?></p></td>
	 <td style="text-align:left;width:5.0201in; " class="Table2_B2">
	 <p class="P3"><?php echo "$ " . formatMoney($summation) ; ?> </p></td></tr></table><p class="P1"> </p></body></html>

