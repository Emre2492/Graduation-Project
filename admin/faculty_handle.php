<?php
session_start();

require_once 'config/config.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

if($_GET['action'] == 0)
{
	$faculty = Faculty::getFacultyByID($_GET['id']);
	$facultyInfo = array($faculty->getAbbr(), $faculty->getTitle());
	$faculty->delete();

	$logger = new Logger();
	$logger->log("DELETEFACULTY", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a faculty: " . $facultyInfo[0] . "(" . $facultyInfo[1] . ")" );
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}