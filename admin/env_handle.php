<?php
session_start();

require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}	

if($_GET['action'] == 0)
{
	$uploadDirectory = 'uzemFiles/envs/';
	$env = Environment::getEnvByID($_GET['id']);
	unlink($uploadDirectory.$env->getPath());
	$env->delete();	

	$logger = new Logger();
	$logger->log("DELETEENV", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . ", deleted an environment.");
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}