<?php

session_start();

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'config/config.php';
require_once 'config/lists.php';


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$userID = (int)$_POST['user'];
	$lecCode = $_POST['lecCode'];
	$professor = (int)$_POST['professor'];
	$operation = $_POST['type'];

	Lecture::requestLecture($userID, $lecCode, $professor, $operation);
	
	$logger = new Logger();
	$logger->log("LECTUREREQ", $userID, 3, "$userID, $operation, $lecCode");
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($_GET['action'] == 0) {
	if($_SESSION['userAuthType'] != 5) {
		header("location: index.php");    
	}

	if (empty($_GET['code'])){ 
		header("location: index.php");
		exit();
	}
	$lecture = Lecture::getLectureByLecCode($_GET['code']);
	$lectureInfo = $lecture->getLecCode();
	$lecture->delete();
	
	$logger = new Logger();
	$logger->log("DELETELECTURE", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a lecture: " . $lectureInfo);
	unset($logger);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

# approve
if($_GET['action'] == 1) {
	if(!in_array($_SESSION['userAuthType'], $accademic2)) {
		header("location: index.php");    
	}
	$stuID = $_GET['id'];
	$lecCode = $_GET['lecCode'];

	Lecture::approveStudent($lecCode, $stuID);

	$logger = new Logger();
	$logger->log("ENROLL", $stuID, 3, $stuID . ", enrolled " . $lecCode);
	unset($logger);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

# decline
if ($_GET['action'] == 2) {
	if(!in_array($_SESSION['userAuthType'], $accademic2)) {
		header("location: index.php");    
	}
	$stuID = $_GET['id'];
	$lecCode = $_GET['lecCode'];

	Lecture::declineStudent($lecCode, $stuID);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

# remove from lecture list
if ($_GET['action'] == 3) {
	if(!in_array($_SESSION['userAuthType'], $accademic2)) {
		header("location: index.php");    
	}
	$stuID = $_GET['id'];
	$lecCode = $_GET['lecCode'];

	Lecture::removeStudent($lecCode, $stuID);
	
	$logger = new Logger();
	$logger->log("QUIT", $stuID, 3, $stuID . ", removed " . $lecCode);
	unset($logger);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}