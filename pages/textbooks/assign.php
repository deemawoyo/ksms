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

<script>

function assignTextBook(){

$errors = '';

var $ok_cnd=false;
var $ok_title = false;
var $ok_number = false;


var title = $('#txt_title').val();
if( title.length > 5 ){
$ok_title = true;
}else{
$ok_title = false;
}

var title = $('#txt_number').val();
if( title.length > 1 ){
$ok_number = true;
}else{
$ok_number = false;
}


if( $('#txt_condition').val() == 'select' ){
$ok_cnd = false;	
}else{
$ok_cnd = true;	
}

if( ! $ok_cnd ){
$errors = 'Select the book\'s condition';	
}
if( ! $ok_title ){
	
$errors = $errors +  "<br /> Invalid book title entered";	
}
if( ! $ok_number ){
	
$errors = $errors +  "<br /> Enter a valid book number ";	
}

if( $errors != '' ){
new Messi("Please fix the following before continuing <br /><h3 style='color: red; font-weight: bold;'> " + $errors + "</h3>" ,  {title: 'Warning !', titleClass: 'anim warning' , modal: true , buttons: [{id: 0, label: 'Close', val: 'X'  } ] } )	;
return 0;
}	


new Messi('Are you sure you want to loan this book ?' ,
 {title: 'Confirm Loan' ,
  modal: true ,
   buttons: 
   [
   	{id: 0, label: 'Cancel', val: 'X'  } ,
   	 {id: 1, label: 'Continue', val: 'Y' , class: 'btn-success' }]   
  , callback: function($resp){ if($resp == 'Y') loanBook(); } }  );	
	
}

function loanBook(){

//now we execute the command
$data = $('#txt_form').serialize();
$.get(
'pages/textbooks/save.assign.php' ,
 $data  ,
 function($data){ $('#add_t_window').html($data); } 
  
 );


}




</script>
<div id='add_t_window' >
<center>
<img src='images/documents.jpg' style='float: left; width: 128px; height: 192px;' />
<h3>Assign Textbook </h3>
<form style='float: right' id='txt_form' >
<table>
<tr>
<td><b>TextBook Title:</b></td>
<td><input type=text name='txt_title' id='txt_title' style='height: 30px; width: 220px;'/></td>
</tr>
<tr>
<td><b>Textbook Number:</b></td>
<td><input type=text name='txt_number' id='txt_number'  style='height: 30px; width: 120px;'/></td>
</tr>
<tr>
<td ><b>Condition: </b></td>
<td><select name='txt_condition' id='txt_condition' style='height: 30px; width: 120px;'>
<option value='select' >Select</option>
<option value='good' >Good</option>
<option value='fair' >Fair</option>
<option value='damaged'>Damaged</option>
</select>
</td>
</tr>
</table>

<br />
<p>
</p>
<span><b>NB:</b> First check what books are already <br />assigned to the student before<br /> adding another</span>

</form>
<button style='float: right;'  onclick='assignTextBook()' >Assign Textbook</button>

</center>
</div>
