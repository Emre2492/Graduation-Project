<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $management)) {
	header("location: index.php");    
}

switch ($_SESSION['userAuthType']) {
	case 1:
		$anns = Announce::readAll();
		break;
	
	case 4:
		$faculty = Faculty::findStaffFaculty($_SESSION['id']);
		$anns = Announce::getAnnouncesByKey($faculty['abbr'], null);
		break;

	case 5:
		$department = Department::findStaffDepartment($_SESSION['id']);
		$anns = Announce::getAnnouncesByKey($department['abbr'], null);
		break;

	default:
		# code...
		break;
}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Duyurular</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= SITENAME; ?> tum duyurular listesi</h4>
				</div>
				<div class="widget-body">
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width:auto;">Baslik</th>
								<th style="width:auto;">Icerik</th>
								<th style="width: auto;">Tarih</th>
								<th style="width: auto;">Hedef</th>
								<th style="width:auto; text-align: right;">Baglantilar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($anns as $ann) {
									echo '<tr>'.
											'<td>' . $ann->getID() . '</td>' .
											 '<td>' . $ann->getTitle() . '</td>' .
											 '<td>' . $ann->getContent() . '</td>' .
											 '<td>' . $ann->getCreated() . '</td>' .
											 '<td>' . $ann->getAnnTo() . '</td>' .
											 '<td style="text-align: right;"><a href="edit_ann.php?id=' . $ann->getID() . '"><i class="fa fa-edit"></i></a> | <a href="ann_handle.php?id='. $ann->getID() .  '&action=0"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>' .
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