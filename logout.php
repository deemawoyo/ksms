<?php
require_once("php/session.php");
$ss = new Session();
$ss->logout();
header("Location: login.php");
exit;
?>
