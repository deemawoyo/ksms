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

if( isset($_GET['criteria']) ){
	
	//manually include
require_once("../../configuration.php");
require_once("../..//php/database.php");
require_once("../../php/student.php");
require_once("../../php/class.php");
require_once("../../php/textbook_library.php");
	
	
}


$db->connect();

$txtmgr = new TextBookManager();

//now list books by criteria, borrowed by default
$criteria = isset($_GET['criteria']) ? $_GET['criteria'] : 'bor';

$title = 'Loaned';
switch($criteria ){
	
case 'ret':

$title = 'Returned';
break;
case 'bor':
$title = 'Loaned';
break;
default:
$criteria = '';
$title = 'Listed';
break;
	
}

//now list books
//from all students
$list = $txtmgr->getListAll( $criteria , false);

$count = sizeof( $list );
if( ! $list ){
$count = 0;	
}
if(! isset($_GET['criteria']) ){
	//print out top page toolbar if criteria is not set 


?>
<script>

function showTextBooksByCriteria( ){
var criteria = $('#txt_criteria').val();	
var url = 'pages/textbooks/view.library.php?criteria=' + criteria;
$('#txt_table').load(url);	
}

</script>
<TABLE  WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-inside: avoid">
	<COL WIDTH=85*>
	<COL WIDTH=85*>
	<COL WIDTH=85*>
	<TR VALIGN=TOP  style='font-weight: bold; font-size: 16px;'>
		<TD WIDTH=33% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER>Criteria: 
			<select id='txt_criteria' onchange="showTextBooksByCriteria()" style='height: 35px; width: 150px;'>
	<option value='bor'>Loaned Books</option>
	<option value='ret'>Returned Books</option>
	<option value='all'>All Books</option>				
			</select></P>
		</TD>
		<TD WIDTH=33% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER>
			<button>Print</button></P>
		</TD>
		<TD WIDTH=33% STYLE="border: 1px double #808080; padding: 0.04in">
			<P ALIGN=CENTER>
			<button>Edit</button></P>
		</TD>
	</TR>
</TABLE>
<P ALIGN=CENTER><BR><BR>
</P>

<div id='txt_table' >

<?php

}
?>

<center>
<h3><?php echo $count . " " . $title; ?>  Books</h3>
</center>
<TABLE class='table_cool' WIDTH=100% CELLPADDING=4 CELLSPACING=0 STYLE="page-break-inside: avoid">
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<COL WIDTH=64*>
	<tr style=' color: white; font-weight: bold; background-color: grey;' >
		<TD WIDTH=25% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>TextBook Title</B></P>
		</TD>
		<TD WIDTH=5% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Book Number</B></P>
		</TD>
		<TD WIDTH=25% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Student Loaned</B></P>
		</TD>
		<TD WIDTH=10% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Date Loaned</B></P>
		</TD>
		<TD WIDTH=10% STYLE="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in">
			<P ALIGN=CENTER><B>Date Returned</B></P>
		</TD>
		<TD WIDTH=25% STYLE="border: 1px double #808080; padding: 0.04in">
			<P ALIGN=CENTER><B>Action</B></P>
		</TD>
	</TR>
	
<?php

//start printing out books list


for( $x = 0 ; $x < $count ; $x++){
$st = new Student( $list[$x]['student_id']);

if( ! $st->populate() )continue;
$sc = new SchoolClass( $st );
$sc->populate();
$student_class = $sc->form . " " . $sc->_class;
echo "
	<TR VALIGN=TOP>
		<TD WIDTH=25% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$list[$x]['book_title']}<BR>
			</P>
		</TD>
		<TD WIDTH=5% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$list[$x]['book_number']}<BR>
			</P>
		</TD>
		<TD WIDTH=10% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$st->fullname} ($student_class) {$st->school_id} <BR>
			</P>
		</TD>
		<TD WIDTH=25% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$list[$x]['date_borrowed']}<BR>
			</P>
		</TD>
		<TD WIDTH=10% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0in\">
			<P ALIGN=CENTER>{$list[$x]['date_returned']}<BR>
			</P>
		</TD>
		
		<TD WIDTH=25% STYLE=\"border-top: none; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: 1px double #808080; padding-top: 0in; padding-bottom: 0.04in; padding-left: 0.04in; padding-right: 0.04in\">
			<P ALIGN=CENTER>
	<a style='color: blue;' onclick=\"loadStudentInfo('{$st->id}');\" >Select Student</a> <br /> <a style='color: green;'>Edit</a> <br /> <a style='color: red;'>Delete</a>			
			<BR>
			</P>
		</TD>
	</TR>";


}
?>

</TABLE>
<?php

if( ! isset($_GET['criteria']) ){


?>
</div>

<?php

}
?>