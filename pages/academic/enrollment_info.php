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


require_once('../../configuration.php');
require_once('../../php/student.php');
require_once('../../php/payment.php');
require_once('../../php/database.php');



if( ! isset($_SESSION['student_id'] )  ){
die('No student selected sorry.');	
}

$db->connect();


$sql = "SELECT maths_units , english_units , content_units , language_units , total_units , primary_school , ed12_number 
       FROM enroll_info_form1 
       WHERE ( id = \"{$_SESSION['student_id']}\" )";
$res = mysql_query($sql);

if( ! $res ){
die('No enrollment info for this student');	
}       
if( ! mysql_affected_rows()  ){
die('NO enrollment info for this student');	
}

$data = mysql_fetch_assoc($res );

?>

<center>
	<h2 style="font-size: 16px;">Academic Info</h2>
</center>

<?php

if( mysql_affected_rows() ){
?>
<p>
<h3>Form 1 Enrollment Info</h3>
<table style="border: solid 1px green; color: black; width: 100%; font-weight: bold;">
<tr>
<td><b>Primary School</b></td>
<td><?php echo $data['primary_school']; ?></td>
</tr>
<tr>
<td><b>ED12 Number</b></td>
<td><?php echo $data['ed12_number']; ?></td>
</tr>
<tr>
<td><b>Maths Units</b></td>
<td><?php echo $data['maths_units']; ?></td>
</tr>
<tr>
<td><b>English Units</b></td>
<td><?php echo $data['english_units']; ?></td>
</tr>
<tr>
<td><b>Language</b></td>
<td><?php echo $data['language_units']; ?></td>
</tr>
<tr>
<td><b>General Paper Units</b></td>
<td><?php echo $data['content_units']; ?></td>
</tr>
</table>
<?php

mysql_free_result($res );

}

//get subjects written
$sql = "SELECT subject , grade , year_taken , session_taken FROM enroll_alevel_subjects WHERE id = \"{$_SESSION['student_id']}\" ";
$res_subjs = mysql_query($sql);
$c = mysql_affected_rows();


$sql = "SELECT prev_school FROM enroll_alevel_info WHERE id = \"{$_SESSION['student_id']}\" ";
$res_info = mysql_query($sql);

if( $c ){
$info = mysql_fetch_assoc($res_info);

?>
<h3>A'Level Enrollment Info</h3>
<table style="border: solid 1px purple; width: 100%; color: black; font-weight: bold;">
<tr>
<td><b>O'level School</b></td>
<td><?php echo $info['prev_school']; ?></td>
</tr>


<?php


for( $x = 0 ; $x < $c ; $x++){


$row = mysql_fetch_row($res_subjs );

echo "
<tr>
<td><b>{$row[0]}</b></td>
<td>{$row[1]}  ({$row[2]}/ {$row[3]} )</td>
</tr>
<tr>
";


}

?>

</table>


<?php

}

?>