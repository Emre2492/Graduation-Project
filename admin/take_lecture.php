<?php

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: index.php");    
}
elseif ($_SESSION['userAuthType'] != 3) {
	header("location: index.php");
}

require_once 'layouts/layout.header.php';
?>
<body>
	<div id="content">	
	<?php require_once 'layouts/layout.navbar.php'; ?>

	<div class="heading-buttons bg-white innerAll">
		<h1 class="content-heading padding-none pull-left">Ders Seçim Listesi</h1>
		<div class="clearfix"></div>
	</div>

	<div class="innerAll spacing-x2">
		<?php 
			$faculties = Faculty::readAll();
			$departments = Department::readAll();
			$lectures = Lecture::readAll();

			foreach ($faculties as $faculty) { 
			echo '<div class="widget">
				  <h4 class="innerAll half bg-gray border-bottom margin-bottom-none">' . $faculty->getTitle() . '</h4>
						<div class="row innerAll half border-bottom">';
				foreach ($departments as $department) {
					if ($department->getFaculty() == $faculty->getID()) {
						echo '<div class="col-sm-4">
							    <p class="lead border-bottom">' . $department->getTitle() . '</p><ul class="list-unstyled">';
					
						foreach ($lectures as $lecture) {
							if ($lecture->getDepartment() == $department->getID()){
								echo '<li><a href="lecture_page.php?code='. $lecture->getLecCode() .'"><i class="icon-paper-document fa fa-fw text-muted"></i>' .$lecture->getLecCode() . ' ' . $lecture->getTitle() .'</a></li>';
							}
						}

						echo '</div>';
					}
				}

			echo '</div>
				  </div>';

			}
		?>

		
	</div>

	</div>	
	<?php require_once 'layouts/layout.footer.php';	?>
</body>