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

require_once("../../../configuration.php");



?>
<!DOCTYPE html>
<html>

<center>
<?php
if( ! isset($_GET['r'])  ){

?>
<script>
function confirmRestart(){
new Messi('If you proceed all information you entered will be discarded and you will have to start afresh' , {title: 'Restart Enrollment ?'  , titleClass: 'anim warning'  ,  buttons: [{id: 0, label: 'Yes', val: 'Y'}, {id: 1, label: 'No', val: 'N'}], callback: function(val) { 

if( val == 'Y'){
$.get('pages/students/enroll/process.php?restart');
new Messi('Form has been reset !' , {  autoclose: 3000});
$('#enroll_window').load('pages/students/enroll/index.php?r' );
}

}  }   );

}

</script>
<p>
<button onclick='confirmRestart()' >Restart</button>
<b>Enroll a student into the school database </b>
</p>
<div class="submenu"  id='enroll_window' >
<?php

}

?>	
		<table style='width: 100%;' />
		<tr>
			<td><a href='javascript:$("#enroll_window").load("pages/students/enroll/step1.php?type=exist");' > <img src="images/old.png" /> </a></td>
			<td></td>
			<td><a href='javascript:$("#enroll_window").load("pages/students/enroll/step1.php?type=new");' ><img src="images/new.png" /></a></td> 
		</tr>
		</table>
<?php
if( ! isset($_GET['r']) ){		

?>
		</div>
<?php
}
?>
</center>
</html>
