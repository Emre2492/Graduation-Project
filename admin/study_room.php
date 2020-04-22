<?php 

session_start();
require_once 'config/config.php';

if (empty($_GET['roomNum'])){ 
	header("location: library.php");
	exit();
}

if ($_SESSION['userAuthType'] != $_GET['roomNum']){ 
	header("location: library.php");
	exit();
}

if (isset($_POST['submit'])) {
	$logger = new Logger();
	$appDates = array();

	foreach ($_POST as $key => $value) {
		if(stristr($key, 'timeVal') == TRUE){
			$json_data = (array) json_decode($value);
			$appointment = new Appointment();
			$appointment->setRowIndex($json_data['row']);
			$appointment->setColumnIndex($json_data['column']);
			$appointment->setUserEmail($_SESSION['email']);
			$appointment->setRoomNum($_SESSION['userAuthType']);

			$appointment->create();
			$appDates[] = array("row" => $json_data['row'], "column" => $json_data['column']);
		}
	}
	$logInfo = json_encode($appDates);
	$logger->log("RENTROOM", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " rented " . $logInfo);
}

require_once 'layouts/layout.header.php';
$appointments = Appointment::readAll($_GET['roomNum']);
?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Calisma odasi randevu</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<form action="" method="post">
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
					$i = 1;
					for ($row=0; $row<11; $row++){
						echo "<tr>
								<td><b>" . $bTime++ . ":00</b></td>";
						#columns
						for ($column=1; $column<6; $column++){
							echo "<td><center>";
							if(!empty($appointments[$row][$column-1]))
								continue;
							else 
								echo '<input type="checkbox" name="timeVal'. $i .'" value="{&quot;row&quot; :' . $row . ', &quot;column&quot; :' .  ($column-1) . '}">';
							
							echo '</center></td>';
							$i++;
						}
						echo "</tr>";
					}
					?>
					</tbody>
				</table>
				<div class="form-group pull-right">
					<button class="btn btn-primary" type="submit" name="submit">Kirala</button>
				</div>
			</form>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php'; ?>