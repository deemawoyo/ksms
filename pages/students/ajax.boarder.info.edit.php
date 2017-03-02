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

?>
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

if( ! isset($_SESSION['student_id'] ) ){
//go back
die ("NO student ID set");
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
<script>
function UpdateValue($key ){
$('#BoarderInfo').load('pages/students/ajax.boarder.info.edit.php');

}

function saveInfo(){
new Messi( "Are you sure you want to update these records ?" , {title: 'Confirm Action', titleClass: 'warning', modal: true , buttons: [{id: 0, label: 'Cancel', val: 'X'} , {id: 1, label: 'Continue', val: 'Y' , class: 'btn-success'} ] , callback: 
function(response){
if(response == 'Y'){
//code to save to database goes here
$data =  $('#b_update_form').serialize() ;

Messi.load( "pages/students/ajax.boarder.info.save.php" , {title: 'Operation Result', titleClass: 'info', modal: true , buttons: [{id: 0, label: 'Close', val: 'X'}  ]} );

}else{
new Messi( "Any changes you made to the form have not be saved" , {title: 'Actions Not Saved', titleClass: 'warning', modal: true , buttons: [{id: 0, label: 'OK', val: 'X'}  ]

}
);

} 

} });


}


</script>
<p id='b_msg'>

</p>
<form id='b_update_form'  >
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
			<input name='b_house' value='<?php echo $st->b_info->house; ?>' />
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
			<input name='b_year_enrolled' value='<?php echo $st->b_info->year_enrolled; ?>' />
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
			<select name='b_term_enrolled' style='width:150px;'>
			<?php 
			echo "<option>{$st->b_info->term_enrolled}</option>"; 
			for($x  = 1; $x <= 3; $x++)
			echo "<option value=$x >$x</option>";
			
			?>
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
			<input name='b_medical' type=textarea style='' value='<?php echo nl2br($st->b_info->medical_condition); ?>' />
			
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
			<input name='b_doctor' value='<?php $st->b_info->doctor; ?>'/>
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
			<input type=text name='b_guardian' value='<?php echo $st->b_info->guardian_name; ?>' />
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
			<input type=text name='b_guardian' value='<?php echo $st->b_info->guardian_contact; ?>' />
			</P>
		</TD>
		
	</TR>

</TABLE>
</form>

<center>
<p>
When finished editing records. Click on save to apply them
</p>
<button onclick='saveInfo();'>SAVE</button>
</center>
</div>


