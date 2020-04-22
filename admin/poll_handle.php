<?php
session_start();

require_once 'config/config.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}

if($_GET['action'] == 0)
{
	$poll = Poll::getPollByID($_GET['id']);
	$pollInfo = $poll->getID();
	$poll->delete();

	$logger = new Logger();
	$logger->log("DELETEPOLL", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a poll: " ."(" . $pollInfo . ")" );
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}