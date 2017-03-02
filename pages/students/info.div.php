<?php
//the necessary includes will be dealt with in the getpage file
//include the student info div

if( ! isset($_SESSION['student_id'] ) ){
//go back
//die ("<script>goBack();</script>");
}

$id = $_SESSION['student_id'];
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
<div class="student_info" >
<div class="student_photo"  >
<a onclick='viewPhoto("<?php echo $st->id; ?>")' title="View fullsized photo">
<img id="st_pic" 
<?php 
//print out the base64 encoded image
echo "src=\"scripts/getphoto.php?id=$st->id\" />"; ?>
</a>


<br />
<b><?php echo $st->firstname . " " . $st->middlename . " " . $st->lastname; ?></b>

</div>

<script>
function assignSchoolID(){
$('#school_id_').load('pages/students/make_school_id.php' );
$('#gen_id_btn').fadeOut();
}

</script>


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
			<P ALIGN=LEFT STYLE="font-style: normal; font-weight: bold; text-decoration: none" id='info_div_class_form'>
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
			<P ALIGN=LEFT id='school_id_' STYLE="font-style: normal; font-weight: bold; text-decoration: none">
			<?php echo $st->school_id; ?>
			<?php 
			if( $st->school_id == 'NONE' ){
			
			echo "<button id='gen_id_btn' onclick='assignSchoolID();' >Generate ID</button>";
			}
			?>
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
			<?php echo strtoupper($st->id); ?>
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


</div>

