<?php

session_start();
require_once 'config/config.php';

if(!($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4)) {
	header("location: index.php");    
}

require_once 'layouts/layout.header.php';

if($_SESSION['userAuthType'] == 1){
	$departments = Department::readAll();
} else {
	$departments = Department::readDeanDepartments($_SESSION['id']);
}

$faculties = Faculty::getAllFacultyAbbrList();
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Bolumler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= SITENAME; ?> Bolumler</h4>
				<div class="row innerAll half border-bottom">
					<?php if(!empty($departments)){ ?>
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th class="center" style="width:2%;">Bolum Kodu</th>
								<th style="width:23%;">Bolum Basligi</th>
								<th style="width:auto;">Bolum Baskani</th>
								<th style="width: auto;">Fakulte</th>
								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($departments as $department) {
								$chair = Staff::getStaffByID($department->getChair());

								echo '<tr>'.
										'<td class="center">' . $department->getID() . '</td>' .
										'<td>' . $department->getAbbr() . '</td>' . 
										'<td>' . $department->getTitle() . '</td>' .
										'<td>' . $chair->getName() . ' ' . $chair->getSurname() . '</td>' .
										'<td>' . $faculties[$department->getFaculty()] . '</td>' .
										'<td class="center"><a href="edit_department.php?id=' . $department->getID() . '"><i class="fa fa-edit"></i></a> | <a href="department_handle.php?id='. $department->getID() .  '&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php } else { ?>
					<div class="widget-body">
						<p>Herhangi bir bolum bilgisine erisilemedi.</p>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>