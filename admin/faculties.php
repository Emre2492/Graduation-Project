<?php

session_start();
require_once 'config/config.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

require_once 'layouts/layout.header.php';
$faculties = Faculty::readAll();
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Fakulteler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= SITENAME; ?> Fakulteler</h4>
				<div class="row innerAll half border-bottom">
					<?php if(!empty($faculties)){ ?>
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th class="center" style="width:2%;">Fakulte Kodu</th>
								<th style="width:23%;">Fakulte Basligi</th>
								<th style="width:auto;">Dekan</th>
								<th class="center" style="width:8%;">Baglanti</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($faculties as $faculty) {
								$dean = Staff::getStaffByID($faculty->getDean());

								echo '<tr>'.
										'<td class="center">' . $faculty->getID() . '</td>' .
										'<td>' . $faculty->getAbbr() . '</td>' . 
										'<td>' . $faculty->getTitle() . '</td>' .
										'<td>' . $dean->getName() . ' ' . $dean->getSurname() . '</td>' .
										'<td class="center"><a href="edit_faculty.php?id=' . $faculty->getID() . '"><i class="fa fa-edit"></i></a> | <a href="faculty_handle.php?id='. $faculty->getID() .  '&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>'. 
									 '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php } else { ?>
					<div class="widget-body">
						<p>Herhangi bir fakulte bilgisine erisilemedi.</p>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>