<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if($_SESSION['userAuthType'] != 5) {
	header("location: index.php");    
}	

if (empty($_GET['code'])){ 
	header("location: index.php");
	exit();
}

$lecture = Lecture::getLectureByLecCode($_GET['code']);
$preConditions = true;
$isSuccess = false;

$prsJSON = json_decode($lecture->getPersentages());
$quiz = $prsJSON->{'quiz'};
$midterm = $prsJSON->{'midterm'};
$final = $prsJSON->{'final'};
$project = $prsJSON->{'project'};
$attempt = (string)$prsJSON->{'attempt'};

if (isset($_POST['submit'])) {

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (!empty(trim($_POST['quiz']))){
		$quiz = (int)$_POST['quiz']; 
	}

	if (!empty(trim($_POST['midterm']))){
		$midterm = (int)$_POST['midterm'];
	}

	if (!empty(trim($_POST['final']))){
		$final = (int)$_POST['final'];
	}

	if (!empty(trim($_POST['project']))){
		$project = (int)$_POST['project'];
	}

	if ($_POST['attempt'] == 'true'){
		$attempt = true;
	} else {
		$attempt = false;
	}

	if (empty($_POST['acc'])){
		$acc_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$pers = array('quiz' => $quiz, 'midterm' => $midterm, 'final' => $final, 'project' => $project, 'attempt' => $attempt);
		$persJSON = json_encode($pers);
		$dep = Department::findStaffDepartment($_SESSION['id'])['id'];

		$tempObj = new Lecture();
		$tempObj->setTitle($_POST['title']);
		$tempObj->setProfessor($_POST['acc']);
		$tempObj->setPersentages($persJSON);
		$tempObj->setDepartment($dep);


		$tempObj->update();
		$logger = new Logger();
		$logger->log("CREATELECTURE", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " updated " . $_GET['code']);
		unset($logger);

		$isSuccess = true;
	}

}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Ders Duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Ders Bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Ders basari ile duzenlendi!
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="abbr">Ders Kodu:</label>
							<div class="col-sm-10">
								<input type="text" id="abbr" name="abbr" placeholder="Orn: ENSCI" class="form-control" value="<?= $lecture->getLecCode(); ?>" disabled>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Ders Basligi:</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Orn: Artificial Intelligence" class="form-control" value="<?= $lecture->getTitle(); ?>">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="quiz">Quiz yuzdesi:</label>
							<div class="col-sm-10">
								<input type="text" id="quiz" name="quiz" placeholder="Quiz yuzdesi" class="form-control" value="<?= $quiz; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="midterm">Vize yuzdesi:</label>
							<div class="col-sm-10">
								<input type="text" id="midterm" name="midterm" placeholder="Vize yuzdesi" class="form-control" value="<?= $midterm; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="final">Final yuzdesi:</label>
							<div class="col-sm-10">
								<input type="text" id="final" name="final" placeholder="Final yuzdesi" class="form-control" value="<?= $final; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="project">Proje yuzdesi:</label>
							<div class="col-sm-10">
								<input type="text" id="project" name="project" placeholder="Proje yuzdesi" class="form-control" value="<?= $project; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="attempt">Devam zorunlulugu:</label>
							<div class="col-sm-10">
								<select class="form-control" name="attempt">
									<option disabled>Seciniz</option>
									<option value="true" <?php echo($attempt == true) ? 'selected' : ''; ?>>Zorunlu</option>
									<option value="false" <?php echo($attempt == false) ? 'selected' : ''; ?>>Zorunlu degil</option>
								</select>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($acc_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="acc">Dersi verecek akademisyen:</label>
							<div class="col-sm-10">
								<select class="form-control" name="acc">
									<option disabled selected value="NA">Bir akademisyen seciniz</option>
									<?php
										$staffList = Staff::readAll(); 

										foreach ($staffList as $staff):
									?>
										<option value="<?= $staff->getID(); ?>" <?php echo($staff->getID() == $lecture->getProfessor()) ? 'selected' : ''; ?>><?= $staff->getName() . ' ' . $staff->getSurname(); ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($acc_err)) ? $acc_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Dersi Duzenle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>