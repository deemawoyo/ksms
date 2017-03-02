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

require_once("../../php/configreader.php");


$db->connect();

$cfgr = new ConfigReader();

$cfgr->populate();

if( isset($_GET['style'] ) ){
if( $_GET['style'] != 'curent' )
$cfgr->set('css_theme' , $_GET['style'] );
echo "done";
exit;
}
echo "nothing changed";
exit;
?>
