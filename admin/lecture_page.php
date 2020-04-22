<?php

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

if (empty($_GET['code'])){ 
	header("location: add_lecture.php");
	exit();
}

try {
	$lecture = Lecture::getLectureByLecCode($_GET['code']);
} catch (Exception $e) {
	echo 'HATALI DERS KODU!' . $e->errorMessage();
}

$professor = Staff::getStaffByID($lecture->getProfessor());
$persentages = json_decode($lecture->getPersentages());
$queue = Lecture::getEnrollmentQueue($_GET['code']);
$stuOwnQueue = Lecture::getEnrollmentQueueWithStuID($_GET['code']);
$classList = Lecture::getClassList($_GET['code']);
$isProfessor = $lecture->getProfessor() == $_SESSION['id'];

require_once 'layouts/layout.header.php';
require_once 'config/helpers.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left"><?= $lecture->getLecCode() . ' ' . $lecture->getTitle(); ?></h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Ders Bilgileri</h4>
				<div class="row innerAll half border-bottom">
					<div class="col-md-8">
						<?php
							echo '<b>Dersi veren kisi:</b> ' . $professor->getName() . ' ' . $professor->getSurname() . '<br>'.
								 '<b>Ders yuzdeleri:</b><br>' .
								 '<ul class="list-unstyled">'.
								 '<li><b>Quiz:</b> ' . $persentages->{'quiz'} . '%' . '</li>'.
								 '<li><b>Vize:</b> ' . $persentages->{'midterm'} . '%' . '</li>'.
								 '<li><b>Final:</b>' . $persentages->{'final'} . '%' . '</li>'.
								 '<li><b>Projeler:</b>' . $persentages->{'project'} . '%' . '</li>'.
								 '<li><b>Devam:</b> ';
								 if($persentages->{'attempt'} == true) echo 'Zorunlu</li>'; else echo 'Zorunlu Degil</li>';
								 if ($_SESSION['userAuthType'] == 5) 
									echo '<li><b><a href="edit_lecture.php?id=' . $_GET['code'] . '">Dersi duzenle</a></b></li>' .
								 			 '<li><b><a href="lecture_handle.php?id=' . $_GET['code'] . '&action=0">Dersi sil</a></b></li>';
								 if($isProfessor)
								 	echo '<li><b><a href="adjust_timetable.php?lecCode=' . $_GET['code'] .'">Ders programini duzenle</a></b>';
								 echo '</ul>'; 

						?>
					</div>
					<?php if ($_SESSION['userAuthType'] == 3): ?>
					<script type="text/javascript">
						function lectureHandler(path, params) {
							// https://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
    						method = "post"; // Set method to post by default if not specified.

    						// The rest of this code assumes you are not using a library.
    						// It can be made less wordy if you use one.
    						var form = document.createElement("form");
    						form.setAttribute("method", method);
    						form.setAttribute("action", path);

    						for(var key in params) {
        						if(params.hasOwnProperty(key)) {
            						var hiddenField = document.createElement("input");
            						hiddenField.setAttribute("type", "hidden");
            						hiddenField.setAttribute("name", key);
            						hiddenField.setAttribute("value", params[key]);

            						form.appendChild(hiddenField);
        						}
    						}

    						document.body.appendChild(form);
    						form.submit();
						}
					</script>
					<div style="padding-right: 5px;">
						<span class="pull-right">
							<?php if(in_array($_SESSION['id'], $stuOwnQueue)) { ?>
							<a nohref class="display-block innerAll inner-2x bg-inverse">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-spinner text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Onay bekleniyor</p>
									<p class="text-normal margin-none strong text-white">Danismaniniz<br> henuz onaylamadi</p>
								</span>
							</a>
							<?php } elseif (in_array($_SESSION['id'], $classList)) { ?>
							<a nohref class="display-block innerAll inner-2x bg-primary" onclick="lectureHandler('lecture_handle.php', {'user': <?= $_SESSION['id']; ?>, 'lecCode': '<?= $_GET['code'] ?>', 'professor': <?= $lecture->getProfessor(); ?>, 'type' : 'quit'})">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-minus text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Dersi Cikar</p>
									<p class="text-normal margin-none strong text-white">Danisman onayina sunar</p>
								</span>
							</a>
							<?php } else { ?>
							<a nohref class="display-block innerAll inner-2x bg-success" onclick="lectureHandler('lecture_handle.php', {'user': <?= $_SESSION['id']; ?>, 'lecCode': '<?= $_GET['code'] ?>', 'professor': <?= $lecture->getProfessor(); ?>, 'type' : 'enroll'})">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-plus text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Dersi Ekle</p>
									<p class="text-normal margin-none strong text-white">Danisman onayina sunar</p>
								</span>
							</a>
							<?php } ?>
						</span>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php if(in_array($_SESSION['id'], $classList) || $isProfessor) { ?>
			<div class="relativeWrap">
				<div class="widget widget-tabs widget-tabs-double-2 widget-tabs-responsive">
	
				<!-- Tabs Heading -->
				<div class="widget-head">
					<ul>
						<li class="active"><a class="glyphicons list" href="#tabAll" data-toggle="tab"><i></i><span>Ders Materyalleri</span></a></li>
						<li class=""><a class="glyphicons bullhorn" href="#tabAccount" data-toggle="tab"><i></i><span>Ders duyurulari</span></a></li>
						<li class=""><a class="glyphicons pencil" href="#tabAssignments" data-toggle="tab"><i></i><span>Odevler</span></a></li>
						<li class=""><a class="glyphicons stats" href="#tabPolls" data-toggle="tab"><i></i><span>Anketler</span></a></li>
						<li class=""><a class="glyphicons group" href="#tabStulist" data-toggle="tab"><i></i><span>Kisi listesi</span></a></li>
							<?php if($isProfessor): ?>
							<li class=""><a class="glyphicons settings" href="#tabApprove" data-toggle="tab"><i></i><span>Istekler</span></a></li>
						<?php endif; ?>
					</ul>
				</div>
				<!-- // Tabs Heading END -->
		
				<div class="widget-body">
					<div class="tab-content">
			
						<!-- Tab content -->
						<div id="tabAll" class="tab-pane widget-body-regular active">
					
						<?php
						if ($isProfessor) {
							echo '<a href="add_env.php?code=' . $lecture->getLecCode() . '" class="btn btn-primary pull-right">Yeni materyal ekle</a>';
						}
						$envs = Environment::getEnvByLecCode($_GET['code']);
						if(!empty($envs)){
							echo '<ol>';
							foreach ($envs as $env) {
								echo '<li><a href="uzemFiles/envs/' . $env->getPath() . '"><i class="fa fa-file"></i> ' . $env->getTitle() . '</a> ';
								if($isProfessor)
									echo '| <a href="env_handle.php?id=' . $env->getID() . '&action=0">(Sil)</a></li>';
							}
							echo '</ol>';
						} else {
							echo "<h3>Henuz bir dokuman eklenmedi.</h3>";
						}
						?>
						</div>
						<!-- // Tab content END -->
			
						<!-- Tab content -->
						<div id="tabAccount" class="tab-pane widget-body-regular">
						<?php 
							if ($isProfessor) {
								echo '<a href="add_lec_ann.php" class="btn btn-primary pull-right">Yeni duyuru ekle</a>';
							}
							$anns = Announce::getAnnouncesByKey($_GET['code'], null);
							if(!empty($anns)){
								$count = 1;
								foreach ($anns as $ann):
						?>
							<h5><b><?= "(" . $count++ . ") " . $ann->getTitle(); ?></b></h5>
							<p><?= $ann->getContent(); ?>
								<br>
								<small><?= $ann->getCreated(); ?></small>
							</p>
							<hr>
						<?php 
							endforeach; 
						} else {
							echo "<h3>Henuz bir ders duyurusu yok.</h3>";
						}
						?>
						</div>
						<!-- // Tab content END -->

						<div id="tabAssignments" class="tab-pane widget-body-regular">
							<?php
							if ($isProfessor) {
								echo '<a href="add_hw.php?code=' . $lecture->getLecCode() .'" class="btn btn-primary pull-right">Yeni odev ekle</a>';
							} 
							$assignments = Assignment::getAssignmentsByLecCode($_GET['code']);
							if (!empty($assignments)) {
								$count = 1;
								foreach ($assignments as $assignment): 
							?>
								<h5><a href="show_assignment.php?id=<?= $assignment->getID(); ?>"><b><?= "(" . $count++ . ") " . $assignment->getTitle(); ?></b></a></h5>
								<p><?= limitInfoChar($assignment->getContent(), 100); ?>
									<br>
									<small>Son teslim tarihi: <?= $assignment->getDueDate(); ?></small>
								</p>
								<hr>
							<?php 
								endforeach; 
							} else {
								echo "<h3>Henuz bir odev eklenmedi.</h3>";
							}
							?>
						</div>
						<div id="tabPolls" class="tab-pane widget-body-regular">
							<?php
								if ($isProfessor) {
									echo '<a href="add_poll.php?lecCode=' . $lecture->getLecCode() . '" class="btn btn-primary pull-right">Yeni anket ekle</a>';
								}
								$polls = Poll::lecturePolls($lecture->getLecCode());
								if (!empty($polls)) {
									$count = 1;
									echo '<ol>';
									foreach ($polls as $poll): ?>
										<li><a href="show_poll.php?id=<?= $poll->getID(); ?>"><?= $poll->getTitle(); ?></a></li>
							<?php 
								endforeach;
								echo '</ol>'; 
							} else {
								echo "<h3>Henuz bir anket eklenmedi.</h3>";
							}
							?>
						</div>
						
						<div id="tabStulist" class="tab-pane widget-body-regular">
						<?php 
							$stuList = Lecture::getClassList($lecture->getLecCode());
							if (!empty($stuList)) {
								echo '<ol>';
								foreach ($stuList as $stu) {
									$student = Student::getStudentByID($stu);
									echo '<li>(<a href="show_user.php?id=' . $student->getID() . '&type=3">'. $student->getID() .  '</a>) ' . $student->getName() . ' ' . $student->getSurname();
									if($isProfessor)
										echo ' <a href=lecture_handle.php?action=3&id=' . $student->getID() .'&lecCode=' . $lecture->getLecCode() .'>(Dersten Cikar)</a></li>';
								}
								echo '</ol>';
							} else {
								echo "<h3>Bu derse henuz kimse kayitli degil.</h3>";
							}
						?>
						</div>
						<?php if($isProfessor): ?>
						<div id="tabApprove" class="tab-pane widget-body-regular">
						<?php
							$jobsF = Lecture::getEnrollmentQueue($lecture->getLecCode());
							if (!empty($jobsF)) {
								echo '<ol>';
							 	foreach ($jobsF as $jobS => $arr) {
							 		foreach ($arr as $key => $job) {
							 			$action = ($jobS == 'enroll') ? 1 : 3;							 		
							 			$stu = Student::getStudentByID($job);
							 			echo '<li><b>(' . strtoupper($jobS) . ')</b> (' . $stu->getID() . ') ' . $stu->getName() . ' ' . $stu->getSurname() . ' <a href=lecture_handle.php?action=' . $action . '&id=' . $stu->getID() .'&lecCode=' . $lecture->getLecCode() .'>Onayla</a> | <a href=lecture_handle.php?action=2&id=' . $stu->getID() .'&lecCode=' . $lecture->getLecCode() .'>Reddet</a></li>'; 

							 		}
							 	}
							 	echo '</ol>';
							 } else {
							 	echo "<h3>Bekleyen bir islem bulunamadi.</h3>";
							 }
						?>
						</div>	
						<?php endif; ?>			
					</div>
				</div>
			</div>
		</div>
			<?php } ?>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>