<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}
require_once 'layouts/layout.header.php';
require_once 'config/lists.php';
$profilePic = ($_SESSION['image'] == null) ? "../assets/images/default.png" : "../assets/images/profile_pics/" . $_SESSION['image'];

if (in_array($_SESSION['userAuthType'], $accademic2)){
	$lectures = Lecture::getStaffLectures($_SESSION['id']);
} else {
	$lectures = Lecture::getStudentLectureList($_SESSION['id']);
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
					<p class="lead strong margin-none"><?= $_SESSION['name'] . ' ' . $_SESSION['surname']; ?></p>
					<p class="lead">
						<?php 
							echo $userType[$_SESSION['userAuthType']]; 
							if($_SESSION['userAuthType'] != 3 && !empty($_SESSION['room']))
								echo "<br>(" . $_SESSION['room'] . ")";
						?>
						
					</p>
						
					<div class="btn-group">
						<a href="edit_my_profile.php" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Profilimi duzenle</a>
						<a href="update_profile_pic.php" class="btn btn-primary btn-stroke"><i class="fa fa-camera" aria-hidden="true"></i></a>
					</div>
				</div>
						
			</div> 
			<!-- // END col -->

		
			<!-- col -->
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="innerAll half heading-buttons border-bottom">
					<h4 class="margin-none pull-left">
						<?php 
							echo ($_SESSION['userAuthType'] == 3) ? 'Aldigim Dersler' : 'Verdigim Dersler'; 
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