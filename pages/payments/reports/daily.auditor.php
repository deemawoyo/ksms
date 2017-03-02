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

$range = isset( $_GET['range']) ? $_GET['range'] : date('Y-m-d');
//$range_hi = isset( $_GET['r_hi'] ) ? $_GET['r_hi'] : date('Y-m-d');

$db->connect();


//print out the select print options page

$sql = "SELECT a_when , action , value , user  FROM auditor WHERE ( a_when LIKE \"{$range}%\" ) ORDER BY a_when DESC ";

$res = mysql_query($sql );

$count = mysql_affected_rows();   

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE>KSMS Auditor Logs [<?php echo $range; ?>] </TITLE>
	<meta name="generator" content="Bluefish 2.2.3" >
	<META NAME="CREATED" CONTENT="20160304;164133599369611">
	<META NAME="CHANGED" CONTENT="20160304;170512097143716">
</HEAD>
<BODY LANG="en-US" DIR="LTR">
<P ALIGN=CENTER><B><?php echo $config->school_name; ?></B></P>
<P ALIGN=CENTER><B><?php echo $config->school_motto; ?></B></P>
<P ALIGN=CENTER><B>KSMS Auditor Logs for <?php echo $range; ?> generated on  [ <?php echo date('r'); ?>
] </B>
</P>
<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-before: auto; page-break-inside: avoid">
	<COL WIDTH=52*>
	<COL WIDTH=109*>
	<COL WIDTH=34*>
	<COL WIDTH=61*>
	<TR VALIGN=TOP>
		<TD WIDTH=20% STYLE="border-top: 1px double #808080; border-bottom: none; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Action</B></P>
		</TD>
		<TD WIDTH=43% STYLE="border-top: 1px double #808080; border-bottom: none; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Comment</B></P>
		</TD>
		<TD WIDTH=13% STYLE="border-top: 1px double #808080; border-bottom: none; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>User </B>
			</P>
		</TD>
		<TD WIDTH=24% STYLE="border-top: 1px double #808080; border-bottom: none; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.04in; padding-right: 0.04in">
			<P ALIGN=CENTER><B>Time </B>
			</P>
		</TD>
	</TR>
<?php
	

for( $x = 0; $x < $count ; $x++ ){
	$row = mysql_fetch_row($res);
 $action = $row[1];
 $comment = $row[2];
 $time = $row[0];
 $user = $row[3];
	
	echo "	
	<TR VALIGN=TOP>
		<TD WIDTH=20% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>
			$action
			<BR>
			</P>
		</TD>
		<TD WIDTH=43% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>$comment<BR>
			</P>
		</TD>
		<TD WIDTH=13% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER STYLE=\"margin-left: 0.04in; margin-right: 0.03in; text-indent: -0.04in\">
			$user
			<BR>
			</P>
		</TD>
		<TD WIDTH=24% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P ALIGN=CENTER>
			$time<BR>
			</P>
		</TD>
	</TR>
	";
	

}	
?>	
	
</TABLE>
<P ALIGN=CENTER><BR><BR>
</P>
<P ALIGN=CENTER><BR><BR>
</P>
<P ALIGN=CENTER><B>NB: This list contains operations processed before
the above stated time. NO action has or can be altered or removed.</B></P>
</BODY>
</HTML>