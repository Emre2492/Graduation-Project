<?php

session_start();
require_once 'config/config.php';

if(!($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4)) {
	header("location: index.php");    
}

if (empty($_GET['id'])){ 
	header("location: departments.php");
	exit();
}	

$dep = Department::getDepartmentByID($_GET['id']);
$preConditions = true;
$isSuccess = false;
$faculty = 0;

if (isset($_POST['submit'])) {
	if (empty(trim($_POST['abbr']))){
		$abbr_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty($_POST['chair'])){
		$dean_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($_SESSION['userAuthType'] == 1){
		if (empty($_POST['faculty'])){
			$dean_err = "Bos birakilamaz!";
			$preConditions = false;
		} else {
			$faculty = $_POST['faculty'];
		}
	} else {
		$faculty = Faculty::findStaffFaculty($_SESSION['id'])['id'];
	}

	if ($preConditions) {
		$chairNew = Staff::getStaffByID($_POST['chair']);

		$dep->setAbbr($_POST['abbr']);
		$dep->setTitle($_POST['title']);
		$dep->setChair($_POST['chair']);
		$dep->setFaculty($faculty);

		$dep->update();
		$logger = new Logger();
		$logger->log("UPDATEDEPARTMENT", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " updated " . $_POST['abbr']);
		unset($logger);

		$chairNew->setType(5);
		$chairNew->update();

		$isSuccess = true;
		$dep = Department::getDepartmentByID($_GET['id']);
	}

}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Bolum duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Bolum bilgilerini duzenle</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Bolum basari ile degistirildi!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group <?php echo (!empty($abbr_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="abbr">Bolum Kodu</label>
							<div class="col-sm-10">
								<input type="text" id="abbr" name="abbr" placeholder="Orn: ENSCI" class="form-control" value="<?= $dep->getAbbr(); ?>">
								<span class="help-block"><?php echo (!empty($abbr_err)) ? $abbr_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Bolum Basligi</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Orn: Engineering and Natural Sciences" class="form-control" value="<?= $dep->getTitle(); ?>">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($chair_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="chair">Bolum Baskani</label>
							<div class="col-sm-10">
								<select class="form-control" name="chair">
									<option disabled selected value="NA">Bir bolum baskani seciniz</option>
									<?php
										$staffList = Staff::readAll(); 

										foreach ($staffList as $staff):
									?>
										<option value="<?= $staff->getID(); ?>" <?php echo($dep->getChair() == $staff->getID()) ? 'selected' : ''; ?>><?= $staff->getName() . ' ' . $staff->getSurname(); ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($chair_err)) ? $chair_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($faculty_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="faculty">Bagli olacagi fakulte</label>
							<div class="col-sm-10">
								<select class="form-control" name="faculty" <?php echo($_SESSION['userAuthType'] == 4) ? 'disabled' : '' ; ?>>
									<option disabled selected value="NA">Bir fakulte seciniz</option>
									<?php
										$facultyList = Faculty::readAll(); 

										foreach ($facultyList as $faculty):
									?>
										<option value="<?= $faculty->getID(); ?>" <?php echo($dep->getFaculty() == $faculty->getID()) ? 'selected' : ''; ?>>(<?= $faculty->getAbbr() . ') ' . $faculty->getTitle(); ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($faculty_err)) ? $faculty_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Bolumu Guncelle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>
