<?php 

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if (!in_array($_SESSION['userAuthType'], $accademic2)){ 
	header("location: time_schedule.php");
	exit();
}

if (empty($_GET['lecCode']))
	$mode = false;
else {
	$mode = true;
	$currentTS = Lecture::getLectureTimeSchedule($_GET['lecCode']);
}

if (isset($_POST['submit'])) {
	$logger = new Logger();

	Lecture::clearPreviousTimeSchedule($_GET['lecCode']);

	foreach ($_POST as $key => $value) {
		if(stristr($key, 'timeVal') == TRUE){
			$json_data = (array) json_decode($value);
			$rowData = $json_data['row'];
			$columnData = $json_data['column'];

			Lecture::adjustTimeTable($_GET['lecCode'], $rowData, $columnData);
		}
	}
	$logger->log("CHANGETS", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " changed time schedule " . $_GET['lecCode']);

	$currentTS = Lecture::getLectureTimeSchedule($_GET['lecCode']);
}

require_once 'layouts/layout.header.php';
$lectures = lecture::getStaffLectures($_SESSION['id']);
?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Ders programini duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<form method="get" action="" class="form-horizontal">
				<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
					<label class="col-sm-1 control-label" for="lecture">Ders:</label>
					<div class="col-sm-10">
						<select name="lecCode" class="form-control" id="lecCode">
						<?php foreach($lectures as $lec): ?>
							<option value="<?= $lec->getLecCode(); ?>" <?php echo($lec->getLecCode() == $_GET['lecCode']) ? 'selected' : ''; ?>><?= '(' . $lec->getLecCode() . ') ' . $lec->getTitle(); ?></option>
						<?php endforeach; ?>
						</select>
						<span class="help-block"><?php echo (!empty($name_err)) ? $name_err : ''; ?></span>
					</div>
					<div class="col-sm-1">
						<button class="btn btn-primary" type="submit">Getir</button>
					</div>
				</div>
			</form>
			<?php if($mode): ?>
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
							if(!empty($currentTS[$row][$column-1]))
								echo '<input type="checkbox" name="timeVal' . $i .'" value="{&quot;row&quot; :' . $row . ', &quot;column&quot; :' .  ($column-1) . '}" checked>';
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
					<button class="btn btn-primary" type="submit" name="submit">Programi duzenle</button>
				</div>
			</form>
			<?php endif;?>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php'; ?>