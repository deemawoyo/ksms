<?php
require_once('../configuration.php');
require_once('../php/database.php');
require_once('../php/student.php');
require_once('../php/configreader.php');
require_once('../php/payment.php');


$db->connect();

$st = new Student($_SESSION['student_id']);
$st->populate();

$sp = new Payment( $st);



?>
<div id='priv_esc' >
<img src='images/access.jpg' style='float:left;' />
<center>
<h2>Action requires administrative access. Enter admin password below</h2>
<p>
<table summary="" cellpadding="10" cellspacing="10" >

<tr>
<td>
<span style='font-weight: bold; font-size: 16px; height: 30px; text-align: center; font-size: 13px;'>Password</span>
</td>
<td>
&nbsp;&nbsp;&nbsp;
</td>
<td>
<input type='password' id='p_password' onchange="esc_passwd = $('#p_password').val();" onkeydown="esc_passwd = $('#p_password').val();" style='height: 30px; font-weight: bold;' />
</td>
</tr>

</table>

</p>
</center>
</div>