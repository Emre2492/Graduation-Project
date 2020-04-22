<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

$students = Student::readAll();
$faculties = Faculty::getAllFacultyAbbrList();
$departments = Department::getAllDepartmentAbbrList();
require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Ogrenciler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= SITENAME; ?> ogrenciler listesi</h4>
				</div>
				<div class="widget-body">
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width:auto;">Email</th>
								<th style="width:auto;">Ad</th>
								<th style="width: auto;">Soyad</th>
								<th style="width: auto;">Fakulte</th>
								<th style="width: auto;">Bolum</th>
								<th style="width:auto; text-align: right;">Baglantilar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($students as $student) {
									echo '<tr>'.
											'<td>' . $student->getID() . '</td>' .
											 '<td>' . $student->getEmail() . '</td>' .
											 '<td>' . $student->getName() . '</td>' .
											 '<td>' . $student->getSurname() . '</td>' .
											 '<td>' . $faculties[$student->getFaculty()] . '</td>' .
											 '<td>' . $departments[$student->getDepartment()] . '</td>' .
											 '<td style="text-align: right;"><a href="edit_people.php?id=' . $student->getID() . '&type=2"><i class="fa fa-edit"></i></a> | <a href="people_handle.php?id='. $student->getID() .  '&type=2&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>' .
										  '</tr>'
										;
									}
								?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<?php require_once 'layouts/layout.footer.php';	?>