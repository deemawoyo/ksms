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
require_once("../../configuration.php");
require_once("../../php/database.php");
require_once("../../php/class.php");
require_once("../../php/student.php");

$db->connect();

	
$st = new Student(0);
$sc = new SchoolClass($st );

$slist = $sc->getClassStudents( $_GET['form'] , $_GET['class'] );
if( ! $slist ){
die('Invalid form or class passed');	
}
$count = sizeof($slist);


?>
<script type="text/javascript" >
function printClassList(){
	
window.open("pages/classes/classlist_print.php?form=" + selected_form + "&class=" + selected_class );
	
}

//create the dataTable


</script>
<div style=' width: 80%;' >
<P ALIGN=CENTER><B>Class list for <?php echo $_GET['form'] . " " . $_GET['class'] . " as of " . date('Y') . "/" . $config->term ; ?></B></P>
<TABLE WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-inside: avoid">
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<TR VALIGN=TOP>
		<TD WIDTH=25% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER>
			<br />
	<button onclick='selectClass(); '>Select Class</button>			
			</P>
		</TD>
		<TD WIDTH=25% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER>
			<br />
	<button onclick="printClassList()" >Print Class List</button>			
			</P>
		</TD>
		<TD WIDTH=25% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER>
			<br />
	<button onclick='editClass();' >Edit Class</button>			
			</P>
		</TD>
		<TD WIDTH=25% STYLE="border: 1px double #808080; padding: 0.04in">
			<P ALIGN=CENTER>
			<br />
	<button onclick='printPDFClassList();' >PDF Class LIst</button>			
			</P>
		</TD>
	</TR>
</TABLE>

</div>
<P ALIGN=CENTER><BR>
<?php echo $count . " Students ";  ?>
<BR>
</P>

<TABLE  class='table_cool' id='class_list_table'  WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-inside: avoid">
	<COL WIDTH=51*>
	<COL WIDTH=51*>
	<COL WIDTH=51*>
	<COL WIDTH=102*>
	<tr style=' color: green; font-weight: bold; background-color: grey;' >
		<TD WIDTH=20% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Fullname</B></P>
		</TD>
		<TD WIDTH=20% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Gender</B></P>
		</TD>
		<TD WIDTH=20% STYLE="border-top: 1px double #111111; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Student I.D</B></P>
		</TD>
		<TD WIDTH=40% STYLE="border: 1px double #111111; padding: 0.04in">
			<P ALIGN=CENTER><B>Action</B></P>
		</TD>
		</TR>
<?php

for( $x = 0; $x < $count ; $x++ ){
$id = $slist[$x];	
$st = new Student($id );
if( ! $st->populate() ) continue;

echo "			
	
	<TR VALIGN=TOP>
		<TD WIDTH=20% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$st->fullname}
			</P>
		</TD>
		<TD WIDTH=20% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$st->sex}
			</P>
		</TD>
		<TD WIDTH=20% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$st->school_id}
			</P>
		</TD>
		<TD WIDTH=40% STYLE=\"border-top: none; border-bottom: 1px double #111111; border-left: 1px double #111111; border-right: 1px double #111111; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P ALIGN=CENTER>
			<a onclick='loadStudentInfo(\"{$st->id}\")' style='color: blue;'>Select</a> / <a onclick='quickStudentInfo(\"{$st->id}\")' style='color: green;'>Quick Info</a> 
			</P>
		</TD>
	</TR>

";

}

?>

</TABLE>
<P ALIGN=CENTER><BR><BR>
</P>
</BODY>
</HTML>