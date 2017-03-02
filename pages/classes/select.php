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
require_once("../..//php/database.php");
require_once("../../php/student.php");
require_once("../../php/class.php");
require_once("../../php/auditor.php");
require_once("../../php/payment.php");
require_once("../../php/contact.php");

$db->connect();
?>
<script>
function showClass(){
var form = $('#student_form').val();
var _class = $('#student_class').val();

if( form == 'Select' || _class == 'Select' ){
new Messi('Select a form and class to show' , {title: 'Error' , modal : true } );
return 0;
}


}

</script>
<img src='images/class.jpg' style='float: left; ' />
<b style="color: silver;">Select Student</b><br />
	<b style="color: black;" >Form:&nbsp;</b> 
	<select name="student_form" id="student_form" style="width:90px; height: 35px; " onchange="selected_form = this.value; getClassList()">
		<?php
		$config->printOptionForms();
		?>
 </select>

<b style="color: black;" >&nbsp;&nbsp;&nbsp;Class:&nbsp</b>
	<select onchange='selected_class = this.value' name="student_class" id="student_class" style="width: 90px; height: 35px;" >
	
	    </select>			     	
	<br />
<br />

