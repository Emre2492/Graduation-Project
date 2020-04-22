<?php
session_start();
require_once 'config/config.php';

$logger = new Logger();
$logger->log("LOGOUT", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " logged out.");
$logger = null;

$_SESSION = array();
session_unset();
session_destroy();

header("location: ../index.php");
exit();
?>