<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if($_SESSION['userAuthType'] != 3) {
	header("location: index.php");    
}

$grades = Stuassignment::getStuGrades($_SESSION['id']);
require_once 'layouts/layout.header.php';

?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Notlarim</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Not Listesi</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<table class="table table-bordered table-striped table-white">
								<thead>
									<tr>
										<th>#</th>
										<th>Ders Kodu</th>
										<th>Odev Basligi</th>
										<th>Not</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$count = 1;
										foreach ($grades as $grade) {
											echo '<tr>' .
													'<td>' . $count++ . '</td>' .
													'<td>' . $grade['lecCode'] . '</td>' .
													'<td>' . $grade['title'] . '</td>' .
													'<td>' . $grade['grade'] . '</td>';										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>