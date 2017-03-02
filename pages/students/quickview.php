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
<div class="student_photo"  >
<a onclick='viewPhoto("<?php echo $st->id; ?>")' title="View fullsized photo">
<img id="st_pic" 
<?php 
//print out the base64 encoded image
echo "src=\"scripts/getphoto.php?id=$st->id\" />"; ?></a>


<br />
<b><?php echo $st->firstname . " " . $st->middlename . " " . $st->lastname; ?></b>

</div>




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
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">CLASS
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $sc->form . " " . $sc->_class; ?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Student ID
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $st->school_id; ?>
			</P>
		</TD>
		
	</TR>
			<?php
//check if student is a boarder
$type = 'Day Scholar';
if( $st->isBoarder() ){
$type = "Boarder &nbsp; <button onclick=\"viewBoarderInfo('{$st->id}');\" >Info</button>";
}
?>
<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Type:
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $type;
			?>
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
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Sex
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			if( $st->sex == 'M' ){
			echo "Male";
			}else{
			echo "Female";
			}
			?>
			
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Age
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			$a = new Age($st->dob );
			echo $a->getAge() . " ( " . $st->dob . " ) ";
			?>
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Enrolled
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php 
			echo $st->year_enrolled . "/" . $st->term_enrolled;
			?>
			</P>
		</TD>
		
	</TR>
	<tr><td><hr /></td><td><hr /></td></tr>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Home Phone
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $cs->home_phone; 
			?> 
			</P>
		</TD>
		
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=33% BGCOLOR="#e6e6ff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none">Home Address
			</P>
		</TD>
		<TD WIDTH=33% BGCOLOR="#ffffff" STYLE="border-top: 1px solid #800000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php
			echo $cs->home_addr;
			?>
			</P>
		</TD>
		
	</TR>
</TABLE>



