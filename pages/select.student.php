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
<center>
<p>
<h2>Select Student</h2>
</p>
<script>
//this is called once to store the current selected student full html
var $stored = $('#results').html();

function initSearch(){
//first check lenght of string typed in

//if empty clear the bar
if( $('#query').val().length == 0 ){
$('#results').html($stored);
return;
} 

if( $('#s_type').val() == 'class'  ){
}

else{
if( ( $('#query').val().length < 3 )  ) {
return 0; //min search length must be 3 if not class
}

}

$limit = $('#more_results').val();
var $str = $('#sss').serialize();
$.get('search/student.php' , $str  , function( $data ){
$('#results').html($data) ; } );
}




function updateSearchBox(){
$type = $('#s_type').val();
$ne = '';
switch( $type ){
case 'fullname':
$ne = 'Find a student by name';
break;
case 'class':
$ne = 'Enter Class to list students';
break;
case 'id':
$ne = 'Enter student\'s National ID';
break;
case 'student_id':
$ne = 'Enter Student\'s School ID';
break;
default:
$ne = 'Search Here'; 
break;
}
$('#query').attr('placeholder' ,  $ne  );

}
</script>

<form id='sss' >
<input type=hidden name='full' hidden=true style="display: none;"  value='true' />
<input id='query' onkeyup="initSearch();"  style="width: 400px; text-weight: bold; height: 30px; color: white; background-color: green; border: solid 1px purple;" type="text" name="search" placeholder="Find a Student">

<b>Criteria:</b>
<select onchange='updateSearchBox();' name="type" id="s_type" style="width: 200px; height: 30px; color: white; background-color: green;" >
<option value='fullname'>Fullname (default)</option>
<option value='class'>Class</option>
<option value='id'>National I.D</option>
<option value='student_id'>Student I.D</option>

</select>
<b>Results</b>
<select onchange="initSearch();" name="limit" style="width: 50px; height: 30px; color: white; background-color: green;" id="more_results" >
<option value="5" >5</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="999999">All</option>
</select>
</form>
	<H4 >Search Suggestions</H4>
	<center>
	<DIV ID="results" style="overflow: auto; height: 260px;">
	<!-- The laast used student will be shown here -->
<?php

if( isset($_SESSION['student_id'] ) ){
$st = new Student( $_SESSION['student_id'] );
if( $st->populate() ){
$sc = new SchoolClass( $st );
$sph = new StudentPhoto( $st );
$sc->populate();
//now print out the page 
//use menu div for larger pictures
$id = $_SESSION['student_id'];
$i = $sph->getImage();
$pic = "scripts/getphoto.php?id=$st->id"; 
$fullname = $st->firstname . " " . $st->middlename . " " . $st->lastname;
$class = $sc->form . " " . $sc->_class;

echo '<center><div class="menu" >';
echo "<div  >
<h4>Current selected</h4>
<a onclick=\"loadStudentInfo('$id');\" ><img src=\"$pic\" id=\"select_pic\" />
	
	<h4>$fullname  $class</h4></a>
	</div>
</div></center>
";	
	 
	

}

}

?>	
	</DIV>
	
	</center>
<div class='buffer' style='padding-top: 20px; ' >
<H3 CLASS="western" ALIGN=CENTER>Recently Used</H3>
<!-- List of last 5 used students is populated here -->
<div class="submenu" " >
<?php
//the buffer is initialised here and we print out the last 5 used values
$sbf = new StudentBuffer();

$lu = $sbf->getLastX( 4 ); //get last 4

//now loop thr the values and print out
$sz = sizeof( $lu );
for( $x = 0; $sz > $x ; $x++ ){
$st = new Student( $lu[$x]['id'] );
if( ! $st->populate() ) continue;
$cs = new SchoolClass( $st );
$cs->populate();

$sph = new StudentPhoto( $st );

$fname = $st->firstname . " " . $st->middlename . " " . $st->lastname;
$base64_img = $sph->getImage();
$img = "scripts/getphoto.php?id={$st->id}";


echo "
<a  onclick=\"loadStudentInfo('{$lu[$x]['id']}');\" ><img src=\"$img\"  /><br /><b><h5>$fname <br />{$cs->form} {$cs->_class}</h5></b></a> \n";
}
   

?>
</div>
</div>
