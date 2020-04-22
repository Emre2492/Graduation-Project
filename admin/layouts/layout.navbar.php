<?php

switch ($_SESSION['userAuthType']) {
	case 3:
		require_once 'navbar/layout.navbar.student.php';
		break;
	
	default:
		require_once 'navbar/layout.navbar.staff.php';
		break;
}