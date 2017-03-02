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
require_once("../../php/student.php");
require_once("../../php/class.php");
require_once("../../php/student_photo.php");
require_once("../../php/contact.php");
require_once("../../php/database.php");
require_once("../../php/age.php");

$db->connect();
//the necessary includes will be dealt with in the getpage file
//include the student info div

//f( ! i
//$_GET['student_id'] = $_SESSION['student_id'];

if( ! isset($_GET['student_id'] ) ){
//go back
die ("NO student ID set");
}

$id = $_GET['student_id'];
$st = new Student($id );

if( ! $st->populate() ){
die("failed to populate");
}
//create basic objects

$sph = new StudentPhoto($st );
$sc = new SchoolClass( $st );
$cs = new StudentContact( $st );
$cs->populate();
$sc->populate();

//now print page

?>
<script>
function loadEditBoarderInfo(){
$('#BoarderInfo').load('pages/students/ajax.boarder.info.edit.php');

}
</script>

<div class="student_photo"  >
<a onclick='viewPhoto("<?php echo $st->id; ?>")' title="View fullsized photo">
<img id="st_pic" 
<?php 
//print out the base64 encoded image
echo "src=\"scripts/getphoto.php?id=$st->id\" />"; ?></a>

<button onclick='loadEditBoarderInfo();' style='float: right; color: red; margin: 0  0 0 200px;'>Edit</button>
<br />
<b><?php echo $st->firstname . " " . $st->middlename . " " . $st->lastname; ?></b>

</div>



<div id='BoarderInfo' >
<TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0>
	<COLGROUP>
		<COL WIDTH=85*>
		<COL WIDTH=85*>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=85*>
	</COLGROUP>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Fullname
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none; font-weight: bold; "><?php echo $st->firstname . " " . $st->middlename . " " . $st->lastname; ?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">National ID
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $st->id; ?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Boarding House:
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $st->b_info->house; ?>
			</P>
		</TD>
		
	</TR>
<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Year Enrolled:
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $st->b_info->year_enrolled;
			?>
			</P>
		</TD>
		
	</TR>	
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Term Enrolled
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $st->b_info->term_enrolled; ?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Medical Condition:
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $st->b_info->medical_condition;
			?>
			
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Family Doctor
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			$st->b_info->doctor;
			?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Guardian Name:
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php 
			echo $st->b_info->guardian_name;
			?>
			</P>
		</TD>
		
	</TR>
	<tr><td><hr /></td><td><hr /></td></tr>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Guardian Phone
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $st->b_info->guardian_contact; 
			?> 
			</P>
		</TD>
		
	</TR>

</TABLE>

</div>


