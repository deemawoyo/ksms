<?php


$type = $_GET['type'];
///check if the amount given is less than the max amount
if( $type == 'amount' ){
	
$check = floatval( $_GET['from_db'] );
$typed = floatval( $_GET['selected'] );

if( ( $check < $typed ) or ($typed == 0.00 ) )die('smallx.png');

die('smalltick.png');	
}
//check if the receipt is valid
if( $type == 'recpt' ){


$typed = $_GET['selected'];

if( ( strlen($typed) < 3 ) or ( strlen($typed) > 12 ) )die('smallx.png');

die('smalltick.png');	
	
}

?>