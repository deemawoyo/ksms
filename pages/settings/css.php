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

//requires db connection and config writer

$styles = array( 'blue' , 'yellow' , 'red' , 'green' , 'orange' , 'silver' );

if( ! isset($_GET['style'] ) ){

?>
<script>
function applyCSS(){
$ne = $('#style').val();
//send get query 
$.get('pages/settings/css.change.php' , { style : $ne } , function($data){ bypass = true; window.location.reload(); } );
//wait 2 seconds before reloading page

new Messi( 'Applying Theme...... Window will reload when complete' , {title: 'Saving' , modal : true } );
}

</script>
<img src='images/styles.png' style='' />
<center>
<h3>Select Theme And Apply</h3>
<br />
<h4>Theme: 
<select id='style' style='color: black; height: 30px;  width: 250px; font-size: 16px;' >
<option >Current</option>
<?php
foreach( $styles as $s ){
echo "<option value=\"$s\" >$s</option>\n";
}

?>

</select>

</h4>
<button onclick='applyCSS()' >Apply and Reload</button>
</center>
<p>If you don't like the theme you can select another one</p>
<?php
exit;
}else{

?>


<?php

}

?>
