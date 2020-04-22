<?php
session_start();
require_once 'config/config.php';

if($_SESSION['userAuthType'] != 1)
	header("location: index.php");

if($_GET['action'] == 0)
{
	$user = User::getUserByID($_GET['id'], $_GET['type']+1);
	$userInfo = $_GET['id'];
	$user->delete();

	$logger = new Logger();
	$logger->log("DELETEUSER", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a user id:", $_GET['id'], " type: " . $_GET['type']+1);
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


