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

require_once('../../php/student.php');
require_once('../../php/class.php');
require_once('../../php/database.php');

$db->connect();

if( ! isset($_SESSION['student_id'] ) ){
die('Student id is not set');
}

$st = new Student( $_SESSION['student_id'] );
if( ! $st->populate() ){
die('Invalid student ID passed');
}

$sc = new SchoolClass( $st );
$sc->populate();

$sql = "SELECT action , value , user , a_when FROM auditor WHERE ( value LIKE \"%$st->id%\" ) ORDER BY a_when DESC";
$res = mysql_query( $sql );
$count = mysql_affected_rows();


//now we have all we need , lets print it out


 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.0.4 (Linux)">
	<META NAME="AUTHOR" CONTENT="root ">
	<META NAME="CREATED" CONTENT="20160211;153140372624996">
	<META NAME="CHANGEDBY" CONTENT="root ">
	<META NAME="CHANGED" CONTENT="20160211;154126465588717">
</HEAD>
<BODY LANG="en-US" DIR="LTR">
<P ALIGN=CENTER><FONT SIZE=4 STYLE="font-size: 16pt"><U><B>
<?php echo $config->school_name; ?>
</B></U></FONT>
</P>
<P ALIGN=CENTER><FONT SIZE=4 STYLE="font-size: 16pt"><U><B>Auditor
Logs for <?php echo  $st->fullname; ?> [ <?php echo $sc->form . " " . $sc->_class; ?> ]</B></U></FONT></P>
<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none"><FONT SIZE=3><B>NB:
 This log was generated on <b><?php echo  date('r'); ?></b> and contains ALL actions
performed on the student as recorded into the database. No action can
be or has been altered.</B></FONT></P>
<p>
<h3><?php echo $count; ?> records found</h3>
</p>

<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-inside: avoid">
	<COL WIDTH=39*>
	<COL WIDTH=139*>
	<COL WIDTH=45*>
	<COL WIDTH=32*>
	<TR VALIGN=TOP>
		<TD  STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=LEFT><FONT SIZE=4><B>Action</B></FONT></P>
		</TD>
		<TD WIDTH=54% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: none; border-right: none; padding: 0.04in 0in">
			<P ALIGN=LEFT><FONT SIZE=4><B>Comment</B></FONT></P>
		</TD>
		<TD WIDTH=18% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: none; border-right: none; padding: 0.04in 0in">
			<P ALIGN=LEFT><FONT SIZE=4><B>User</B></FONT></P>
		</TD>
		<TD WIDTH=13% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: none; border-right: 1px double #111111; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0in; padding-right: 0.04in">
			<P ALIGN=LEFT><FONT SIZE=4><B>Time</B></FONT></P>
		</TD>
	</TR>

<?php	

if( $count != 0 ){

for( $x= 0; $x < $count ; $x++ ){
$row = mysql_fetch_row($res );
$action = $row[0];
$value = $row[1];
$user = $row[2];
$when = $row[3];

//now start print out the actions recorded	
echo "
	<TR VALIGN=TOP>
		<TD WIDTH=15% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=LEFT>$action&nbsp;&nbsp;&nbsp;&nbsp;<BR>
			</P>
		</TD>
		<TD WIDTH=54% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: none; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0in; padding-right: 0in\">
			<P ALIGN=LEFT>$value&nbsp;&nbsp;&nbsp;&nbsp;<BR>
			</P>
		</TD>
		<TD WIDTH=18% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: none; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0in; padding-right: 0in\">
			<P ALIGN=LEFT>$user<BR>
			</P>
		</TD>
		<TD WIDTH=13% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: none; border-right: 1px double #111111; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0in; padding-right: 0.04in\">
			<P ALIGN=LEFT>$when<BR>
			</P>
		</TD>
	</TR>
";

}

?>
	
</TABLE>

<?php

}else{

?>
</table>
<center><h1>No actions carried out on this student</h1></center>
<?php

}

?>
<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none"><BR><BR>
</P>
<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none"><BR><BR>
</P>
<P ALIGN=CENTER STYLE="font-style: normal"><FONT SIZE=3><U><B>Powered
by Kings School Management System</B></U></FONT></P>
</BODY>
</HTML>

