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
require_once("../../php/auditor.php");


$db->connect();




if(isset($_GET['form'])  and isset($_GET['class']) ){
$form = $_GET['form'];
$class = $_GET['class'];
//now lets move the student
$st = new Student( $_SESSION['student_id']);
if( ! $st->populate() )die('Invalid student selected');

$sc = new SchoolClass($st);
$sc->populate();
$old_class = $sc->form . " " . $sc->_class;



$sc->update('form' , $form);
$sc->update('class' , $class);


//create auditor
$au = new Auditor($sess->user );
$au->add("MOVE_CLASS" , "[{$st->id}] Moved Class From $old_class TO $form $class "  );

//print success message


echo "
<script>
//load new class info into info.div
$('#info_div_class_form').html('{$form} {$class}'  );
function loadBack(){
$('#u_record_edit').load(\"pages/classes/move.php\");	
	
}
</script>
<img src='images/success128.png' style='float: left; ' />
<p style='color: black; font-weight: bold;' >Student now in $form $class from $old_class </p>
<table>
<tr>
</tr>
</table> 
<br />
<br />
<center>
<h4><button onclick='loadBack()' >Go Back</button> </h4>
</center>

";

exit;


}

?>