<?php
session_start();

require_once 'config/config.php';
require_once 'config/lists.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

$conn = Database::getInstance();
$sql = "SELECT * FROM logs ORDER BY logID DESC";
$results = $conn->query($sql);

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Girdiler</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= SITENAME; ?> geneli etkinlik raporu</h4>
				</div>
				<div class="widget-body">
					<table class="table table-striped table-white">
						<thead>
							<tr>
								<th class="center" style="width: 4%;">#</th>
								<th style="width:auto;">Tip</th>
								<th style="width:auto;">Kullanici</th>
								<th style="width: auto;">Kullanici Tipi</th>
								<th style="width: auto;">Olay</th>
								<th style="width:auto; text-align: right;">Tarih</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while ($log = $results->fetch()) {
									echo '<tr>'.
											'<td>' . $log['logID'] . '</td>' .
											'<td>' . $log['logType'] . '</td>' .
											'<td>' . $log['user'] . '</td>' .
											'<td>' . $userType[$log['userType']] . '</td>' .
											'<td>' . $log['event'] . '</td>' .
											'<td style="text-align: right;">' . $log['eventTime'] . '</td>' .
										 '</tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>