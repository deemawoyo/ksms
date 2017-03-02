<?php
require_once('../../configuration.php');
require_once('../../php/database.php');

$db->connect();

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$webRoot  = str_replace(array($docRoot, 'dbconnect.php'), '', $thisFile);
$srvRoot  = str_replace('dbconnect.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
define('PRODUCT_IMAGE_DIR',  'staff_images/');
define('LIMIT_PRODUCT_WIDTH',     true);
define('MAX_PRODUCT_IMAGE_WIDTH', 180);
define('THUMBNAIL_WIDTH',         180);


?>
