<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

$staffs = Staff::readAll();
require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Calisanlar</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= SITENAME; ?> calisanlar listesi</h4>
				</div>
				<div class="widget-body">
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width:auto;">Email</th>
								<th style="width:auto;">Ad</th>
								<th style="width: auto;">Soyad</th>
								<th style="width: auto;">Oda</th>
								<th style="width: auto;">Unvan</th>
								<th style="width:auto; text-align: right;">Baglantilar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($staffs as $staff) {
									echo '<tr>'.
											'<td>' . $staff->getID() . '</td>' .
											 '<td>' . $staff->getEmail() . '</td>' .
											 '<td>' . $staff->getName() . '</td>' .
											 '<td>' . $staff->getSurname() . '</td>' .
											 '<td>' . $staff->getRoom() . '</td>' .
											 '<td>' . $userType[$staff->getType()] . '</td>' .
											 '<td style="text-align: right;"><a href="edit_people.php?id=' . $staff->getID() . '&type=1"><i class="fa fa-edit"></i></a> | <a href="people_handle.php?id='. $staff->getID() .  '&type=1&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>' .
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