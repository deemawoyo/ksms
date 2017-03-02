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


$st = new Student( $_SESSION['student_id']);
if( ! $st->populate() )die('Invalid student selected');

$sc = new SchoolClass($st);
$sc->populate();
$curr_class = $sc->form . " " . $sc->_class; 

?>
<script type="text/javascript" >

var target_class;
var target_form;


function moveClass(){
var form = $('#student_form').val();
var _class = $('#student_class').val();

if( form == 'Select' || _class == 'Select' ){
new Messi('Select a form and class to show' , {title: 'Error' , titleClass: 'error' , modal : true } );
return 0;
}
new Messi('Are you sure you want to MOVE THE STUDENT TO THIS CLASS ?' , {title: 'Confirm Move Class' ,  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} , {id: 0, label: 'Yes', val: 'Y'}   ]     
    , modal: true , callback: 
function(resp){ 
if( resp == 'Y' ){
$("#u_record_edit").load("pages/classes/process_move.php?class=" + _class + "&form=" + form);

}	

} 


});
}

</script>
<div id='u_record_edit' >
<img src='images/class.jpg' style='float: left; ' />
<br />
<h2 style="color: blue;">Current class is <?php echo $curr_class; ?></h2> 
<p>
<h2>Select a class to move the student into.</h2>
</p>
	<b style="color: black;" >Form:&nbsp;</b> 
	<select name="student_form" id="student_form" style="width:90px; height: 35px; " onchange="target_form = this.value; getClassList()">
		<?php
		$config->printOptionForms();
		?>
 </select>

<b style="color: black;" >&nbsp;&nbsp;&nbsp;Class:&nbsp</b>
	<select onchange='target_class = this.value' name="student_class" id="student_class" style="width: 90px; height: 35px;" >
	
	    </select>	
<center>	    		     	
	<br />
<br />
<button onclick='moveClass()'>Move Class</button>
</center>

</div>