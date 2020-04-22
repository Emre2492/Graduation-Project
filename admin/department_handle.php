<?php
session_start();

require_once 'config/config.php';

if(!($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4)) {
	header("location: index.php");    
}

if($_GET['action'] == 0)
{
	if (empty($_GET['id'])){ 
		header("location: departments.php");
		exit();
	}
	
	$department = Department::getDepartmentByID($_GET['id']);
	$departmentInfo = array($department->getAbbr(), $department->getTitle());
	$department->delete();

	$logger = new Logger();
	$logger->log("DELETEDEPARTMENT", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a department: " . $departmentInfo[0] . "(" . $departmentInfo[1] . ")" );
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}