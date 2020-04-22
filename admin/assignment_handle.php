<?php
session_start();

require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}	

if($_GET['action'] == 0)
{
	$assignment = Assignment::getAssignmentsByID($_GET['id']);
	$assignmentInfo = $assignment->getID();
	$assignment->delete();

	$logger = new Logger();
	$logger->log("DELETEHW", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a hw: " . $assignmentInfo);
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}