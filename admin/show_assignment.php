<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

if (empty($_GET['id'])){ 
	header("location: library.php");
	exit();
}

require_once 'layouts/layout.header.php';
$assignment = Assignment::getAssignmentsByID($_GET['id']);
$lecture = Lecture::getLectureByLecCode($assignment->getLecCode());
$isProfessor = $lecture->getProfessor() == $_SESSION['id'];
$isSuccess = false;
$alreadSent = Stuassignment::isAlreadySent($assignment->getID(), $_SESSION['id']);

if (isset($_POST['submit'])) {

	if($_POST['mode'] == 'acc'){
		foreach ($_POST as $key => $value) {
			if (is_numeric($key)) {
				$a = Stuassignment::getAssignmentByID($key);
				$a->setGrade($value);
				$a->update();
			}
		}

		$logger = new Logger();
		$logger->log("SETGRADE", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " graded, id:" . $_GET['id']);
		$isSuccess = true;
	}

	if($_POST['mode'] == 'stu'){
		$uploadDirectory = 'uzemFiles/stuassignments/';

   		$dotdot = ".";
    	$fileFull = $_FILES['hw']['name'];
    	$expl = explode($dotdot, $fileFull);
    	$extension = end($expl);
    	$uploadFileName = $assignment->getID() . '_' . $_SESSION['id'] . '.' . $extension;
    	$feedback = move_uploaded_file($_FILES['hw']['tmp_name'], $uploadDirectory.$uploadFileName);

    	if ($feedback) {
        	$tmp = new Stuassignment();
        	$tmp->setStudent($_SESSION['id']);
        	$tmp->setAssignment($assignment->getID());
        	$tmp->setFile($uploadFileName);
        	$tmp->create();

			$logger = new Logger();
			$logger->log("SENDHW", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " sent a homework");
			unset($logger);

			$isSuccess = true;
			$alreadSent = true;
    	}
	}
}
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Odev</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= $assignment->getTitle(); ?></h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if ($isProfessor): ?>
							<a href="edit_assignment.php?id=<?= $_GET['id']; ?>" class="btn btn-primary pull-right">Odevi Duzenle</a>
							<a href="assignment_handle.php?id=<?= $_GET['id']; ?>&action=0" class="btn btn-primary pull-right">Odevi Sil</a>
							<?php endif; ?>
							<ul class="list-unstyled">
								<li><b>Ders:</b> <?= $assignment->getLecCode(); ?></li>
								<li><b>Baslik:</b> <?= $assignment->getTitle(); ?></li>
								<li><b>Son Teslim Tarihi:</b> <?= $assignment->getDueDate(); ?></li>
								<li>
									<b>Aciklama:</b><br>
									<?= $assignment->getContent();?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<?php if($isProfessor): ?>
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Odev islemleri</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if($isSuccess): ?>
							<div class="alert alert-success">
  								<strong>Basarili!</strong> Notlar basari ile kaydedildi.
							</div>
							<?php endif; ?>
							<form method="post" action="">
								<table class="table table-bordered table-striped table-white">
									<thead>
										<th>#</th>
										<th>Ogrenci No</th>
										<th>Ogrenci Ad Soyad</th>
										<th>Odev Dosyasi</th>
										<th>Gonderim Tarihi</th>
										<th>Not</th>
									</thead>
									<tbody>
										<?php
										$stuAssignments = Stuassignment::getStudentAssignmentsByAssignmentID($_GET['id']);
										foreach ($stuAssignments as $assign) {
											$stu = Student::getStudentByID($assign->getStudent());
											echo '<tr>' .
											  	 	'<td>' . $assign->getID() . '</td>' .
											  	 	'<td>' . $stu->getID() . '</td>' .
											  	 	'<td>' . $stu->getName() . ' ' . $stu->getSurname() . '</td>' .
											  	 	'<td>' . '<a href="uzemFiles/stuassignments/' . $assign->getFile() . '">' . $assign->getFile() . '</a></td>' .
											  	 	'<td>' . $assign->getTimestamp() . '</td>' .
											  	 	'<td> <input type="text" name="' . $assign->getID() . '" class="form-control input-sm" value="' . $assign->getGrade() . '"></td>' .
											  	 '</tr>'	
											;
										}
										?>
									</tbody>
								</table>
								<input type="hidden" name="mode" value="acc">
								<button class="btn btn-primary pull-right" type="submit" name="submit"><i class="fa fa-check" aria-hidden="true"></i> Notlandir</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if($_SESSION['userAuthType'] == 3): ?>
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Odev islemleri</h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if($isSuccess): ?>
							<div class="alert alert-success">
  								<strong>Basarili!</strong> Odev basari ile gonderildi.
							</div>
							<?php endif; ?>
							<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
								<?php if($assignment->getDueDate() < date("Y-m-d H:i:s")) { ?>
									<b><font color="red">Odev teslim tarihi gecti. Herhangi bir odev islemi yapamazsiniz!</font></b>
								<?php  } elseif ($alreadSent) { ?>
									<b>Bu odev icin daha once bir dosya gondermissiniz.</b>
								<?php } else { ?>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="hw">Odev dosyanizi seciniz:</label>
										<div class="col-sm-5">
											<input type="file" name="hw" class="form-control">
											<input type="hidden" name="mode" value="stu">
										</div>
										<div class="col-sm-1">
											<button type="submit" class="btn btn-primary" name="submit">Gonder</button>
										</div>
									</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>