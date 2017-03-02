<?php
require_once('../configuration.php');

//check if user is logged in
//logout if not
if(! $sess->isLoggedIn() ){
$sess->StartNew();
header('Location: login.php');
exit;
}


?>

//global variable that stores the current page
var $curr_page = ''; //start page
var $prev_page = '';
var bypass = false;
var is_root=0;


	
//password for priviledge escalate, global
var esc_passwd;

	
//boarder info
function viewBoarderInfo($student_id){

Messi.load( "pages/students/ajax.boarder.info.php?student_id=" + $student_id , {
	title: 'Boarder Info',
	titleClass: 'info',
	modal: true ,
	close: true   } );
	
	
}

function goBack(){
//if on same page, do nothing


//go to previous page
loadPage($prev_page);



}

//shows a simple error message and reloads the page 

function errorMsg(){
new Messi('The program failed to create a database connection, Please make sure the server is running. If problem persists, contact the developers', {title: 'Database Error',modal: true, titleClass: 'anim error', close: true});	
	
}
//load the students image


function getStudentImage($id)
{
	
$url = "scripts/getphoto.php";
$data = "id=" + $id ;
$.get($url , $data  , applyStudentImage ); 
}

function applyStudentImage( $data ){
$data = "data:image/jpeg;base64," + $data;
document.getElementById("st_pic").src = $data;
}

function loadPage( $page  ){
//set cooll tips
//first close



if( $page == '' ){
$("#main").load("getpage.php");
}else{
$url = "getpage.php?page=" + $page;
//try some animation


$("#main").load($url).error(errorMsg);

}
$prev_page = $curr_page;
$curr_page = $page;


}

//loads a sub category from the current page
function loadSub( $sub ){

//set timer to show loading page after 2 seconds

if( $curr_page == '' ){ //no sub categories here
$("#main").load("getpage.php").error(errorMsg);
}else{
$url = "getpage.php?page=" + $curr_page + "&sub=" + $sub;
$("#main").load($url).error(errorMsg);

}
$prev_page = $curr_page ;
$curr_page = $curr_page  + "&sub=" + $sub;

}


function quickStudentInfo( $student_id ){
	
Messi.load( "pages/students/quickview.php?student_id=" + $student_id , {
	title: 'Quick Student Info',
	titleClass: 'info',
	modal: true ,
	close: true   } );
	
	
	
}

function loadStudentSection( $section  ){


if( $section == 'enrollment_info' ){
$title = "Enrollment Info";
Messi.load( "pages/academic/" + $section + ".php" , {title: $title, titleClass: 'info', modal: true , close: true } );

}
else if( $section == 'student_info' ){
Messi.load( "pages/students/ajax.info.php" , {title: 'Student Info', titleClass: 'info', modal: true , close: true} );


}
else if( $section == 'add_payment' ){
Messi.load( "pages/payments/add.php" , {title: 'Record Payment', titleClass: 'info', modal: true  , close: true } );


}
else if( $section == 'edit_payment' ){

Messi.load( "pages/payments/edit.php" , {title: 'Edit Payments', titleClass: 'info', modal: true  , close: true   } );


}
else if( $section == 'transfer_student' ){
Messi.load( "pages/students/transfer.php" , {title: 'Transfer student', titleClass: 'info', modal: true  , close: true  } );


}
else if( $section == 'payment_report' ){
Messi.load( "pages/payments/report.php" , {title: 'Edit Payments', titleClass: 'info', modal: true  , close: true  } );


}
else if( $section == 'textbooks_view' ){
Messi.load( "pages/textbooks/view.php" , {title: 'View Assigned Textbooks', titleClass: 'info', modal: true   , close: true  } );


}
else if( $section == 'textbooks_assign' ){
Messi.load( "pages/textbooks/assign.php" , {title: 'Assign A Textbook', titleClass: 'info', modal: true   } );

}
else if( $section == 'move_class' ){
Messi.load( "pages/classes/move.php" , {title: 'Change Student Class', titleClass: 'info', modal: true    } );


}
else{
//not yet implemented
new Messi('<center><h1>Feature not implemented in demo version</h1></center>' , {title: 'Feature Not Available In Demo Version' , modal: true , titleClass: 'info' });	
	
}

}



function getClassList(){
var $form = $("#student_form").val();
var $url = "pages/classes/list.php?form=" + $form;
$("#student_class").load($url); 

}

function viewPhoto($id ){
window.open('scripts/getphoto.php?id=' + $id + "&html=true" , 'Student Picture' , 'menubar=0,location=0,width=250,height=340');  
}

function loadStudentInfo( $student_id ){
//same as load page but with the id tag set

//first set the session cookie

$.get("scripts/setcookie.php" , {student_id :  $student_id } , function($data){ loadPage('students/view');  }  ).error(errorMsg);
//now load the page




}

function showStudentInfo(  ){
//shows student info using session
$("student_info").load("pages/students/info.div.php").error(errorMsg);
}


//script to warn user when leaving page
window.onbeforeunload = function() { 
  if( ! bypass )
    return '***********************************\n WARNING: Using the browsers reload button may result in loss of data !. Use the BACK BUTTON IN THE LOWER LEFT SIDE OF THE WINDOW INSTEAD. ';
  
}


function showStaff(){

$('#main').html("<iframe src='pages/staff/index.php' style='width: 100%; height: 500px; border: none;' ></iframe>");	
	
}



/*
Strip whitespace from the beginning and end of a string
Input : a string
*/
function trim(str)
{
	return str.replace(/^\s+|\s+$/g,'');
}

/*
Make sure that textBox only contain number
*/
function checkNumber(textBox)
{
	while (textBox.value.length > 0 && isNaN(textBox.value)) {
		textBox.value = textBox.value.substring(0, textBox.value.length - 1)
	}
	
	textBox.value = trim(textBox.value);
/*	if (textBox.value.length == 0) {
		textBox.value = 0;		
	} else {
		textBox.value = parseInt(textBox.value);
	}*/
}

/*
	Check if a form element is empty.
	If it is display an alert box and focus
	on the element
*/
function isEmpty(formElement, message) {
	formElement.value = trim(formElement.value);
	
	_isEmpty = false;
	if (formElement.value == '') {
		_isEmpty = true;
		alert(message);
		formElement.focus();
	}
	
	return _isEmpty;
}

/*
	Set one value in combo box as the selected value
*/
function setSelect(listElement, listValue)
{
	for (i=0; i < listElement.options.length; i++) {
		if (listElement.options[i].value == listValue)	{
			listElement.selectedIndex = i;
		}
	}	
}


