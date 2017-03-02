<?php
/**
 * Copyright 2016
 *
 * @author Clifford J Mthemba
 *
 * @info
 * 
 *
 * @important 
 *
 * @license
 * 
*/

$step = isset($_GET['step'] ) ? $_GET['step'] : 1;


if( $step == 1 ){

?>

<script type="text/javascript" >
function enrollStudent(){
	
//error checking is done here	


//now prompt enroll

new Messi( 'CONFIRM: You are about to enroll a student into the  school\'s database.  Please make sure all entered information is correct !' , {title: 'Confirm enroll student ?' ,
 modal : true , 
  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} ,
    {id: 1, label: 'Continue', val: 'Y' , class: 'btn-success'} ] , callback:  function(ret){
if( ret == 'Y'){
addStudent();	
}	

}    
    
   } );
    
	
}	



function addStudent(){
	
$data = $('#enroll_form').serialize();	

$.post( 'pages/students/add.php' , $data , function(ret){
	new Messi(   ret , {title: 'Select Class' ,
 modal : true , 
  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'}  ]     
    
   } );
	
	
	}   );

}
</script>
<center>
<form id='enroll_form' style="border: 2px solid silver; padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px; width: 95%; form-align: center">

<center>
	      <marquee bgcolor="silver" width="80%" scrollamount="2" direction="left" direction="right"> <h2 style="color: green"><strong><l> Welcome to Founders High School A'Level Student Enrolment</l><strong></h2></marquee>
            <h3 class="intro" >Follow simple 3 step process to register student </h3><hr style="border: 1px solid silver">
					
</center>

<fieldset style="border: 1px solid silver">
<legend style="padding: 0.2em 0.5em; border: 1px solid silver; color: green; text-align: left;font: 100%/1 sans-serif">Student Details</legend>
<table  WIDTH=90% CELLPADDING=2 CELLSPACING=10 STYLE=\"page-break-inside: avoid\">

<tr>
<td><b style='color: black'>* First Name:</b></td>
<td> <input type=text id='fullname' name='fullname' /></td>
</tr>
<tr>
<td><b style='color: black'>* Other Names:</b></td>
<td> <input type=text id='midname' name='midname' /></td>
</tr>
<tr>
<td><b style='color: black'>* Last Name:</b></td>
<td> <input type=text id='surname' name='surname' /></td>
</tr>
<tr>
<td><b style='color: black'>* Gender:</b></td>
<td> 
<select  id='gender' name='gender' >
<option value='M' >Male</option>
<option value='F' >Female</option>
</select>
</td>
</tr>
<tr>
<td><b style='color: black'>* ID/BIRTH ENTRY NUMBER</td>
<td> <input type=text id='id' name='id' /></td>
</tr>
<tr>
<td><b style='color: black'>* Date Of Birth:</b></td>
<td>
<select  name='enroll_date' id='enroll_date' >
<?php
$start = 1;
$end = 32;
for(; $start < $end; $start++ )
echo "<option value=\"$start\">$start</option>\n";
?>
</select>
<b>-</b>
<select  name='enroll_month' id='enroll_month' >
<?php
$months = array (0 ,'January' , 'February' , 'March' , 'April' , 'May' , 'June' , 'July' , 'August' , 'September' , 'October' , 'November' ,'December'  );
for ( $x = 1 ; $x < 13 ; $x++)
echo "<option value='$x' >{$months[$x]}</option>\n";
?>
</select>
<b>-</b>
 <select  id='enroll_year' name='enroll_year' >
<?php
$start_year = 1990;
$end_year = date('Y');
for($x = 0; $x < 50 ; $x++ ){
$start_year = $end_year - $x;
echo "<option value=\"$start_year\">$start_year</option>\n";
}
?>
</select></td>
</tr>
</table>
</fieldset>
<br>

<fieldset style="border: 1px solid silver">
<legend style="padding: 0.2em 0.5em; border: 1px solid silver; color: green; text-align: left; font: 100%/1 sans-serif"> Contact Details</legend>
<table   WIDTH=90% CELLPADDING=4 CELLSPACING=10 STYLE=\"page-break-inside: avoid\">
<tr>
<td><b style='color: black'>* Parent Name:</td>
<td> <input type=text id='c_name' name='c_name' /></td>
</tr>
<tr>
<td><b style='color: black'>* Parent Telephone:</b></td>
<td> <input type=text id='c_phone' name='c_phone' /></td>
</tr>
<tr>
<td><b style='color: black'>* Parent Address:</b></td>
<td> <input type=textarea id='c_addr' name='c_addr' /></td>
</tr>
<tr>
<td><b style='color: black'>* Next of Keen Name:</b></td>
<td> <input type=textarea id='nkn_name' name='nkn_name' /></td>
</tr>
<tr>
<td><b style='color: black'>* Next of Keen Phone:</b></td>
<td> <input type=textarea id='nkn_phone' name='nkn_phone' /></td>
</tr>
</table>
</fieldset>
<br>

<br />

</form>

<button onclick='enrollStudent()'>Enroll Student</button>
</center>
<?php


}

?>