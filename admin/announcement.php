<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';
$facultyAnns = Announce::getAnnouncesByKey(Faculty::getFacultyByID($_SESSION['faculty'])->getAbbr(), 15);
$departmentAnns = Announce::getAnnouncesByKey(Department::getDepartmentByID($_SESSION['department'])->getAbbr(), 15);
$generalAnns = Announce::getAnnouncesByKey("ALL", 15);
?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Duyurular ve etkinlikler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Bolum Duyurulari</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if(!empty($departmentAnns)) { ?>
							<table class="table table-striped table-white">
								<thead>
									<tr>
										<th class="center" style="width: 4%;">#</th>
										<th style="width:auto;">Baslik</th>
										<th style="width:auto;">Icerik</th>
									<th style="width:auto; text-align: right;">Tarih</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$i = 1;
									foreach ($departmentAnns as $ann) {
										echo '<tr>'.
											 '<td>' . $i++ . '</td>' .
											 '<td>' . $ann->getTitle() . '</td>' .
											 '<td>' . $ann->getContent() . '</td>' .
											 '<td style="text-align: right;">' . $ann->getCreated() . '</td>' .
											 '</tr>'
										;
									}
								?>
								</tbody>
							</table>
							<?php } else { ?>
							<p>Bolum duyurusu bulunamadi.</p>
							<?php } ?>
						</div>
						<div class="clearfix"></div>	
					</div>
				</div>
			</div>	
				
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Fakulte duyurulari</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if(!empty($facultyAnns)) { ?>
							<table class="table table-striped table-white">
								<thead>
									<tr>
										<th class="center" style="width: 4%;">#</th>
										<th style="width:auto;">Baslik</th>
										<th style="width:auto;">Icerik</th>
										<th style="width:auto; text-align: right;">Tarih</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 1; 
									foreach ($facultyAnns as $ann) {
										echo '<tr>'.
											'<td class="center">' . $count++ . '</td>' .
											'<td>' . $ann->getTitle() . '</td>' .
											'<td>' . $ann->getContent() . '</td>' .
											'<td style="text-align: right;">' . $ann->getCreated() . '</td>' .
										 '</tr>';
									}
									?>
								</tbody>
							</table>
							<?php } else { ?>
								<p>Fakulte duyurusu bulunamadi.</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Rektorluk duyurulari</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if(!empty($generalAnns)) { ?>
							<table class="table table-striped table-white">
								<thead>
									<tr>
										<th class="center" style="width: 4%;">#</th>
										<th style="width:auto;">Baslik</th>
										<th style="width:auto;">Icerik</th>
										<th style="width:auto; text-align: right;">Tarih</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 1; 
									foreach ($generalAnns as $ann) {
										echo '<tr>'.
											'<td class="center">' . $count++ . '</td>' .
											'<td>' . $ann->getTitle() . '</td>' .
											'<td>' . $ann->getContent() . '</td>' .
											'<td style="text-align: right;">' . $ann->getCreated() . '</td>' .
										 '</tr>';
									}
									?>
								</tbody>
							</table>
							<?php } else { ?>
								<p>Rektorluk duyurusu bulunamadi.</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php'; ?>