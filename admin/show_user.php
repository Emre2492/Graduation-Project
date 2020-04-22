<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}
require_once 'layouts/layout.header.php';
require_once 'config/lists.php';

$user = User::getUserByID($_GET['id'], $_GET['type']);

$profilePic = ($user->getImage() == null) ? "../assets/images/default.png" : "../assets/images/profile_pics/" . $user->getImage();

if (in_array($_GET['type'], $accademic2)){
	$lectures = Lecture::getStaffLectures($_GET['id']);
} else {
	$lectures = Lecture::getStudentLectureList($_GET['id']);
}
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

<!-- Widget -->
	<div class="widget finances_summary widget-inverse">

		<div class="row row-merge">
			<!-- col -->
			<div class="col-sm-12 col-md-3">
				<!-- Profile Photo -->
				<div class="border-bottom">
					<a href="">
						<img src="<?= $profilePic; ?>" class="img-responsive img-clean"/>
					</a>
				</div>
				<div class="innerAll inner-2x text-center">
					<p class="lead strong margin-none"><?= $user->getName() . ' ' . $user->getSurname(); ?></p>
					<p class="lead">
						<?php 
							echo $userType[$_GET['type']]; 
							if($_GET['type'] != 3 && !empty($user->getRoom()))
								echo "<br>(" . $user->getRoom() . ")";
						?>
						
					</p>
						
					<div class="btn-group">
						<?php if($_SESSION['userAuthType'] == 1){ ?>
						<a href="edit_people.php?id=<?= $user->getID(); ?>&type=<?= $_GET['type']-1; ?>" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Profili duzenle</a>
						<?php }
						if($_SESSION['userAuthType'] == 3 && $_GET['type'] == 3):
						?>
						<a href="show_message.php?from=<?= $_GET['id']; ?>" class="btn btn-primary btn-stroke"><i class="fa fa-envelope" aria-hidden="true"></i> Mesaj gonder</a>
						<?php endif; ?>
					</div>
				</div>
						
			</div> 
			<!-- // END col -->

		
			<!-- col -->
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="innerAll half heading-buttons border-bottom">
					<h4 class="margin-none pull-left">
						<?php 
							echo ($_GET['type'] == 3) ? 'Aldigim Dersler' : 'Verdigim Dersler'; 
						?>
					</h4>
					
					<div class="clearfix"></div>
					
				</div>
				<div class="innerAll">
					<ul class="list-unstyled resume-documents">
						<?php 
						foreach ($lectures as $lecture) { ?>
						<li><a href="lecture_page.php?code=<?= $lecture->getLecCode(); ?>"><i class="fa fa-file-o"></i> <?= $lecture->getLecCode() . ' ' .  $lecture->getTitle(); ?></a></li>
						<?php } ?>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>

	<?php require_once 'layouts/layout.footer.php';	?>