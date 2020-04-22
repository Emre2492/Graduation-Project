<?php

session_start();
require_once 'config/config.php';

/*if ($_SESSION['userAuthType'] != 3) {
	header("location: index.php");
}*/

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';
switch ($_SESSION['userAuthType']) {
	case 3:
		$lectures = Lecture::getStudentLectureList($_SESSION['id']);
		break;
	
	case 1:
	case 2:
	case 4:
	case 5:
		$lectures = Lecture::getStaffLectures($_SESSION['id']); 
		break;
}

?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Derslerim</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?php echo($_SESSION['userAuthType'] == 3) ? 'Aldigim' : 'Verdigim'; ?> Dersler</h4>
				<div class="row innerAll half border-bottom">
					<?php if(!empty($lectures)){ ?>
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th class="center" style="width:2%;">Ders Kodu</th>
								<th style="width:23%;">Dersi veren akademisyen</th>
								<th style="width:auto;">Dersin basligi</th>
								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$count = 1; 
							foreach ($lectures as $lecture) {
								$professor = Staff::getStaffByID($lecture->getProfessor());

								echo '<tr>'.
										'<td class="center">' . $count++ . '</td>' .
										'<td>' . $lecture->getLecCode() . '</td>' .
										'<td>' . $professor->getName() . ' ' . $professor->getSurname() . '</td>' .
										'<td>' . $lecture->getTitle() . '</td>' .
										'<td class="center"><a href="lecture_page.php?code=' . $lecture->getLecCode() . '"><i class="fa fa-eye"></i></a></td>' . 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php } else { ?>
					<div class="widget-body">
						<p>Uzerinize kayitli ders bulunamadi.</p>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="clearfix"></div>
			<?php 
				$enrollmentQueue = Lecture::getStudentEnrollmentQueue($_SESSION['id']);
				if(!empty($enrollmentQueue)) { 
			?>
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Onay Bekleyen Islemlerim</h4>
				<div class="row innerAll half border-bottom">
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th class="center" style="width:2%;">Ders Kodu</th>
								<th style="width:23%;">Dersi veren akademisyen</th>
								<th style="width:auto;">Dersin basligi</th>
								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$count = 1; 
							foreach ($enrollmentQueue as $lecture) {
								$professor = Staff::getStaffByID($lecture->getProfessor());

								echo '<tr>'.
										'<td class="center">' . $count++ . '</td>' .
										'<td>' . $lecture->getLecCode() . '</td>' .
										'<td>' . $professor->getName() . ' ' . $professor->getSurname() . '</td>' .
										'<td>' . $lecture->getTitle() . '</td>' .
										'<td class="center"><a href="lecture_page.php?code=' . $lecture->getLecCode() . '"><i class="fa fa-eye"></i></a></td>' . 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php } ?>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>