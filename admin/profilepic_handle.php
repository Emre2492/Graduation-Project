<?php
session_start();

require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

if($_GET['action'] == 0)
{
	$user = User::getUserByID($_SESSION['id'], $_SESSION['userAuthType']);
	$uploadDirectory = '../assets/images/profile_pics/';

	if($user->getImage() != null)
    	unlink($uploadDirectory.$user->getImage());

    $user->setImage(null);
    $user->update();
    $_SESSION['image'] = null;	

	$logger = new Logger();
	$logger->log("DELETEPROFILEPIC", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . ", deleted their profile picture");
	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}