<?php
session_start();

require_once 'config/config.php';

if(!in_array($_SESSION['userAuthType'], $management) {
	header("location: index.php");    
}

if($_GET['action'] == 0)
{
	$ann = Announce::getAnnounceByID($_GET['id']);
	$annID = $ann->getID();
	$ann->delete();

	$logger = new Logger();
	$logger->log("DELETEANN", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted an announcement: " . "(id=" . $annID . ")" );
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}