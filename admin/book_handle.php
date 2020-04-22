<?php

session_start();

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");
	exit();    
}

require_once 'config/config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$userEmail = $_POST['userEmail'];
	$bookID = $_POST['bookID'];
	$returnDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 15, date('Y')));
	$type = strtolower($_POST['type']);

	Book::bookRentalOperations($userEmail, $bookID, $returnDate, $type);

	$logger = new logger();

	//TODO
	if($type == 'rent')
		$logger->log(strtoupper($type . 'book'), $_SESSION['id'], $_SESSION['userAuthType'],  $_SESSION['id'] ." rented book,id=$bookID");
	elseif ($type == 'return') {
		$logger->log(strtoupper($type . 'book'), $_SESSION['id'], $_SESSION['userAuthType'],  $_SESSION['id'] ." returned book,id=$bookID");
	}

	unset($logger);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($_GET['action'] == 0) {
	if(!($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4)) {
		header("location: library.php");    
	}

	if (empty($_GET['id'])){ 
		header("location: library.php");
		exit();
	}

	$book = Book::getBookByID($_GET['id']);
	$bookInfo = array($book->getID(), $book->getISBN());
	$book->delete();

	$logger = new Logger();
	$logger->log("DELETEBOOK", $_SESSION['id'], 1, $_SESSION['id'] . ", deleted a book: " . $bookInfo[0] . "(" . $bookInfo[1] . ")" );
	unset($logger);

	header('Location: library.php');
}