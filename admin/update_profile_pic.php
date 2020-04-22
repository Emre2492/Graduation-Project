<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) 
	header("location: ../index.php");    

$user = User::getUserByID($_SESSION['id'], $_SESSION['userAuthType']);
$isSuccess = false;


if (isset($_POST['submit'])) {
	$uploadDirectory = '../assets/images/profile_pics/';

	if($user->getImage() != null)
    	unlink($uploadDirectory.$user->getImage());

    $dotdot = ".";
    $fileFull = $_FILES['profilePic']['name'];
    $expl = explode($dotdot, $fileFull);
    $extension = end($expl);
    $uploadFileName = $_SESSION['userAuthType'] . '_' . $_SESSION['id'] . '.' . $extension;
    $feedback = move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadDirectory.$uploadFileName);

    if ($feedback) {
        $user->setImage($uploadFileName);
        $user->update();
        $_SESSION['image'] = $uploadFileName;

		$logger = new Logger();
		$logger->log("UPDATEPROFILEPIC", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " updated their profile picture.");
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
			<h1 class="content-heading padding-none pull-left">Profilimi duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Bilgilerim</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Kullanici bilgileri basari ile guncellendi! Sistemde tamami ile etkin olabilmesi icin lutfen yeniden oturum aciniz.
						</div>
					<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="surname">Yeni profil resminizi seciniz:</label>
							<div class="col-sm-10">
								<input type="file" name="profilePic">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="deletePic">Profil resmini kaldirmak:</label>
							<div class="col-sm-10">
								<a href="profilepic_handle.php?action=0" class="btn btn-primary">Profil resminizi kaldirmak icin tiklayin</a>
							</div>
						</div>	
						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Profil Resmimi Guncelle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>