<?php 

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';

switch ($_SESSION['userAuthType']) {
	case 3:
		$lectures = Lecture::getUserTimeSchedule($_SESSION['id']);
		break;
	
	default:
		$lectures = Lecture::getStaffTimeSchedule($_SESSION['id']);
		break;
}

?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Ders Programim</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<?php if(!empty($lectures)): ?>
			<table class="table table-bordered table-striped table-white">
			<thead>
				<tr>
					<th class="center" style="width: 5%;"></th>
					<th class="center" style="width:19%;">Pazartesi</th>
					<th class="center" style="width:19%;">Sali</th>
					<th class="center" style="width:19%;">Carsamba</th>
					<th class="center" style="width:19%;">Persembe</th>
					<th class="center" style="width:19%;">Cuma</th>
				</tr>
			</thead>
			<tbody>
				<?php
					#rows
					$bTime = "09";
					for ($row=0; $row<11; $row++){
						echo "<tr>
								<td><b>" . $bTime++ . ":00</b></td>";
						#columns
						for ($column=1; $column<6; $column++){
							echo "<td><center>";
							if(!empty($lectures[$row][$column-1])){
								foreach ($lectures[$row][$column-1] as $val) {
									echo "$val<br>";
								}
							}
							echo '</center></td>';
						}
						echo "</tr>";
					}
					?>
			</tbody>
			<?php else: ?>
				<h1>Kayitli ders programiniz yok</h1>
			<?php endif; ?>
		</div>

	</div>

	<?php require_once 'layouts/layout.footer.php'; ?>