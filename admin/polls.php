<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';

switch ($_SESSION['userAuthType']) {
	
	#rektor
	case 1:
		$polls = Poll::readAll();
		break;
	
	#akademisyen
	case 2:
		$polls = Poll::professorsPolls($_SESSION['id']);
		break;

	case 3:
		$allPoll = Poll::search('ALL');
		$faculty = Faculty::getFacultyByID($_SESSION['faculty']);
		$department = Department::getDepartmentByID($_SESSION['department']);
		$facultyPolls = Poll::search($faculty->getAbbr());
		$departmentPolls = Poll::search($department->getAbbr());

	#dekan
	case 4:
		$deansFaculty = Faculty::findStaffFaculty($_SESSION['id']);
		$polls = Poll::search($deansFaculty['abbr']);
		break;

	#bolum baskani
	case 5:
		$chairsDepartment = Department::findStaffDepartment($_SESSION['id']);
		$polls = Poll::search($chairsDepartment['abbr']);
		break;
}

$faculties = Faculty::getAllFacultyAbbrList();
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Anketler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= SITENAME; ?> anketler</h4>
				<div class="row innerAll half border-bottom">
					
					<?php if ($_SESSION['userAuthType'] == 3): ?>
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width: auto;">Baslik</th>
								<th class="center" style="width: auto;">Hedef</th>

								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($allPoll as $poll) {
								echo '<tr>'.
										'<td class="center">' . $poll->getID() . '</td>' .
										'<td>' . $poll->getTitle() . '</td>' . 
										'<td class="center">' . $poll->getPollTo() . '</td>' .
										'<td class="center"><a href="show_poll.php?id=' . $poll->getID() .'"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
							foreach ($facultyPolls as $poll) {
								echo '<tr>'.
										'<td class="center">' . $poll->getID() . '</td>' .
										'<td>' . $poll->getTitle() . '</td>' . 
										'<td class="center">' . $poll->getPollTo() . '</td>' .
										'<td class="center"><a href="show_poll.php?id=' . $poll->getID() .'"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
							foreach ($departmentPolls as $poll) {
								echo '<tr>'.
										'<td class="center">' . $poll->getID() . '</td>' .
										'<td>' . $poll->getTitle() . '</td>' . 
										'<td class="center">' . $poll->getPollTo() . '</td>' .
										'<td class="center"><a href="show_poll.php?id=' . $poll->getID() .'"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php endif ?>

					<?php if($_SESSION['userAuthType'] != 3): ?>
					<?php if(!empty($polls)){ ?>
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width: auto;">Baslik</th>
								<th class="center" style="width: auto;">Hedef</th>

								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($polls as $poll) {
								echo '<tr>'.
										'<td class="center">' . $poll->getID() . '</td>' .
										'<td>' . $poll->getTitle() . '</td>' . 
										'<td class="center">' . $poll->getPollTo() . '</td>' .
										'<td class="center"><a href="show_poll.php?id=' . $poll->getID() .'"><i class="fa fa-eye" aria-hidden="true"></i></a> | <a href="poll_handle.php?id='. $poll->getID() .  '&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php } else { ?>
					<div class="widget-body">
						<p>Herhangi bir anket bulunamadi.</p>
					</div>
					<?php } 
					endif;
					?>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>